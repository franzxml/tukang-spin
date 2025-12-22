'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

interface Artifact {
  id: number;
  name: string;
  set_name: string | null;
  rarity: number | null;
  main_stat: string | null;
  sub_stats: string | null;
  slot_type: string | null;
  created_at: string;
  updated_at: string;
}

export default function ArtifakPage() {
  const router = useRouter();
  const [userId, setUserId] = useState<number | null>(null);
  const [artifacts, setArtifacts] = useState<Artifact[]>([]);
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
    loadArtifacts(user.id);
  }, [router]);

  const loadArtifacts = async (uid: number) => {
    try {
      setIsLoading(true);
      const response = await fetch(`/api/artifacts?userId=${uid}`);
      const data = await response.json();

      if (response.ok) {
        setArtifacts(data.artifacts);
      }
    } catch (error) {
      console.error('Error loading artifacts:', error);
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
            <h1 className="text-4xl font-bold text-gray-900">Artifak</h1>
            <button
              onClick={() => router.push('/artifak/tambah')}
              className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
            >
              Tambah Artifak
            </button>
          </div>

          <div className="bg-white rounded-2xl shadow-xl p-8">
            <h2 className="text-2xl font-bold text-gray-900 mb-6">Daftar Artifak</h2>

            {isLoading ? (
              <p className="text-gray-600">Memuat data artifak...</p>
            ) : artifacts.length === 0 ? (
              <div className="text-center py-12">
                <p className="text-gray-600">Belum ada artifak. Tambahkan artifak pertama Anda!</p>
              </div>
            ) : (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {artifacts.map((artifact) => (
                  <div
                    key={artifact.id}
                    className="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition"
                  >
                    <div className="flex justify-between items-start mb-4">
                      <h3 className="text-xl font-bold text-gray-900">{artifact.name}</h3>
                      {artifact.rarity && (
                        <span className="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full">
                          ⭐ {artifact.rarity}
                        </span>
                      )}
                    </div>

                    <div className="space-y-2 text-sm mb-4">
                      {artifact.set_name && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Set:</span> {artifact.set_name}
                        </p>
                      )}
                      {artifact.slot_type && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Slot:</span> {artifact.slot_type}
                        </p>
                      )}
                      {artifact.main_stat && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Main Stat:</span> {artifact.main_stat}
                        </p>
                      )}
                      {artifact.sub_stats && (
                        <p className="text-gray-700">
                          <span className="font-semibold">Sub Stats:</span> {artifact.sub_stats}
                        </p>
                      )}
                    </div>

                    <p className="text-xs text-gray-500 mt-4 pt-4 border-t">
                      Dibuat: {new Date(artifact.created_at).toLocaleDateString('id-ID')}
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
