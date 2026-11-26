<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Kategori
        $kategoris = [
            ['nama' => 'Espresso Based', 'slug' => 'espresso-based', 'deskripsi' => 'Minuman berbasis espresso premium'],
            ['nama' => 'Manual Brew', 'slug' => 'manual-brew', 'deskripsi' => 'Kopi seduh manual dengan teknik artisan'],
            ['nama' => 'Signature Series', 'slug' => 'signature-series', 'deskripsi' => 'Kreasi signature Essenza Coffee'],
            ['nama' => 'Non-Coffee', 'slug' => 'non-coffee', 'deskripsi' => 'Minuman non-kopi pilihan'],
            ['nama' => 'Food & Pastry', 'slug' => 'food-pastry', 'deskripsi' => 'Makanan dan pastry pendamping kopi'],
        ];

        foreach ($kategoris as $k) {
            Kategori::create($k);
        }

        $espresso = Kategori::where('slug', 'espresso-based')->first();
        $manual   = Kategori::where('slug', 'manual-brew')->first();
        $sig      = Kategori::where('slug', 'signature-series')->first();
        $nonCoffee = Kategori::where('slug', 'non-coffee')->first();
        $food     = Kategori::where('slug', 'food-pastry')->first();

        // Seed Produk
        $produks = [
            [
                'kategori_id'      => $espresso->id,
                'nama'             => 'Essenza Espresso',
                'slug'             => 'essenza-espresso',
                'harga'            => 32000,
                'deskripsi'        => 'Single origin espresso kami yang kuat dan intens, disajikan dalam shot sempurna dengan crema tebal berwarna emas. Biji kopi pilihan dari pegunungan Aceh Gayo diproses dengan metode washed untuk menghasilkan rasa bersih dan kompleks.',
                'deskripsi_singkat'=> 'Single origin espresso intens dengan crema sempurna.',
                'tersedia'         => true,
                'featured'         => true,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $espresso->id,
                'nama'             => 'Classic Cappuccino',
                'slug'             => 'classic-cappuccino',
                'harga'            => 42000,
                'deskripsi'        => 'Cappuccino klasik dengan rasio sempurna antara espresso, susu steam, dan milk foam. Dibuat dengan teknik barista terlatih untuk menghasilkan tekstur foam yang lembut dan cita rasa espresso yang seimbang.',
                'deskripsi_singkat'=> 'Cappuccino klasik dengan milk foam lembut.',
                'tersedia'         => true,
                'featured'         => true,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $espresso->id,
                'nama'             => 'Caramel Latte',
                'slug'             => 'caramel-latte',
                'harga'            => 48000,
                'deskripsi'        => 'Latte premium dengan drizzle karamel artisan yang manis dan lembut. Perpaduan espresso double shot, susu segar steamed, dan karamel homemade menciptakan minuman yang memanjakan selera.',
                'deskripsi_singkat'=> 'Latte premium dengan karamel artisan.',
                'tersedia'         => true,
                'featured'         => true,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $espresso->id,
                'nama'             => 'Flat White',
                'slug'             => 'flat-white',
                'harga'            => 44000,
                'deskripsi'        => 'Flat white dengan double ristretto dan microfoam susu yang halus. Cocok bagi pecinta kopi yang menginginkan rasa espresso kuat dengan tekstur susu yang creamy dan tidak terlalu besar porsinya.',
                'deskripsi_singkat'=> 'Double ristretto dengan microfoam susu premium.',
                'tersedia'         => true,
                'featured'         => false,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $manual->id,
                'nama'             => 'V60 Pour Over',
                'slug'             => 'v60-pour-over',
                'harga'            => 55000,
                'deskripsi'        => 'Pour over dengan teknik V60 menggunakan biji kopi single origin Ethiopia Yirgacheffe. Proses penyeduhan yang teliti menghasilkan cup yang bersih, floral, dan fruity dengan keasaman yang menyegarkan.',
                'deskripsi_singkat'=> 'Pour over V60 dengan biji single origin Ethiopia.',
                'tersedia'         => true,
                'featured'         => true,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $manual->id,
                'nama'             => 'Cold Brew',
                'slug'             => 'cold-brew',
                'harga'            => 52000,
                'deskripsi'        => 'Cold brew yang diseduh selama 18 jam menggunakan biji kopi Brazil Santos. Menghasilkan minuman dengan body tebal, sweetness alami, dan kafein tinggi. Disajikan over ice untuk kesegaran maksimal.',
                'deskripsi_singkat'=> 'Cold brew 18 jam dengan body tebal dan manis alami.',
                'tersedia'         => true,
                'featured'         => false,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $sig->id,
                'nama'             => 'Essenza Dark Matter',
                'slug'             => 'essenza-dark-matter',
                'harga'            => 65000,
                'deskripsi'        => 'Signature drink Essenza Coffee yang menggabungkan cold brew concentrate, espresso tonic, coconut cream, dan dark chocolate. Layered drink yang memukau secara visual dan kompleks dalam rasa.',
                'deskripsi_singkat'=> 'Layered signature drink yang kompleks dan memukau.',
                'tersedia'         => true,
                'featured'         => true,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $sig->id,
                'nama'             => 'Velvet Caramel Cloud',
                'slug'             => 'velvet-caramel-cloud',
                'harga'            => 62000,
                'deskripsi'        => 'Minuman signature kami yang terinspirasi dari awan musim gugur. Espresso double shot dengan caramel salted, whipped cream berbasis susu segar, dan taburan sea salt flakes. Sempurna antara manis dan asin.',
                'deskripsi_singkat'=> 'Espresso caramel salted dengan whipped cream premium.',
                'tersedia'         => true,
                'featured'         => true,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $nonCoffee->id,
                'nama'             => 'Matcha Latte',
                'slug'             => 'matcha-latte',
                'harga'            => 48000,
                'deskripsi'        => 'Matcha latte premium menggunakan ceremonial grade matcha dari Uji, Kyoto. Disajikan dengan susu oat yang creamy dan sedikit sweetener madu. Rasa umami matcha yang otentik dengan sentuhan manis alami.',
                'deskripsi_singkat'=> 'Ceremonial grade matcha dengan susu oat premium.',
                'tersedia'         => true,
                'featured'         => false,
                'foto'             => null,
            ],
            [
                'kategori_id'      => $food->id,
                'nama'             => 'Croissant Butter',
                'slug'             => 'croissant-butter',
                'harga'            => 35000,
                'deskripsi'        => 'Croissant lapis-lapis yang renyah di luar dan lembut di dalam. Dibuat dari adonan pastry premium dengan mentega Prancis berkualitas tinggi. Sempurna untuk menemani kopi pagi Anda.',
                'deskripsi_singkat'=> 'Croissant premium dengan mentega Prancis berkualitas.',
                'tersedia'         => true,
                'featured'         => false,
                'foto'             => null,
            ],
        ];

        foreach ($produks as $p) {
            Produk::create($p);
        }
    }
}
