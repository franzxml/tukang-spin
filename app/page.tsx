"use client";

import { useState } from "react";

export default function Home() {
  const [isSnapped, setIsSnapped] = useState(false);
  const [showSpinner, setShowSpinner] = useState(false);
  const [rotation, setRotation] = useState(0);
  const [nameInput, setNameInput] = useState("Opsi 1\nOpsi 2\nOpsi 3\nOpsi 4");
  const [names, setNames] = useState<string[]>([]);
  const [isSpinning, setIsSpinning] = useState(false);
  const [winner, setWinner] = useState<string | null>(null);

  const handleStart = () => {
    const parsedNames = nameInput
      .split("\n")
      .map((n) => n.trim())
      .filter((n) => n !== "");
    
    if (parsedNames.length < 2) {
      alert("Masukkan minimal 2 nama!");
      return;
    }

    setNames(parsedNames);
    setIsSnapped(true);
    
    setTimeout(() => {
      setShowSpinner(true);
    }, 2000);
  };

  const spin = () => {
    if (isSpinning) return;
    
    setIsSpinning(true);
    setWinner(null);
    
    const extraDegree = Math.floor(Math.random() * 360) + 1800; // 5 full spins + random
    const totalRotation = rotation + extraDegree;
    setRotation(totalRotation);

    // Calculate winner after animation
    setTimeout(() => {
      setIsSpinning(false);
      const actualRotation = totalRotation % 360;
      const segmentAngle = 360 / names.length;
      // The pointer is at the top (0 deg). 
      // The wheel rotates clockwise. The segment at the top is the one "hit".
      // We need to find which segment is at the 0 degree mark.
      // Index = floor((360 - actualRotation) / segmentAngle)
      const winningIndex = Math.floor(((360 - (actualRotation % 360)) % 360) / segmentAngle);
      setWinner(names[winningIndex]);
    }, 4000);
  };

  const colors = [
    "#212844", "#3d4b7a", "#5a6eb0", "#7791e6", 
    "#2a3459", "#46568c", "#6278bf", "#7e9af2"
  ];

  return (
    <main className="relative flex min-h-screen flex-col items-center justify-center bg-[#f0e7d5] p-8 text-center overflow-hidden font-mono text-[#212844]">
      {/* Landing Page Content */}
      {!showSpinner && (
        <div 
          className={`flex flex-col items-center transition-all duration-[2000ms] ease-out ${
            isSnapped 
              ? "opacity-0 blur-3xl scale-125 rotate-3 grayscale pointer-events-none" 
              : "opacity-100 blur-0 scale-100 rotate-0"
          }`}
        >
          <h1 className="mb-6 text-6xl font-bold">
            Tukang <span className="underline decoration-wavy">Spin</span>
          </h1>
          <p className="max-w-2xl text-xl opacity-80 mb-8">
            Alat putar interaktif untuk membuat keputusan acak, memilih nama, atau menentukan hadiah.
          </p>

          <div className="w-full max-w-md mb-8">
            <label className="block text-left text-sm font-bold uppercase tracking-widest mb-2 opacity-60">
              Isi Nama (satu per baris)
            </label>
            <textarea
              value={nameInput}
              onChange={(e) => setNameInput(e.target.value)}
              className="w-full h-40 p-4 rounded-xl border-4 border-[#212844] bg-white/50 focus:bg-white outline-none transition-all resize-none font-bold"
              placeholder="Contoh:&#10;Nama 1&#10;Nama 2"
            />
          </div>
          
          <button 
            onClick={handleStart}
            className="group relative cursor-pointer outline-none"
          >
            <span className="absolute inset-0 translate-y-2 rounded-xl bg-[#212844]/20 transition-transform group-hover:translate-y-1.5 group-active:translate-y-0"></span>
            <span className="relative block -translate-y-1 rounded-xl bg-[#212844] px-12 py-5 text-2xl font-bold text-[#f0e7d5] transition-transform group-hover:-translate-y-1.5 group-active:translate-y-1">
              mulai
            </span>
          </button>
        </div>
      )}

      {/* Spinner Component */}
      {showSpinner && (
        <div className="appear-smooth flex flex-col items-center w-full max-w-4xl">
          <div className="relative h-80 w-80 md:h-[500px] md:w-[500px] mb-12">
            {/* The Wheel */}
            <div 
              style={{ transform: `rotate(${rotation}deg)` }}
              className="absolute inset-0 rounded-full border-8 border-[#212844] bg-white transition-transform duration-[4000ms] cubic-bezier(0.15, 0, 0.15, 1) overflow-hidden shadow-2xl"
            >
              {names.map((name, i) => {
                const angle = 360 / names.length;
                return (
                  <div 
                    key={i}
                    className="absolute top-0 left-1/2 h-1/2 w-full origin-bottom -translate-x-1/2"
                    style={{ 
                      transform: `rotate(${i * angle}deg)`,
                      clipPath: names.length > 2 
                        ? `polygon(50% 100%, ${50 - Math.tan((angle / 2) * Math.PI / 180) * 100}% 0%, ${50 + Math.tan((angle / 2) * Math.PI / 180) * 100}% 0%)`
                        : names.length === 2 && i === 0 ? "none" : "none",
                      backgroundColor: colors[i % colors.length]
                    }}
                  >
                    <span 
                      className="absolute top-12 left-1/2 -translate-x-1/2 font-bold text-[#f0e7d5] text-lg md:text-xl uppercase whitespace-nowrap"
                      style={{ transform: `rotate(0deg)` }}
                    >
                      {name}
                    </span>
                  </div>
                );
              })}
              
              {/* Special handling for 2 names */}
              {names.length === 2 && (
                <>
                  <div className="absolute top-0 left-0 w-full h-1/2 bg-[#212844]">
                     <span className="absolute bottom-12 left-1/2 -translate-x-1/2 font-bold text-[#f0e7d5] text-xl uppercase">{names[0]}</span>
                  </div>
                  <div className="absolute bottom-0 left-0 w-full h-1/2 bg-[#3d4b7a]">
                     <span className="absolute top-12 left-1/2 -translate-x-1/2 font-bold text-[#f0e7d5] text-xl uppercase">{names[1]}</span>
                  </div>
                </>
              )}
            </div>

            {/* Pointer */}
            <div className="absolute -top-6 left-1/2 -translate-x-1/2 z-30 drop-shadow-lg">
              <div className="w-10 h-10 bg-[#212844] clip-path-triangle rotate-180"></div>
            </div>

            {/* Center Button */}
            <button 
              onClick={spin}
              disabled={isSpinning}
              className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-40 group outline-none disabled:opacity-50"
            >
              <span className="absolute inset-0 translate-y-1.5 rounded-full bg-[#212844]/20 transition-transform group-hover:translate-y-1 group-active:translate-y-0"></span>
              <span className="relative flex h-24 w-24 items-center justify-center rounded-full bg-[#212844] text-[#f0e7d5] font-bold transition-transform group-hover:-translate-y-1 group-active:translate-y-1 tracking-wider shadow-lg">
                putar
              </span>
            </button>
          </div>

          {/* Winner Display */}
          {winner && (
            <div className="animate-bounce mb-8">
              <h3 className="text-3xl font-black uppercase tracking-widest text-[#212844]">
                🎉 {winner} 🎉
              </h3>
            </div>
          )}

          <button 
            onClick={() => {
              setShowSpinner(false);
              setIsSnapped(false);
              setWinner(null);
              setRotation(0);
            }}
            className="text-sm font-bold uppercase tracking-widest opacity-40 hover:opacity-100 transition-opacity"
          >
            ← Kembali & Atur Nama
          </button>
        </div>
      )}

      <style jsx>{`
        .clip-path-triangle {
          clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }
        
        .appear-smooth {
          animation: appear 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes appear {
          0% {
            opacity: 0;
            transform: scale(0.5) rotate(-10deg);
            filter: blur(10px);
          }
          100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            filter: blur(0px);
          }
        }
      `}</style>
    </main>
  );
}
