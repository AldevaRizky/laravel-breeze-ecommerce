<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia untuk data yang lebih relevan

        $productCategories = [
            'Tas Wanita',
            'Dompet Wanita',
            'Sepatu Wanita',
            'Sandal Wanita',
            'Aksesoris Wanita (Gelang, Kalung, Anting)',
            'Pakaian Wanita (Atasan)',
            'Pakaian Wanita (Bawahan)',
            'Hijab/Kerudung',
            'Kacamata Wanita',
            'Jam Tangan Wanita',
        ];

        foreach ($productCategories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'description' => $faker->sentence(50), // Deskripsi singkat acak
            ]);
        }
    }
}