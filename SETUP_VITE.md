# Setup Vite untuk Development

## Masalah
Error "Vite manifest not found" terjadi karena asset Vite belum di-build.

## Solusi Sementara (Sudah Diterapkan)
File manifest.json dan asset CSS/JS dasar sudah dibuat secara manual di `public/build/`. Aplikasi seharusnya sudah bisa berjalan.

## Solusi Permanen (Recommended)

### 1. Install Node.js
Download dan install Node.js dari: https://nodejs.org/
- Pilih versi LTS (Long Term Support)
- Setelah install, restart terminal/command prompt

### 2. Install Dependencies
```bash
npm install
```

### 3. Build Assets untuk Production
```bash
npm run build
```

### 4. Atau Jalankan Development Server (Hot Reload)
```bash
npm run dev
```

Lalu jalankan Laravel di terminal lain:
```bash
php artisan serve
```

## Catatan
- File di `public/build/` adalah hasil build dari Vite
- Untuk development dengan hot reload, gunakan `npm run dev`
- Untuk production, gunakan `npm run build`
- Jangan commit folder `node_modules/` dan `public/build/` ke git (sudah ada di .gitignore)

## Troubleshooting

### Jika npm tidak dikenali:
1. Pastikan Node.js sudah terinstall
2. Restart terminal/command prompt
3. Cek dengan: `node --version` dan `npm --version`

### Jika build error:
1. Hapus `node_modules/` dan `package-lock.json`
2. Jalankan `npm install` lagi
3. Coba `npm run build` lagi

