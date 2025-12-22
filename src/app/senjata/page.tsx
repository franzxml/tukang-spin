'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

interface Weapon {
  id: number;
  name: string;
  type: string | null;
  rarity: number | null;
  base_attack: number | null;
  secondary_stat: string | null;
  passive_ability: string | null;
  created_at: string;
  updated_at: string;
}

export default function SenjataPage() {
  const router = useRouter();
  const [userId, setUserId] = useState<number | null>(null);
  const [weapons, setWeapons] = useState<Weapon[]>([]);
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
    loadWeapons(user.id);
  }, [router]);

  const loadWeapons = async (uid: number) => {
    try {
      setIsLoading(true);
      const response = await fetch(`/api/weapons?userId=${uid}`);
      const data = await response.json();

      if (response.ok) {
        setWeapons(data.weapons);
      }
    } catch (error) {
      console.error('Error loading weapons:', error);
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
            <h1 className="text-4xl font-bold text-gray-900">Senjata</h1>
            <button
              onClick={() => router.push('/senjata/tambah')}
              className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
            >
              Tambah Senjata
            </button>
          </div>

          <div className="bg-white rounded-2xl shadow-xl p-8">
            <h2 className="text-2xl font-bold text-gray-900 mb-6">Daftar Senjata</h2>

            {isLoading ? (
              <p className="text-gray-600">Memuat data senjata...</p>
            ) : weapons.length === 0 ? (
              <div className="text-center py-12">
                <p className="text-gray-600">Belum ada senjata. Tambahkan senjata pertama Anda!</p>
              </div>
            ) : (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {weapons.map((weapon) => (
                  <div
                    key={weapon.id}
                    className="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition"
                  >
                    <div className="flex justify-between items-start mb-4">
                      <h3 className="text-xl font-bold text-gray-900">{weapon.name}</h3>
                      {weapon.rarity && (
                        <span className="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full">
                          ⭐ {weapon.rarity}
                        </span>
                      )}
                    </div>

                    <div className="space-y-2 text-sm mb-4">
                      {weapon.type && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Tipe:</span> {weapon.type}
                        </p>
                      )}
                      {weapon.base_attack && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Base ATK:</span> {weapon.base_attack}
                        </p>
                      )}
                      {weapon.secondary_stat && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Secondary Stat:</span> {weapon.secondary_stat}
                        </p>
                      )}
                      {weapon.passive_ability && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Passive:</span> {weapon.passive_ability}
                        </p>
                      )}
                    </div>

                    <p className="text-xs text-gray-500 mt-4 pt-4 border-t">
                      Dibuat: {new Date(weapon.created_at).toLocaleDateString('id-ID')}
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
