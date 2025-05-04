<div class="mb-3">
    <label class="form-label">Nama Produk</label>
    <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="price" class="form-control" required value="{{ old('price', $product->price ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stock" class="form-control" required value="{{ old('stock', $product->stock ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category_id" class="form-select" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Gambar Produk</label>

    {{-- Input baru --}}
    <div id="image-upload-group">
        <div class="input-group mb-2">
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple onchange="previewImage(this)">
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addImageInput()">+ Tambah Gambar</button>

    {{-- Gambar yang sudah ada --}}
    <div class="mt-3 d-flex flex-wrap gap-2" id="existing-images">
        @if (!empty($product->images))
            @foreach ($product->images as $index => $img)
                <div class="position-relative me-2 mb-2">
                    <img src="{{ asset('storage/' . $img) }}" width="70" height="70" class="rounded border">
                    <input type="hidden" name="existing_images[]" value="{{ $img }}">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removeExistingImage(this)">
                        ×
                    </button>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Preview Gambar Baru --}}
    <div id="image-preview" class="mt-3 d-flex flex-wrap gap-2"></div>
</div>

