"use client";

interface ControlsProps {
  nameInput: string;
  onNameInputChange: (val: string) => void;
  spinRounds: number;
  onSpinRoundsChange: (val: number) => void;
  randomCount: number;
  onRandomCountChange: (val: number) => void;
  onGenerateRandom: () => void;
  onUpdateNames: () => void;
  onResetSpinner: () => void;
}

export default function Controls({
  nameInput,
  onNameInputChange,
  spinRounds,
  onSpinRoundsChange,
  randomCount,
  onRandomCountChange,
  onGenerateRandom,
  onUpdateNames,
  onResetSpinner
}: ControlsProps) {
  return (
    <div className="w-full max-w-md mt-4 mb-8">
      <div className="flex items-center justify-between mb-2">
        <label className="text-sm font-bold uppercase tracking-widest opacity-60">
          Atur Nama
        </label>
        <div className="flex items-center gap-4">
          <div className="flex items-center bg-white/50 rounded-lg border-2 border-[#212844] px-2 py-1">
            <span className="text-[9px] font-black opacity-40 mr-1 uppercase">Putaran:</span>
            <input 
              type="number" 
              min="1" 
              max="10" 
              value={spinRounds}
              onChange={(e) => onSpinRoundsChange(Math.max(1, Math.min(10, parseInt(e.target.value) || 1)))}
              className="w-6 bg-transparent text-center font-bold text-xs outline-none"
            />
          </div>
          <div className="flex items-center bg-white/50 rounded-lg border-2 border-[#212844] px-2 py-1">
            <input 
              type="number" 
              min="2" 
              max="40" 
              value={randomCount}
              onChange={(e) => onRandomCountChange(Math.max(2, Math.min(40, parseInt(e.target.value) || 2)))}
              className="w-8 bg-transparent text-center font-bold text-xs outline-none"
            />
            <span className="text-[10px] font-bold opacity-40 ml-1 mr-2 uppercase">NAMA</span>
            <button 
              onClick={onGenerateRandom}
              className="px-2 py-1 bg-[#212844] text-[#f0e7d5] text-[10px] font-black uppercase rounded transition-all hover:scale-105 active:scale-95"
            >
              Generate
            </button>
          </div>
        </div>
      </div>
      <textarea
        value={nameInput}
        onChange={(e) => onNameInputChange(e.target.value)}
        className="w-full h-32 p-4 rounded-xl border-4 border-[#212844] bg-white/50 focus:bg-white outline-none transition-all resize-none font-bold text-sm"
        placeholder="Contoh: Nama 1, Nama 2, Nama 3"
      />
      <div className="mt-2 flex gap-2">
        <button 
          onClick={onUpdateNames}
          className="flex-1 rounded-xl bg-[#212844] px-4 py-3 text-sm font-bold uppercase tracking-widest text-[#f0e7d5] hover:bg-[#3d4b7a] transition-colors"
        >
          Update Spinner
        </button>
        <button 
          onClick={onResetSpinner}
          className="rounded-xl border-2 border-[#212844] bg-white px-4 py-3 text-sm font-bold uppercase tracking-widest text-[#212844] hover:bg-[#f0e7d5] transition-colors"
        >
          Reset
        </button>
      </div>
    </div>
  );
}
