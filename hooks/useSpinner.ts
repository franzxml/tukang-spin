"use client";

import { useState, useRef } from "react";

export function useSpinner() {
  const [isSnapped, setIsSnapped] = useState(false);
  const [showSpinner, setShowSpinner] = useState(false);
  const [rotation, setRotation] = useState(0);
  const [nameInput, setNameInput] = useState("");
  const [names, setNames] = useState<string[]>([]);
  const [resetNames, setResetNames] = useState<string[]>([]);
  const [isSpinning, setIsSpinning] = useState(false);
  const [winner, setWinner] = useState<string | null>(null);
  const [showModal, setShowModal] = useState(false);
  const [history, setHistory] = useState<string[]>([]);
  const [randomCount, setRandomCount] = useState(5);
  const [spinRounds, setSpinRounds] = useState(1);
  const [currentRound, setCurrentRound] = useState(0);
  
  const rotationRef = useRef(0);

  const handleGenerateRandom = () => {
    const sampleNames = [
      "Budi", "Siti", "Agus", "Lani", "Eko", "Dewi", "Rudi", "Maya", "Adi", "Putri",
      "Rian", "Sari", "Fajar", "Indah", "Hendra", "Yanti", "Doni", "Rina", "Taufik", "Ani",
      "Surya", "Dian", "Bambang", "Wati", "Joko", "Sri", "Haryono", "Lestari", "Guntur", "Ratna",
      "Zaki", "Nabila", "Arif", "Aisyah", "Dimas", "Kiki", "Farhan", "Rara", "Irfan", "Gita"
    ];
    
    const result: string[] = [];
    const availableNames = [...sampleNames];
    
    for (let i = 0; i < randomCount; i++) {
      if (availableNames.length > 0) {
        const randomIndex = Math.floor(Math.random() * availableNames.length);
        result.push(availableNames.splice(randomIndex, 1)[0]);
      } else {
        result.push(`Peserta ${i + 1}`);
      }
    }
    
    const newNamesInput = result.join(", ");
    setNameInput(newNamesInput);
    setNames(result);
    setResetNames(result);
  };

  const handleStart = () => {
    const parsedNames = nameInput
      .split(",")
      .map((n) => n.trim())
      .filter((n) => n !== "");
    
    setNames(parsedNames);
    setResetNames(parsedNames);
    setIsSnapped(true);
    
    setTimeout(() => {
      setShowSpinner(true);
    }, 2000);
  };

  const handleUpdateNames = () => {
    const parsedNames = nameInput
      .split(",")
      .map((n) => n.trim())
      .filter((n) => n !== "");
    
    setNames(parsedNames);
    setResetNames(parsedNames);
    setWinner(null);
  };

  const handleResetSpinner = () => {
    setNames(resetNames);
    setNameInput(resetNames.join(", "));
    setWinner(null);
  };

  const handleRemoveWinner = () => {
    if (!winner) return;
    const newNames = names.filter((n) => n !== winner);
    setNames(newNames);
    setNameInput(newNames.join(", "));
    setWinner(null);
    setShowModal(false);
  };

  const executeSpinSequence = (remaining: number) => {
    const iteration = spinRounds - remaining + 1;
    setCurrentRound(iteration);
    
    // eslint-disable-next-line react-hooks/purity
    const extraDegree = Math.floor(Math.random() * 360) + 1800; // 5 full spins + random
    rotationRef.current += extraDegree;
    setRotation(rotationRef.current);

    // After animation duration
    setTimeout(() => {
      if (remaining > 1) {
        // Continue to next round
        setTimeout(() => {
          executeSpinSequence(remaining - 1);
        }, 500); // Small pause between kicks
      } else {
        // Final round: Determine winner
        setIsSpinning(false);
        const actualRotation = rotationRef.current % 360;
        const segmentAngle = 360 / names.length;
        const winningIndex = Math.floor(((360 - (actualRotation % 360)) % 360) / segmentAngle);
        const chosenWinner = names[winningIndex];
        
        setWinner(chosenWinner);
        setHistory((prev) => [...prev, chosenWinner]);
        setShowModal(true);
        setCurrentRound(0);
      }
    }, 4000);
  };

  const spin = () => {
    if (isSpinning || names.length < 2) return;
    
    setIsSpinning(true);
    setWinner(null);
    setShowModal(false);
    
    executeSpinSequence(spinRounds);
  };

  const resetAll = () => {
    setShowSpinner(false);
    setIsSnapped(false);
    setWinner(null);
    setRotation(0);
    rotationRef.current = 0;
    setHistory([]);
    setShowModal(false);
  };

  return {
    isSnapped,
    showSpinner,
    rotation,
    nameInput,
    setNameInput,
    names,
    isSpinning,
    winner,
    showModal,
    setShowModal,
    history,
    setHistory,
    randomCount,
    setRandomCount,
    spinRounds,
    setSpinRounds,
    currentRound,
    handleGenerateRandom,
    handleStart,
    handleUpdateNames,
    handleResetSpinner,
    handleRemoveWinner,
    spin,
    resetAll,
  };
}
