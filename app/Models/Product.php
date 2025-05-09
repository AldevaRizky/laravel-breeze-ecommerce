<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'stock',
        'category_id',
        'images', //storage/products/...(arr1, arr2, arr3) LEBIH DARI 1 FOTO
        'metadata', //highlight,You Might Like,Hot Deals,Featured Products,Best Seller,Limited Edition,New Arrival,Flash Sale,Trending Now,Bundle Offers,Exclusive,Eco-Friendly,Customizable,Pre-Order
    ];

    protected $casts = [
        'images' => 'array',      // Mengubah kolom images menjadi array JSON
        'metadata' => 'array',    // Mengubah kolom metadata menjadi array
        'discount' => 'float',    // Diskon sebagai persentase (float)
    ];

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
