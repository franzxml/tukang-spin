'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

export default function DashboardPage() {
  const router = useRouter();
  const [username, setUsername] = useState('');

  useEffect(() => {
    // Check if user is logged in
    const userStr = localStorage.getItem('user');
    if (!userStr) {
      router.push('/');
      return;
    }

    const user = JSON.parse(userStr);
    setUsername(user.username);
  }, [router]);

  if (!username) {
    return null; // or loading spinner
  }

  return (
    <div className="min-h-screen flex flex-col">
      <Header />

      <main className="flex-grow bg-gradient-to-br from-blue-50 to-indigo-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="text-center">
            <div className="bg-white rounded-2xl shadow-xl p-12 max-w-4xl mx-auto">
              <h1 className="text-5xl font-bold text-gray-900 mb-4">
                Selamat datang di Genpedia!
              </h1>
              <p className="text-xl text-gray-600 mb-6">
                Halo, <span className="font-semibold text-blue-600">{username}</span>
              </p>
              <p className="text-gray-500">
                Anda telah berhasil login ke sistem Genpedia
              </p>
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
}
