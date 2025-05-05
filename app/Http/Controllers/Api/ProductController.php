<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function getNewArrivals(): JsonResponse
    {
        try {
            $newArrivals = Product::whereJsonContains('metadata', 'New Arrival')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get()
                ->map(function ($product) {
                    return [
                        'name' => $product->name,
                        'images' => is_string($product->images) ? json_decode($product->images, true) : $product->images,
                        'metadata' => is_string($product->metadata) ? json_decode($product->metadata, true) : $product->metadata,
                        'created_at' => $product->created_at
                    ];
                });

            return response()->json($newArrivals);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}