import Header from '@/components/Header';
import Footer from '@/components/Footer';
import SignUpForm from '@/components/SignUpForm';

export default function SignUpPage() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />

      <main className="flex-grow bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <SignUpForm />
      </main>

      <Footer />
    </div>
  );
}
