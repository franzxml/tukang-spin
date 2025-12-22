'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

interface Character {
  id: number;
  name: string;
  level: number | null;
  weapon_type: string | null;
  weapon_name: string | null;
  artifact: string | null;
  normal_attack_level: number | null;
  elemental_skill_level: number | null;
  elemental_burst_level: number | null;
  created_at: string;
  updated_at: string;
}

export default function KarakterPage() {
  const router = useRouter();
  const [userId, setUserId] = useState<number | null>(null);
  const [characters, setCharacters] = useState<Character[]>([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    // Check if user is logged in
    const userStr = localStorage.getItem('user');
    if (!userStr) {
      router.push('/');
      return;
    }

    const user = JSON.parse(userStr);
    setUserId(user.id);
    loadCharacters(user.id);
  }, [router]);

  const loadCharacters = async (uid: number) => {
    try {
      setIsLoading(true);
      const response = await fetch(`/api/characters?userId=${uid}`);
      const data = await response.json();

      if (response.ok) {
        setCharacters(data.characters);
      }
    } catch (error) {
      console.error('Error loading characters:', error);
    } finally {
      setIsLoading(false);
    }
  };

  if (!userId) {
    return null;
  }

  return (
    <div className="min-h-screen flex flex-col">
      <Header />

      <main className="flex-grow bg-gradient-to-br from-blue-50 to-indigo-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="flex justify-between items-center mb-8">
            <h1 className="text-4xl font-bold text-gray-900">Karakter</h1>
            <button
              onClick={() => router.push('/karakter/tambah')}
              className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
            >
              Tambah Karakter
            </button>
          </div>

          <div className="bg-white rounded-2xl shadow-xl p-8">
            <h2 className="text-2xl font-bold text-gray-900 mb-6">Daftar Karakter</h2>

            {isLoading ? (
              <p className="text-gray-600">Memuat data karakter...</p>
            ) : characters.length === 0 ? (
              <div className="text-center py-12">
                <p className="text-gray-600">Belum ada karakter. Tambahkan karakter pertama Anda!</p>
              </div>
            ) : (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {characters.map((character) => (
                  <div
                    key={character.id}
                    className="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition"
                  >
                    <div className="flex justify-between items-start mb-4">
                      <h3 className="text-xl font-bold text-gray-900">{character.name}</h3>
                      {character.level && (
                        <span className="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                          Lv. {character.level}
                        </span>
                      )}
                    </div>

                    <div className="space-y-2 text-sm mb-4">
                      {character.weapon_type && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Tipe Senjata:</span> {character.weapon_type}
                        </p>
                      )}
                      {character.weapon_name && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Senjata:</span> {character.weapon_name}
                        </p>
                      )}
                      {character.artifact && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Artifak:</span> {character.artifact}
                        </p>
                      )}
                    </div>

                    {(character.normal_attack_level || character.elemental_skill_level || character.elemental_burst_level) && (
                      <div className="border-t pt-4 mt-4">
                        <p className="text-sm font-semibold text-gray-900 mb-2">Level Talent:</p>
                        <div className="grid grid-cols-3 gap-2 text-xs">
                          {character.normal_attack_level && (
                            <div className="text-center">
                              <p className="text-gray-600">Normal Attack</p>
                              <p className="font-bold text-blue-600 text-lg">{character.normal_attack_level}</p>
                            </div>
                          )}
                          {character.elemental_skill_level && (
                            <div className="text-center">
                              <p className="text-gray-600">Skill</p>
                              <p className="font-bold text-blue-600 text-lg">{character.elemental_skill_level}</p>
                            </div>
                          )}
                          {character.elemental_burst_level && (
                            <div className="text-center">
                              <p className="text-gray-600">Burst</p>
                              <p className="font-bold text-blue-600 text-lg">{character.elemental_burst_level}</p>
                            </div>
                          )}
                        </div>
                      </div>
                    )}

                    <p className="text-xs text-gray-500 mt-4 pt-4 border-t">
                      Dibuat: {new Date(character.created_at).toLocaleDateString('id-ID')}
                    </p>
                  </div>
                ))}
              </div>
            )}
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
}
