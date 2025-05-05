<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $categoryIds = Category::pluck('id')->toArray(); // Ambil semua ID kategori yang ada

        for ($i = 0; $i < 30; $i++) {
            $productName = $faker->words(rand(2, 5), true);
            $description = $faker->paragraphs(rand(5, 10), true);
            while (strlen($description) < 1000) {
                $description .= ' ' . $faker->paragraphs(rand(3, 5), true);
            }
            $description = substr($description, 0, 2000); // Batasi deskripsi agar tidak terlalu panjang

            $metadataOptions = [
                'Highlight',
                'You Might Like',
                'Hot Deals',
                'Featured Products',
                'Best Seller',
                'Limited Edition',
                'New Arrival',
                'Flash Sale',
                'Trending Now',
                'Bundle Offers',
                'Exclusive',
                'Eco-Friendly',
                'Customizable',
                'Pre-Order',
            ];

            $randomMetadata = $faker->randomElements($metadataOptions, rand(0, 5)); // Pilih hingga 5 metadata acak

            Product::create([
                'name' => $productName,
                'description' => $description,
                'price' => $faker->numberBetween(50000, 5000000),
                'discount' => $faker->optional(0.3)->randomFloat(2, 0, 0.8), // Diskon opsional hingga 80%
                'stock' => $faker->numberBetween(10, 200),
                'category_id' => $faker->randomElement($categoryIds), // Pilih ID kategori secara acak dari yang tersedia
                // 'images' => $faker->optional()->imageUrl(640, 480, 'fashion', true), // Gambar opsional
                'metadata' => !empty($randomMetadata) ? $randomMetadata : null,
            ]);
        }
    }
}