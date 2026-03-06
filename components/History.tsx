"use client";

interface HistoryProps {
  history: string[];
  onClear: () => void;
}

export default function History({ history, onClear }: HistoryProps) {
  if (history.length === 0) return null;

  return (
    <div className="w-full max-w-md mb-8 p-6 rounded-xl border-4 border-[#212844] bg-white/30">
       <h3 className="text-sm font-black uppercase tracking-widest mb-4 opacity-60">Riwayat Terpilih</h3>
       <div className="flex flex-col gap-2">
         {history.map((h, i) => (
           <div key={i} className="flex items-center gap-4 bg-white p-3 rounded-lg border-2 border-[#212844] animate-pop-up">
              <span className="font-black text-[#212844]/40">#{i + 1}</span>
              <span className="font-bold uppercase flex-1 text-left">{h}</span>
           </div>
         ))}
       </div>
       <button 
         onClick={onClear}
         className="mt-4 text-[10px] font-black uppercase tracking-widest opacity-40 hover:opacity-100 transition-opacity"
       >
         Bersihkan Riwayat
       </button>
    </div>
  );
}
