"use client";

import { useState } from "react";

export default function Home() {
  const [isSnapped, setIsSnapped] = useState(false);
  const [showSpinner, setShowSpinner] = useState(false);
  const [rotation, setRotation] = useState(0);
  const [nameInput, setNameInput] = useState("");
  const [names, setNames] = useState<string[]>([]);
  const [isSpinning, setIsSpinning] = useState(false);
  const [winner, setWinner] = useState<string | null>(null);
  const [showModal, setShowModal] = useState(false);

  const handleStart = () => {
    const parsedNames = nameInput
      .split(",")
      .map((n) => n.trim())
      .filter((n) => n !== "");
    
    setNames(parsedNames);
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
    setWinner(null);
    setRotation(0);
  };

  const spin = () => {
    if (isSpinning || names.length < 2) return;
    
    setIsSpinning(true);
    setWinner(null);
    setShowModal(false);
    
    const extraDegree = Math.floor(Math.random() * 360) + 1800; // 5 full spins + random
    const totalRotation = rotation + extraDegree;
    setRotation(totalRotation);

    // Calculate winner after animation
    setTimeout(() => {
      setIsSpinning(false);
      const actualRotation = totalRotation % 360;
      const segmentAngle = 360 / names.length;
      const winningIndex = Math.floor(((360 - (actualRotation % 360)) % 360) / segmentAngle);
      setWinner(names[winningIndex]);
      setShowModal(true);
    }, 4000);
  };

  // Plain but elegant colors
  const colors = ["#f8f9fa", "#e9ecef", "#dee2e6", "#f1f3f5"];

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
          <p className="max-w-2xl text-xl opacity-80 mb-12">
            Alat putar interaktif untuk membuat keputusan acak, memilih nama, atau menentukan hadiah.
          </p>
          
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
        <div className="appear-smooth flex flex-col items-center w-full max-w-4xl mt-8">
          <div className="relative h-80 w-80 md:h-[500px] md:w-[500px] mb-8">
            {/* The Wheel */}
            <div 
              style={{ transform: `rotate(${rotation}deg)` }}
              className="absolute inset-0 rounded-full border-8 border-[#212844] bg-white transition-transform duration-[4000ms] cubic-bezier(0.15, 0, 0.15, 1) overflow-hidden shadow-2xl"
            >
              {names.length >= 2 ? (
                names.map((name, i) => {
                  const angle = 360 / names.length;
                  return (
                    <div 
                      key={i}
                      className="absolute top-0 left-1/2 h-1/2 w-full origin-bottom -translate-x-1/2"
                      style={{ 
                        transform: `rotate(${i * angle}deg)`,
                        clipPath: names.length > 2 
                          ? `polygon(50% 100%, ${50 - Math.tan((angle / 2) * Math.PI / 180) * 100}% 0%, ${50 + Math.tan((angle / 2) * Math.PI / 180) * 100}% 0%)`
                          : "none",
                        backgroundColor: colors[i % colors.length],
                        borderBottom: "1px solid #21284422"
                      }}
                    >
                      <span 
                        className="absolute top-12 left-1/2 -translate-x-1/2 font-bold text-[#212844] text-lg md:text-xl uppercase whitespace-nowrap px-4"
                        style={{ transform: `rotate(0deg)` }}
                      >
                        {name}
                      </span>
                    </div>
                  );
                })
              ) : (
                <div className="h-full w-full bg-[#f8f9fa]" />
              )}
              
              {/* Special handling for 2 names */}
              {names.length === 2 && (
                <>
                  <div className="absolute top-0 left-0 w-full h-1/2 bg-[#f8f9fa] border-b-2 border-[#21284422]">
                     <span className="absolute bottom-12 left-1/2 -translate-x-1/2 font-bold text-[#212844] text-xl uppercase">{names[0]}</span>
                  </div>
                  <div className="absolute bottom-0 left-0 w-full h-1/2 bg-[#e9ecef]">
                     <span className="absolute top-12 left-1/2 -translate-x-1/2 font-bold text-[#212844] text-xl uppercase">{names[1]}</span>
                  </div>
                </>
              )}
            </div>

            {/* Pointer */}
            <div className="absolute -top-6 left-1/2 -translate-x-1/2 z-30 drop-shadow-lg">
              <div className="w-10 h-10 bg-[#212844] clip-path-triangle rotate-180"></div>
            </div>

            {/* Center Button */}
            <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-40">
              <button 
                onClick={spin}
                disabled={isSpinning || names.length < 2}
                className="relative group outline-none disabled:cursor-not-allowed"
              >
                <span className="absolute inset-0 translate-y-1.5 rounded-full bg-[#212844]/20 transition-transform group-hover:translate-y-1 group-active:translate-y-0"></span>
                <span className={`relative flex h-24 w-24 items-center justify-center rounded-full font-bold transition-transform tracking-wider shadow-lg ${
                  names.length < 2 
                    ? "bg-[#dee2e6] text-[#212844]/40" 
                    : "bg-[#212844] text-[#f0e7d5] group-hover:-translate-y-1 group-active:translate-y-1"
                }`}>
                  {names.length < 2 ? "isi\ndulu" : "putar"}
                </span>
              </button>
            </div>
          </div>

          <div className="w-full max-w-md mt-4 mb-8">
            <label className="block text-center text-sm font-bold uppercase tracking-widest mb-2 opacity-60">
              Atur Nama (pisahkan dengan koma)
            </label>
            <textarea
              value={nameInput}
              onChange={(e) => setNameInput(e.target.value)}
              className="w-full h-32 p-4 rounded-xl border-4 border-[#212844] bg-white/50 focus:bg-white outline-none transition-all resize-none font-bold text-sm"
              placeholder="Contoh: Nama 1, Nama 2, Nama 3"
            />
            <button 
              onClick={handleUpdateNames}
              className="mt-2 w-full rounded-xl bg-[#212844] px-4 py-3 text-sm font-bold uppercase tracking-widest text-[#f0e7d5] hover:bg-[#3d4b7a] transition-colors"
            >
              Update Spinner
            </button>
          </div>

          <button 
            onClick={() => {
              setShowSpinner(false);
              setIsSnapped(false);
              setWinner(null);
              setRotation(0);
            }}
            className="text-sm font-bold uppercase tracking-widest opacity-40 hover:opacity-100 transition-opacity mb-8"
          >
            ← Kembali ke Awal
          </button>
        </div>
      )}

      {/* Popup Modal */}
      {showModal && winner && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
          {/* Overlay */}
          <div 
            className="absolute inset-0 bg-[#212844]/80 backdrop-blur-sm animate-fade-in"
            onClick={() => setShowModal(false)}
          ></div>
          
          {/* Modal Content */}
          <div className="relative w-full max-w-md bg-[#f0e7d5] border-8 border-[#212844] p-12 rounded-3xl shadow-[0_20px_0_rgba(0,0,0,0.1)] animate-pop-up">
             <div className="absolute -top-12 left-1/2 -translate-x-1/2 text-6xl">
                🏆
             </div>
             
             <h2 className="text-sm font-black uppercase tracking-widest text-[#212844]/60 mb-2">
                Pemenangnya Adalah:
             </h2>
             
             <div className="mb-8">
                <h1 className="text-5xl font-black uppercase tracking-tight text-[#212844] break-words">
                  {winner}
                </h1>
             </div>
             
             <button 
                onClick={() => setShowModal(false)}
                className="group relative cursor-pointer outline-none w-full"
             >
                <span className="absolute inset-0 translate-y-2 rounded-xl bg-[#212844]/20 transition-transform group-hover:translate-y-1.5 group-active:translate-y-0"></span>
                <span className="relative block -translate-y-1 rounded-xl bg-[#212844] px-12 py-4 text-xl font-bold text-[#f0e7d5] transition-transform group-hover:-translate-y-1.5 group-active:translate-y-1">
                  Mantap!
                </span>
             </button>
          </div>
        </div>
      )}

      <style jsx>{`
        .clip-path-triangle {
          clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }
        
        .appear-smooth {
          animation: appear 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .animate-fade-in {
          animation: fadeIn 0.3s ease-out forwards;
        }

        .animate-pop-up {
          animation: popUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes fadeIn {
          from { opacity: 0; }
          to { opacity: 1; }
        }

        @keyframes popUp {
          from { 
            opacity: 0;
            transform: scale(0.8) translateY(20px);
          }
          to { 
            opacity: 1;
            transform: scale(1) translateY(0);
          }
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