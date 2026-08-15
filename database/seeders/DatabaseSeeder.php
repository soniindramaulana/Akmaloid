<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1. Kategori Produk
        DB::table('kategori_produks')->insert([
        ['id' => 1, 'name' => 'Koran', 'deskripsi' => 'Koran adalah terbitan harian berisi berita dan informasi terkini, biasanya dicetak pada kertas buram berukuran besar.', 'foto' => 'images/kategori_produk/kate_koran.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'name' => 'Majalah', 'deskripsi' => 'Majalah adalah terbitan berkala (mingguan atau bulanan) yang fokus pada topik spesifik seperti gaya hidup, sains, atau hobi.', 'foto' => 'images/kategori_produk/kate_majalah.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'name' => 'Tabloid', 'deskripsi' => 'Tabloid adalah terbitan yang ukurannya lebih kecil dari koran, dengan konten yang seringkali ringan, sensasional, atau hiburan.', 'foto' => 'images/kategori_produk/kate_tabloid.jpg', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 2. Periodes
        DB::table('periodes')->insert([
        ['id' => 1, 'periode' => 'Harian', 'deskripsi' => 'Dapatkan berita terbaru setiap hari, dikirim langsung untuk memastikan Anda selalu up-to-date dari pagi.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'periode' => 'Mingguan', 'deskripsi' => 'Ringkasan berita dan fitur mendalam, dikirim sekali seminggu. Ideal untuk ulasan dan analisis.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'periode' => 'Setengah Bulanan', 'deskripsi' => 'Pengiriman dua kali dalam sebulan. Pilihan tepat untuk majalah dan publikasi dengan konten spesifik.', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 4, 'periode' => 'Bulanan', 'deskripsi' => 'Publikasi dikirimkan sebulan sekali. Cocok untuk majalah premium, laporan khusus, atau tabloid gaya hidup.', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 3. Penerbits
        DB::table('penerbits')->insert([
        ['id' => 1, 'name' => 'Bernas', 'alamat' => 'Yogyakarta, DIY', 'deskripsi' => 'Media regional Yogyakarta, budaya, dan politik lokal.', 'logo' => 'images/penerbit/bernas-online.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'name' => 'Jawa Pos Group', 'alamat' => 'Surabaya, Jawa Timur', 'deskripsi' => 'Menerbitkan harian Jawa Pos dan ratusan koran regional.', 'logo' => 'images/penerbit/jawapos.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'name' => 'Kompas Gramedia (KG)', 'alamat' => 'Jakarta Pusat', 'deskripsi' => 'Menerbitkan harian nasional Harian Kompas.', 'logo' => 'images/penerbit/kompasgramedia.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 4, 'name' => 'Kontan', 'alamat' => 'Jakarta Pusat', 'deskripsi' => 'Fokus secara spesifik pada berita ekonomi, bisnis, dan investasi.', 'logo' => 'images/penerbit/kontan.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 5, 'name' => 'SINDONEWS.com', 'alamat' => 'Jakarta Pusat', 'deskripsi' => 'Portal berita digital di bawah MNC Group.', 'logo' => 'images/penerbit/sindonews.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 6, 'name' => 'Bisnis.com', 'alamat' => 'Jakarta Pusat', 'deskripsi' => 'Penerbit koran harian Bisnis Indonesia.', 'logo' => 'images/penerbit/bisnis.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 7, 'name' => 'MNC Group', 'alamat' => 'Jakarta Pusat', 'deskripsi' => 'Grup media terintegrasi.', 'logo' => 'images/penerbit/mncgroup.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 8, 'name' => 'Suara Merdeka Group', 'alamat' => 'Semarang, Jawa Tengah.', 'deskripsi' => 'Surat kabar harian terbesar di wilayah Jawa Tengah.', 'logo' => 'images/penerbit/suaramerdeka.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 9, 'name' => 'SWA Media Group', 'alamat' => 'Jakarta Selatan', 'deskripsi' => 'Penerbit majalah bisnis SWA.', 'logo' => 'images/penerbit/swa.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 10, 'name' => 'SinarHarapan.com', 'alamat' => 'Jakarta Pusat', 'deskripsi' => 'Koran sore legendaris bertransformasi ke media online.', 'logo' => 'images/penerbit/sinarharapan.png', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 4. Pakets
        DB::table('pakets')->insert([
        ['id' => 1, 'kategori_produk_id' => 1, 'penerbit_id' => 2, 'periode_id' => 1, 'name' => 'Jawa Pos', 'waktu_pengiriman' => 'Sore', 'harga_paket' => 35017, 'deskripsi' => 'Koran harian Jawa Pos.', 'gambar' => 'images/produk/jawapos.jpeg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'kategori_produk_id' => 3, 'penerbit_id' => 2, 'periode_id' => 2, 'name' => 'Bintang', 'waktu_pengiriman' => 'Sore', 'harga_paket' => 48525, 'deskripsi' => 'Tabloid mingguan hiburan.', 'gambar' => 'images/produk/jawapos_tabloidbintang.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'kategori_produk_id' => 2, 'penerbit_id' => 2, 'periode_id' => 4, 'name' => 'For Him', 'waktu_pengiriman' => 'Siang', 'harga_paket' => 90305, 'deskripsi' => 'Majalah pria bulanan.', 'gambar' => 'images/produk/jawapos_majalah.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 4, 'kategori_produk_id' => 1, 'penerbit_id' => 6, 'periode_id' => 1, 'name' => 'Bisnis Indonesia', 'waktu_pengiriman' => 'Sore', 'harga_paket' => 89079, 'deskripsi' => 'Koran harian bisnis.', 'gambar' => 'images/produk/bisnisindonesia.jpeg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 5, 'kategori_produk_id' => 3, 'penerbit_id' => 7, 'periode_id' => 2, 'name' => 'Genie', 'waktu_pengiriman' => 'Pagi', 'harga_paket' => 32864, 'deskripsi' => 'Tabloid selebriti.', 'gambar' => 'images/produk/mncgroup_tabloid.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 6, 'kategori_produk_id' => 1, 'penerbit_id' => 3, 'periode_id' => 1, 'name' => 'Kompas', 'waktu_pengiriman' => 'Siang', 'harga_paket' => 35501, 'deskripsi' => 'Koran harian Kompas.', 'gambar' => 'images/produk/kompas5.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 7, 'kategori_produk_id' => 2, 'penerbit_id' => 9, 'periode_id' => 4, 'name' => 'SWA', 'waktu_pengiriman' => 'Sore', 'harga_paket' => 85735, 'deskripsi' => 'Majalah bisnis SWA.', 'gambar' => 'images/produk/swa.jpeg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 8, 'kategori_produk_id' => 1, 'penerbit_id' => 8, 'periode_id' => 1, 'name' => 'Suara Merdeka', 'waktu_pengiriman' => 'Sore', 'harga_paket' => 53490, 'deskripsi' => 'Koran Suara Merdeka.', 'gambar' => 'images/produk/suaramerdeka6.jpeg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 9, 'kategori_produk_id' => 2, 'penerbit_id' => 9, 'periode_id' => 3, 'name' => 'MIX', 'waktu_pengiriman' => 'Siang', 'harga_paket' => 36739, 'deskripsi' => 'Majalah pemasaran MIX.', 'gambar' => 'images/produk/swamix.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 10, 'kategori_produk_id' => 1, 'penerbit_id' => 1, 'periode_id' => 1, 'name' => 'Harian bernas', 'waktu_pengiriman' => 'Siang', 'harga_paket' => 93719, 'deskripsi' => 'Koran Harian Bernas.', 'gambar' => 'images/produk/bernas.jpg', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 5. Slideshows
        DB::table('slide_shows')->insert([
        ['id' => 1, 'judul' => 'Akses Berita Kapan Saja', 'sub_judul' => 'Langganan semua media favorit Anda dalam satu platform digital.', 'deskripsi' => 'Dapatkan koran, majalah, dan tabloid terbaik.', 'button' => 'Cek Harga', 'icon' => 'images/slideshow/icon/cekharga.png', 'gambar' => 'images/slideshow/gambar/cekharga.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'judul' => 'Baca Kompas dan JawaPos', 'sub_judul' => 'Ratusan judul media terkemuka, dari koran hingga majalah bisnis.', 'deskripsi' => 'Semua informasi terbaru dari penerbit ternama ada di genggaman Anda.', 'button' => 'Lihat Pilihan', 'icon' => 'images/slideshow/icon/lihatpilihan.png', 'gambar' => 'images/slideshow/gambar/lihatpilihan.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'judul' => 'Langganan Mulai Harian', 'sub_judul' => 'Pilih periode langganan (harian, mingguan, bulanan) dengan harga terbaik.', 'deskripsi' => 'Tetap terinformasi tanpa repot membeli eceran.', 'button' => 'Mulai Langganan', 'icon' => 'images/slideshow/icon/mulailangganan.png', 'gambar' => 'images/slideshow/gambar/mulailangganan.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 4, 'judul' => 'Informasi Bisnis Terkini', 'sub_judul' => 'Akses Majalah SWA, Kontan, dan Bisnis Indonesia setiap hari.', 'deskripsi' => 'Tingkatkan wawasan bisnis dan investasi Anda.', 'button' => 'Daftar Sekarang', 'icon' => 'images/slideshow/icon/daftarsekarang.png', 'gambar' => 'images/slideshow/gambar/daftarsekarang.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 5, 'judul' => 'Koleksi Digital Lengkap', 'sub_judul' => 'Jelajahi riwayat publikasi dari penerbit ternama Indonesia.', 'deskripsi' => 'Cari berita lama atau baca ulang edisi favorit.', 'button' => 'Lihat Koleksi', 'icon' => 'images/slideshow/icon/lihatkoleksi.png', 'gambar' => 'images/slideshow/gambar/lihatkoleksi.jpg', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 6. Wallets
        DB::table('wallets')->insert([
        ['id' => 1, 'e_wallet' => 'Dana', 'nama_rek' => 'Jamal Corwin', 'no_rek' => '729309781', 'gambar' => 'images/wallet/dana.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'e_wallet' => 'BCA', 'nama_rek' => 'Kristofer Jerde', 'no_rek' => '504164085788', 'gambar' => 'images/wallet/bca.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'e_wallet' => 'Mandiri', 'nama_rek' => 'Lou Stokes', 'no_rek' => '379590074', 'gambar' => 'images/wallet/mandiri.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 4, 'e_wallet' => 'Bank Jatim', 'nama_rek' => 'Prof. Trent Torphy Jr.', 'no_rek' => '7194327946085', 'gambar' => 'images/wallet/bank jatim.png', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 5, 'e_wallet' => 'PayPal', 'nama_rek' => 'Dr. Novella Carroll', 'no_rek' => '649323695', 'gambar' => 'images/wallet/paypal.png', 'created_at' => now(), 'updated_at' => now()]
        ]);
        // \App\Models\User::factory(10)->create();
        // \App\Models\KategoriProduk::factory(3)->create();
        // \App\Models\Penerbit::factory(10)->create();
        // \App\Models\Periode::factory(4)->create();
        // \App\Models\SlideShow::factory(5)->create();
        // \App\Models\Wallet::factory()->count(5)->create();

        // $this->call([
        //     PaketSeeder::class,
        // ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
