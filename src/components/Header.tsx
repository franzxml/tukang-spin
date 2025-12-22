import Link from 'next/link';

export default function Header() {
  return (
    <header className="bg-white shadow-sm border-b">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-center items-center h-16">
          <Link href="/" className="text-2xl font-bold text-blue-600">
            Genpedia
          </Link>
        </div>
      </div>
    </header>
  );
}
