<?php

namespace App\Services;

class AICategorizationService
{
    /**
     * Kategori-kategori yang tersedia
     */
    private array $categories = [
        'Makanan & Minuman' => ['makan', 'restoran', 'warung', 'kafe', 'minum', 'kopi', 'makanan', 'food', 'restaurant', 'warung makan', 'warkop', 'bakso', 'mie ayam', 'nasi goreng', 'ayam goreng', 'pizza', 'burger', 'fast food', 'minuman', 'jus', 'es', 'snack', 'jajan'],
        'Transportasi' => ['bensin', 'parkir', 'ojek', 'grab', 'gojek', 'taxi', 'transport', 'tol', 'kereta', 'bus', 'angkot', 'angkutan', 'bensin', 'solar', 'premium', 'pertalite', 'pertamax', 'parkir', 'parking', 'tiket', 'ticket', 'pesawat', 'flight', 'kapal', 'ferry'],
        'Belanja' => ['belanja', 'supermarket', 'mall', 'toko', 'shopping', 'market', 'swalayan', 'minimarket', 'indomaret', 'alfamart', 'superindo', 'hypermart', 'carrefour', 'pasar', 'online shop', 'ecommerce', 'tokopedia', 'shopee', 'lazada', 'bukalapak'],
        'Hiburan' => ['bioskop', 'konser', 'game', 'hobi', 'entertainment', 'tiket', 'cinema', 'film', 'movie', 'netflix', 'disney', 'hbo', 'vix', 'konser', 'concert', 'event', 'tiket konser', 'tiket event', 'permainan', 'playstation', 'xbox', 'nintendo', 'steam', 'game online'],
        'Kesehatan' => ['dokter', 'rumah sakit', 'obat', 'apotek', 'kesehatan', 'medical', 'hospital', 'klinik', 'puskesmas', 'rs', 'rumah sakit', 'check up', 'medical check', 'vitamin', 'suplemen', 'farmasi', 'pharmacy', 'dokter gigi', 'dokter mata', 'spa', 'massage', 'pijat', 'fisioterapi'],
        'Pendidikan' => ['sekolah', 'kuliah', 'kursus', 'buku', 'pendidikan', 'education', 'spp', 'uang sekolah', 'biaya sekolah', 'tuition', 'les', 'bimbel', 'bimbingan belajar', 'tutor', 'buku pelajaran', 'atk', 'alat tulis', 'seragam', 'sepatu sekolah'],
        'Tagihan & Utilitas' => ['listrik', 'air', 'internet', 'telepon', 'pulsa', 'tagihan', 'bill', 'pln', 'pdam', 'pam', 'wifi', 'indihome', 'first media', 'biznet', 'myrepublic', 'telkomsel', 'indosat', 'xl', 'tri', 'smartfren', 'kartu perdana', 'paket data', 'kuota', 'pascabayar', 'prabayar'],
        'Langganan & Subscription' => ['spotify', 'netflix', 'disney', 'hbo', 'vix', 'youtube premium', 'youtube', 'disney+', 'disney plus', 'amazon prime', 'prime video', 'apple music', 'apple tv', 'canva', 'adobe', 'microsoft', 'office 365', 'google workspace', 'notion', 'figma', 'subscription', 'langganan', 'membership', 'premium', 'pro', 'subscription', 'abonnement'],
        'Top Up & E-Wallet' => ['top up', 'topup', 'saldo', 'gopay', 'ovo', 'dana', 'linkaja', 'shopeepay', 'doku', 'jenius', 'bca mobile', 'mandiri e-wallet', 'bni mobile', 'e-wallet', 'dompet digital', 'pulsa', 'paket data', 'kuota internet', 'steam wallet', 'google play', 'app store', 'itunes', 'voucher game', 'voucher'],
        'Fashion & Pakaian' => ['baju', 'pakaian', 'baju', 'celana', 'kaos', 'kemeja', 'jaket', 'sepatu', 'sandal', 'tas', 'dompet', 'jam tangan', 'aksesoris', 'fashion', 'clothing', 'apparel', 'zara', 'h&m', 'uniqlo', 'cotton on'],
        'Kecantikan & Perawatan' => ['kosmetik', 'makeup', 'skincare', 'parfum', 'sabun', 'shampoo', 'kondisioner', 'salon', 'barbershop', 'potong rambut', 'facial', 'facial treatment', 'spa', 'manicure', 'pedicure', 'nail art'],
        'Investasi' => ['saham', 'reksadana', 'emas', 'investasi', 'investment', 'trading', 'forex', 'crypto', 'bitcoin', 'ethereum', 'saham', 'stock', 'obligasi', 'bonds', 'deposito', 'deposit', 'mutual fund', 'reksadana', 'gold', 'silver'],
        'Tabungan & Deposito' => ['tabungan', 'deposit', 'saving', 'menabung', 'setoran', 'deposito', 'savings account', 'time deposit'],
        'Donasi & Zakat' => ['donasi', 'donation', 'zakat', 'infak', 'sedekah', 'charity', 'amal', 'wakaf'],
        'Hiburan & Rekreasi' => ['liburan', 'vacation', 'hotel', 'penginapan', 'travel', 'wisata', 'tiket wisata', 'tiket masuk', 'taman bermain', 'waterpark', 'theme park', 'dunia fantasi', 'dufan', 'trans studio', 'jogja', 'bali', 'bandung'],
        'Olahraga & Fitness' => ['gym', 'fitness', 'olahraga', 'sport', 'sepatu olahraga', 'alat olahraga', 'membership gym', 'personal trainer', 'yoga', 'pilates', 'zumba'],
        'Hobi & Koleksi' => ['hobi', 'koleksi', 'action figure', 'figure', 'komik', 'manga', 'novel', 'buku', 'kamera', 'lensa', 'fotografi', 'photography', 'gitar', 'piano', 'musik', 'instrumen musik'],
        'Perbaikan & Maintenance' => ['service', 'servis', 'perbaikan', 'repair', 'maintenance', 'service motor', 'service mobil', 'bengkel', 'workshop', 'sparepart', 'suku cadang'],
        'Hadiah & Kado' => ['hadiah', 'kado', 'gift', 'present', 'parsel', 'bunga', 'karangan bunga'],
        'Lainnya' => [],
    ];

