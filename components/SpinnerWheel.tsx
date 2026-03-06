"use client";

interface SpinnerWheelProps {
  names: string[];
  rotation: number;
  isSpinning: boolean;
  currentRound: number;
  spinRounds: number;
  onSpin: () => void;
}

const COLORS = ["#f8f9fa", "#e9ecef", "#dee2e6", "#f1f3f5"];

export default function SpinnerWheel({ 
  names, 
  rotation, 
  isSpinning, 
  currentRound, 
  spinRounds, 
  onSpin 
}: SpinnerWheelProps) {
  return (
    <div className="relative h-80 w-80 md:h-[500px] md:w-[500px] mb-8 shadow-2xl rounded-full">
      {/* The Wheel */}
      <div 
        style={{ transform: `rotate(${rotation}deg)` }}
        className="absolute inset-0 rounded-full border-8 border-[#212844] bg-white transition-transform duration-[4000ms] cubic-bezier(0.15, 0, 0.15, 1) overflow-hidden"
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
                  backgroundColor: COLORS[i % COLORS.length],
                  borderBottom: "1px solid #21284422"
                }}
              >
                <span 
                  className="absolute top-4 md:top-8 left-1/2 -translate-x-1/2 font-bold text-[#212844] uppercase whitespace-nowrap px-2 origin-center"
                  style={{ 
                    transform: `rotate(90deg)`,
                    fontSize: names.length > 20 ? '0.6rem' : names.length > 12 ? '0.75rem' : '0.9rem',
                    maxWidth: "140px",
                    overflow: "hidden",
                    textOverflow: "ellipsis"
                  }}
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
          onClick={onSpin}
          disabled={isSpinning || names.length < 2}
          className="relative group outline-none disabled:cursor-not-allowed"
        >
          <span className="absolute inset-0 translate-y-1.5 rounded-full bg-[#212844]/20 transition-transform group-hover:translate-y-1 group-active:translate-y-0"></span>
          <span className={`relative flex h-24 w-24 items-center justify-center rounded-full font-bold transition-transform tracking-wider ${
            names.length < 2 
              ? "bg-[#dee2e6] text-[#212844]/40" 
              : "bg-[#212844] text-[#f0e7d5] group-hover:-translate-y-1 group-active:translate-y-1"
          }`}>
            {isSpinning && currentRound > 0 
              ? `${currentRound}/${spinRounds}` 
              : names.length < 2 ? "isi\ndulu" : "putar"}
          </span>
        </button>
      </div>

      <style jsx>{`
        .clip-path-triangle {
          clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }
      `}</style>
    </div>
  );
}
