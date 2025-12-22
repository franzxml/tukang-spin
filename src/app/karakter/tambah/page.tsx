'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import Header from '@/components/Header';
import Footer from '@/components/Footer';
import AddCharacterForm from '@/components/AddCharacterForm';

export default function TambahKarakterPage() {
  const router = useRouter();
  const [userId, setUserId] = useState<number | null>(null);

  useEffect(() => {
    // Check if user is logged in
    const userStr = localStorage.getItem('user');
    if (!userStr) {
      router.push('/');
      return;
    }

    const user = JSON.parse(userStr);
    setUserId(user.id);
  }, [router]);

  const handleCharacterAdded = () => {
    // Redirect back to character list
    router.push('/karakter');
  };

  if (!userId) {
    return null;
  }

  return (
    <div className="min-h-screen flex flex-col">
      <Header />

      <main className="flex-grow bg-gradient-to-br from-blue-50 to-indigo-100">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="mb-6">
            <button
              onClick={() => router.push('/karakter')}
              className="text-blue-600 hover:text-blue-700 font-semibold flex items-center"
            >
              <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
              </svg>
              Kembali ke Daftar Karakter
            </button>
          </div>

          <AddCharacterForm userId={userId} onCharacterAdded={handleCharacterAdded} />
        </div>
      </main>

      <Footer />
    </div>
  );
}