    /**
     * Kategorisasi transaksi berdasarkan deskripsi menggunakan AI sederhana
     */
    public function categorize(string $deskripsi, string $jenis): string
    {
        $deskripsi = strtolower($deskripsi);
        
        // Cek setiap kategori
        foreach ($this->categories as $kategori => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($deskripsi, strtolower($keyword))) {
                    return $kategori;
                }
            }
        }

        // Jika tidak ditemukan, gunakan kategori default berdasarkan jenis
        if ($jenis === 'pemasukkan') {
            return 'Pendapatan';
        }

        return 'Lainnya';
    }

    /**
     * Prediksi kategori berdasarkan pola transaksi sebelumnya
     */
    public function predictCategory(array $transaksiHistory, string $deskripsi): string
    {
        $deskripsi = strtolower($deskripsi);
        
        // Cari transaksi dengan deskripsi serupa
        foreach ($transaksiHistory as $transaksi) {
            $similarity = $this->calculateSimilarity($deskripsi, strtolower($transaksi['deskripsi'] ?? ''));
            if ($similarity > 0.5 && isset($transaksi['kategori'])) {
                return $transaksi['kategori'];
            }
        }

        // Fallback ke kategorisasi biasa
        return $this->categorize($deskripsi, 'pengeluaran');
    }

    /**
     * Hitung similarity antara dua string
     */
    private function calculateSimilarity(string $str1, string $str2): float
    {
        similar_text($str1, $str2, $percent);
        return $percent / 100;
    }

    /**
     * Dapatkan semua kategori yang tersedia
     */
    public function getAvailableCategories(): array
    {
        $categories = array_keys($this->categories);
        // Tambahkan kategori Pendapatan untuk pemasukkan
        if (!in_array('Pendapatan', $categories)) {
            $categories[] = 'Pendapatan';
        }
        return $categories;
    }
}

