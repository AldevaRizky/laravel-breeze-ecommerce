<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(5);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'discount'    => 'nullable|numeric|min:0|max:100',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'metadata'    => 'nullable|array',
            'metadata.*'  => 'string|in:highlight,You Might Like,Hot Deals,Featured Products,Best Seller,Limited Edition,New Arrival,Flash Sale,Trending Now,Bundle Offers,Exclusive,Eco-Friendly,Customizable,Pre-Order',
        ]);

        $validated['metadata'] = $validated['metadata'] ?? [];

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        $validated['images'] = $imagePaths;

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'metadata' => 'nullable|array',
            'metadata.*' => 'string|in:highlight,You Might Like,Hot Deals,Featured Products,Best Seller,Limited Edition,New Arrival,Flash Sale,Trending Now,Bundle Offers,Exclusive,Eco-Friendly,Customizable,Pre-Order',
        ]);

        $existingImages = $request->input('existing_images', []);
        $imagesToDelete = array_diff($product->images ?? [], $existingImages);

        foreach ($imagesToDelete as $img) {
            Storage::disk('public')->delete($img);
        }

        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $newImages[] = $path;
            }
        }

        $finalImages = array_merge($existingImages, $newImages);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'images' => $finalImages,
            'metadata' => $request->input('metadata', []),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->images) {
            foreach ($product->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
