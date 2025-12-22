'use client';

import { useState, FormEvent } from 'react';

interface AddCharacterFormProps {
  userId: number;
  onCharacterAdded: () => void;
}

export default function AddCharacterForm({ userId, onCharacterAdded }: AddCharacterFormProps) {
  const [formData, setFormData] = useState({
    name: '',
    level: '',
    weaponType: '',
    weaponName: '',
    artifact: '',
    normalAttackLevel: '',
    elementalSkillLevel: '',
    elementalBurstLevel: ''
  });
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState('');

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault();
    setIsLoading(true);
    setError('');

    try {
      const response = await fetch('/api/characters', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          userId,
          name: formData.name,
          level: formData.level ? parseInt(formData.level) : null,
          weaponType: formData.weaponType || null,
          weaponName: formData.weaponName || null,
          artifact: formData.artifact || null,
          normalAttackLevel: formData.normalAttackLevel ? parseInt(formData.normalAttackLevel) : null,
          elementalSkillLevel: formData.elementalSkillLevel ? parseInt(formData.elementalSkillLevel) : null,
          elementalBurstLevel: formData.elementalBurstLevel ? parseInt(formData.elementalBurstLevel) : null
        }),
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.error || 'Terjadi kesalahan saat menambahkan karakter');
      }

      // Reset form
      setFormData({
        name: '',
        level: '',
        weaponType: '',
        weaponName: '',
        artifact: '',
        normalAttackLevel: '',
        elementalSkillLevel: '',
        elementalBurstLevel: ''
      });

      // Notify parent component
      onCharacterAdded();

    } catch (err) {
      setError(err instanceof Error ? err.message : 'Terjadi kesalahan');
    } finally {
      setIsLoading(false);
    }
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  return (
    <div className="bg-white rounded-2xl shadow-xl p-8 mb-8">
      <h2 className="text-2xl font-bold text-gray-900 mb-6">Tambah Karakter Baru</h2>

      {error && (
        <div className="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
          {error}
        </div>
      )}

      <form onSubmit={handleSubmit} className="space-y-6">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label htmlFor="name" className="block text-sm font-medium text-gray-700 mb-2">
              Nama Karakter <span className="text-red-500">*</span>
            </label>
            <input
              id="name"
              name="name"
              type="text"
              value={formData.name}
              onChange={handleChange}
              required
              autoComplete="off"
              className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
              placeholder="Masukkan nama karakter"
            />
          </div>

          <div>
            <label htmlFor="level" className="block text-sm font-medium text-gray-700 mb-2">
              Level
            </label>
            <select
              id="level"
              name="level"
              value={formData.level}
              onChange={handleChange}
              className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
            >
              <option value="">Pilih level</option>
              {Array.from({ length: 90 }, (_, i) => i + 1).map((level) => (
                <option key={level} value={level}>
                  {level}
                </option>
              ))}
            </select>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label htmlFor="weaponType" className="block text-sm font-medium text-gray-700 mb-2">
              Tipe Senjata
            </label>
            <select
              id="weaponType"
              name="weaponType"
              value={formData.weaponType}
              onChange={handleChange}
              className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
            >
              <option value="">Pilih tipe senjata</option>
              <option value="Bow">Bow</option>
              <option value="Catalyst">Catalyst</option>
              <option value="Sword">Sword</option>
              <option value="Claymore">Claymore</option>
              <option value="Polearm">Polearm</option>
            </select>
          </div>

          <div>
            <label htmlFor="weaponName" className="block text-sm font-medium text-gray-700 mb-2">
              Senjata
            </label>
            <input
              id="weaponName"
              name="weaponName"
              type="text"
              value={formData.weaponName}
              onChange={handleChange}
              className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
              placeholder="Masukkan nama senjata"
            />
          </div>
        </div>

        <div>
          <label htmlFor="artifact" className="block text-sm font-medium text-gray-700 mb-2">
            Artifak
          </label>
          <input
            id="artifact"
            name="artifact"
            type="text"
            value={formData.artifact}
            onChange={handleChange}
            className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
            placeholder="Masukkan nama artifak"
          />
        </div>

        <div>
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Level Talent</h3>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label htmlFor="normalAttackLevel" className="block text-sm font-medium text-gray-700 mb-2">
                Normal Attack
              </label>
              <select
                id="normalAttackLevel"
                name="normalAttackLevel"
                value={formData.normalAttackLevel}
                onChange={handleChange}
                className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
              >
                <option value="">Pilih level</option>
                {Array.from({ length: 13 }, (_, i) => i + 1).map((level) => (
                  <option key={level} value={level}>
                    {level}
                  </option>
                ))}
              </select>
            </div>

            <div>
              <label htmlFor="elementalSkillLevel" className="block text-sm font-medium text-gray-700 mb-2">
                Elemental Skill
              </label>
              <select
                id="elementalSkillLevel"
                name="elementalSkillLevel"
                value={formData.elementalSkillLevel}
                onChange={handleChange}
                className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
              >
                <option value="">Pilih level</option>
                {Array.from({ length: 13 }, (_, i) => i + 1).map((level) => (
                  <option key={level} value={level}>
                    {level}
                  </option>
                ))}
              </select>
            </div>

            <div>
              <label htmlFor="elementalBurstLevel" className="block text-sm font-medium text-gray-700 mb-2">
                Elemental Burst
              </label>
              <select
                id="elementalBurstLevel"
                name="elementalBurstLevel"
                value={formData.elementalBurstLevel}
                onChange={handleChange}
                className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
              >
                <option value="">Pilih level</option>
                {Array.from({ length: 13 }, (_, i) => i + 1).map((level) => (
                  <option key={level} value={level}>
                    {level}
                  </option>
                ))}
              </select>
            </div>
          </div>
        </div>

        <button
          type="submit"
          disabled={isLoading}
          className="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed"
        >
          {isLoading ? 'Menambahkan...' : 'Tambah Karakter'}
        </button>
      </form>
    </div>
  );
}
