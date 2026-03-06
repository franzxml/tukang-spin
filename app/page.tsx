"use client";

import { useSpinner } from "@/hooks/useSpinner";
import LandingPage from "@/components/LandingPage";
import SpinnerWheel from "@/components/SpinnerWheel";
import Controls from "@/components/Controls";
import History from "@/components/History";
import WinnerModal from "@/components/WinnerModal";

export default function Home() {
  const {
    isSnapped,
    showSpinner,
    rotation,
    nameInput,
    setNameInput,
    names,
    isSpinning,
    winner,
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
  } = useSpinner();

  return (
    <main className="relative flex min-h-screen flex-col items-center justify-center bg-[#f0e7d5] p-8 text-center overflow-hidden font-mono text-[#212844]">
      {/* Landing Page Content */}
      {!showSpinner && (
        <LandingPage onStart={handleStart} isSnapped={isSnapped} />
      )}

      {/* Spinner Component */}
      {showSpinner && (
        <div className="animate-appear-smooth flex flex-col items-center w-full max-w-4xl mt-8">
          <SpinnerWheel 
            names={names}
            rotation={rotation}
            isSpinning={isSpinning}
            currentRound={currentRound}
            spinRounds={spinRounds}
            onSpin={spin}
          />

          <Controls 
            nameInput={nameInput}
            onNameInputChange={setNameInput}
            spinRounds={spinRounds}
            onSpinRoundsChange={setSpinRounds}
            randomCount={randomCount}
            onRandomCountChange={setRandomCount}
            onGenerateRandom={handleGenerateRandom}
            onUpdateNames={handleUpdateNames}
            onResetSpinner={handleResetSpinner}
          />

          <History 
            history={history}
            onClear={() => setHistory([])}
          />

          <button 
            onClick={resetAll}
            className="text-sm font-bold uppercase tracking-widest opacity-40 hover:opacity-100 transition-opacity mb-8"
          >
            ← Kembali ke Awal
          </button>
        </div>
      )}

      {/* Popup Modal */}
      <WinnerModal 
        winner={winner}
        onClose={() => setShowModal(false)}
        onRemove={handleRemoveWinner}
      />
    </main>
  );
}
