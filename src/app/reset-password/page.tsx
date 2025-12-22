import Header from '@/components/Header';
import Footer from '@/components/Footer';
import ResetPasswordForm from '@/components/ResetPasswordForm';
import { Suspense } from 'react';

function ResetPasswordContent() {
  return <ResetPasswordForm />;
}

export default function ResetPasswordPage() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />

      <main className="flex-grow bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <Suspense fallback={<div>Loading...</div>}>
          <ResetPasswordContent />
        </Suspense>
      </main>

      <Footer />
    </div>
  );
}
