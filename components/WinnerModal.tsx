"use client";

interface WinnerModalProps {
  winner: string | null;
  onClose: () => void;
  onRemove: () => void;
}

export default function WinnerModal({ winner, onClose, onRemove }: WinnerModalProps) {
  if (!winner) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
      {/* Overlay */}
      <div 
        className="absolute inset-0 bg-[#212844]/80 backdrop-blur-md animate-fade-in"
        onClick={onClose}
      ></div>
      
      {/* Modal Content */}
      <div className="relative w-full max-w-md bg-[#f0e7d5] border-8 border-[#212844] p-8 md:p-12 rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] animate-pop-up text-center">
         <div className="absolute -top-16 left-1/2 -translate-x-1/2 text-8xl drop-shadow-2xl">
            🏆
         </div>
         
         <div className="mt-4 mb-2">
           <h2 className="text-xs font-black uppercase tracking-[0.3em] text-[#212844]/40">
              Selamat Kepada
           </h2>
         </div>
         
         <div className="mb-10">
            <h1 className="text-6xl font-black uppercase tracking-tighter text-[#212844] break-words leading-tight">
              {winner}
            </h1>
         </div>
         
         <div className="flex flex-col gap-4">
            <button 
                onClick={onClose}
                className="group relative cursor-pointer outline-none w-full"
            >
                <span className="absolute inset-0 translate-y-1.5 rounded-2xl bg-[#212844]/20 transition-transform group-hover:translate-y-1 group-active:translate-y-0"></span>
                <span className="relative block -translate-y-1 rounded-2xl bg-[#212844] px-8 py-4 text-xl font-bold text-[#f0e7d5] transition-transform group-hover:-translate-y-1.5 group-active:translate-y-0.5">
                  Mantap!
                </span>
            </button>

            <button 
                onClick={onRemove}
                className="group relative cursor-pointer outline-none w-full"
            >
                <span className="absolute inset-0 translate-y-1 rounded-2xl bg-[#212844]/10 transition-transform group-hover:translate-y-0.5 group-active:translate-y-0"></span>
                <span className="relative block -translate-y-0.5 rounded-2xl border-2 border-[#212844]/40 bg-[#212844]/10 px-8 py-4 text-sm font-bold text-[#212844] transition-transform group-hover:-translate-y-1 group-active:translate-y-0 uppercase tracking-widest">
                  Hapus dari Spinner & Tutup
                </span>
            </button>
         </div>
      </div>
    </div>
  );
}
