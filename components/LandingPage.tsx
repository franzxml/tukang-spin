"use client";

interface LandingPageProps {
  onStart: () => void;
  isSnapped: boolean;
}

export default function LandingPage({ onStart, isSnapped }: LandingPageProps) {
  return (
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
        onClick={onStart}
        className="group relative cursor-pointer outline-none"
      >
        <span className="absolute inset-0 translate-y-2 rounded-xl bg-[#212844]/20 transition-transform group-hover:translate-y-1.5 group-active:translate-y-0"></span>
        <span className="relative block -translate-y-1 rounded-xl bg-[#212844] px-12 py-5 text-2xl font-bold text-[#f0e7d5] transition-transform group-hover:-translate-y-1.5 group-active:translate-y-1">
          mulai
        </span>
      </button>
    </div>
  );
}
