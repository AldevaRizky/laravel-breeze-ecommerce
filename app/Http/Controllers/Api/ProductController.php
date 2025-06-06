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
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->images[0] ?? null,
                        'metadata' => $product->metadata,
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

    public function show($id): JsonResponse
    {
        try {
            // Eager load category
            $product = Product::with('category')->findOrFail($id);

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'discount' => $product->discount,
                'stock' => $product->stock,
                'category' => $product->category ? $product->category->name : null,
                'images' => $product->images,
                'metadata' => $product->metadata,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Product not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function getRecommendedProducts(): JsonResponse
    {
        try {
            $recommended = Product::whereJsonContains('metadata', 'You Might Like')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'discount' => $product->discount,
                        'image' => $product->images[0] ?? null,
                    ];
                });

            return response()->json($recommended);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function getAllRecommendedProducts(): JsonResponse
    {
        try {
            $products = Product::whereJsonContains('metadata', 'You Might Like')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->images[0] ?? null,
                    ];
                });

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getHighDiscountProducts(): JsonResponse
    {
        try {
            $products = Product::where('discount', '>', 40)
                ->orderBy('discount', 'desc')
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'discount' => $product->discount,
                        'image' => $product->images[0] ?? null,
                    ];
                });

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getBestSellerProducts(): JsonResponse
    {
        try {
            $products = Product::whereJsonContains('metadata', 'Best Seller')
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $product->images[0] ?? null,
                    ];
                });

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getFeaturedProducts(): JsonResponse
    {
        try {
            $products = Product::whereJsonContains('metadata', 'Featured Products')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $product->images[0] ?? null,
                    ];
                });

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllProducts(): JsonResponse
    {
        try {
            $products = Product::with('category')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'category' => $product->category ? $product->category->name : null,
                        'price' => $product->price,
                        'discount' => $product->discount,
                        'image' => $product->images[0] ?? null,
                    ];
                });

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
