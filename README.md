# Tukang Spin

## Deskripsi
Proyek ini adalah aplikasi *Spinner Wheel* berbasis web yang dirancang untuk mempermudah pengambilan keputusan acak atau penentuan pemenang secara interaktif. Aplikasi ini memungkinkan pengguna untuk memutar roda keberuntungan dengan antarmuka yang bersih, intuitif, dan responsif, serta dilengkapi dengan fitur riwayat pemenang.

## Teknologi
- Next.js 16 untuk *framework* React dengan performa tinggi
- React 19 untuk manajemen *state* dan komponen UI
- Tailwind CSS 4 untuk gaya dan tata letak yang modern
- TypeScript untuk pengembangan kode yang lebih aman dan terstruktur

## Struktur Folder
```
root/
├── app/
│   ├── layout.tsx
│   └── page.tsx
├── components/
│   ├── Controls.tsx
│   ├── History.tsx
│   ├── LandingPage.tsx
│   ├── SpinnerWheel.tsx
│   └── WinnerModal.tsx
├── hooks/
│   └── useSpinner.ts
├── public/
└── README.md
```

## Cara Menjalankan
1. Unduh atau *clone* proyek
2. Buka folder proyek
3. Jalankan `npm install` untuk menginstal dependensi
4. Jalankan `npm run dev` untuk memulai server pengembangan
5. Buka `http://localhost:3000` di browser Anda

## Domain
Website dapat diakses melalui:
https://tukang-spin.vercel.app/

---
Dikembangkan oleh: @franzxml
