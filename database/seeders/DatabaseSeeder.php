<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan Faker bahasa Indonesia

        // 1. Buat Kategori Dummy
        $kategoriNames = ['Novel', 'Teknologi', 'Sains', 'Komik', 'Bisnis', 'Sejarah'];
        $kategoriIds = [];

        foreach ($kategoriNames as $nama) {
            $kategori = Kategori::create([
                'nama_kategori' => $nama
            ]);
            $kategoriIds[] = $kategori->id;
        }

        // Pastikan folder covers ada
        Storage::disk('public')->makeDirectory('covers');

        echo "Sedang mendownload gambar dan membuat data buku... Mohon tunggu sebentar.\n";

        // 2. Loop 20 kali untuk membuat Buku
        for ($i = 1; $i <= 20; $i++) {

            // LOGIKA GAMBAR:
            // Kita download file dari picsum dan simpan fisik filenya
            // agar fitur Storage::delete() di controller Anda tidak error.

            $imageUrl = 'https://picsum.photos/200';
            $imageContent = file_get_contents($imageUrl);
            $imageName = 'covers/buku_' . $i . '_' . uniqid() . '.jpg';

            // Simpan ke storage public
            Storage::disk('public')->put($imageName, $imageContent);

            // Ambil Kategori Acak
            $randomKategoriId = $kategoriIds[array_rand($kategoriIds)];

            Buku::create([
                'judul'        => $faker->sentence(3),
                'penulis'      => $faker->name,
                'penerbit'     => $faker->company,
                'tahun_terbit' => $faker->year,

                // Gunakan ID kategori (Relasi)
                // Jika Anda masih pakai String, ganti baris ini jadi: 'kategori' => 'Novel',
                'kategori_id'  => $randomKategoriId,

                'deskripsi'    => $faker->paragraph(3),
                'stok'         => $faker->numberBetween(0, 50),
                'cover_image'  => $imageName, // Simpan path gambar
            ]);

            echo "Buku ke-$i berhasil dibuat.\n";
        }
    }
}
