'use client';

import Link from 'next/link';
import { useRouter, usePathname } from 'next/navigation';
import { useEffect, useState } from 'react';

export default function Header() {
  const router = useRouter();
  const pathname = usePathname();
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  useEffect(() => {
    const userStr = localStorage.getItem('user');
    setIsLoggedIn(!!userStr);
  }, [pathname]);

  const handleLogout = () => {
    localStorage.removeItem('user');
    router.push('/');
  };

  return (
    <header className="bg-white shadow-sm border-b">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center space-x-8">
            <Link href={isLoggedIn ? "/dashboard" : "/"} className="text-2xl font-bold text-blue-600">
              Genpedia
            </Link>

            {isLoggedIn && (
              <nav className="flex space-x-6">
                <Link
                  href="/karakter"
                  className="text-gray-700 hover:text-blue-600 font-medium transition"
                >
                  Karakter
                </Link>
                <Link
                  href="/senjata"
                  className="text-gray-700 hover:text-blue-600 font-medium transition"
                >
                  Senjata
                </Link>
                <Link
                  href="/artifak"
                  className="text-gray-700 hover:text-blue-600 font-medium transition"
                >
                  Artifak
                </Link>
              </nav>
            )}
          </div>

          {isLoggedIn && (
            <button
              onClick={handleLogout}
              className="text-sm text-gray-700 hover:text-blue-600 font-semibold transition"
            >
              Logout
            </button>
          )}
        </div>
      </div>
    </header>
  );
}
