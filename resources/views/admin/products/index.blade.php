@extends('layouts.dashboard')

@section('title', 'Produk')

@section('content')
<div class="container-fluid py-4">

    <!-- Button trigger modal Tambah -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Produk
        </button>
    </div>

    <!-- Table Produk -->
    <div class="card">
        <div class="card-header pb-0">
            <h6>Daftar Produk</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if ($product->images)
                                    @foreach ($product->images as $img)
                                        <img src="{{ asset('storage/' . $img) }}" alt="image" width="50" height="50" class="rounded me-1">
                                    @endforeach
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">Edit</button>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return deleteConfirmation(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Produk -->
                        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('admin.products.form', ['product' => $product])
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-gradient-dark text-white">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('admin.products.form', ['product' => null])
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-dark text-white">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if($errors->any())
    <script>
        $(document).ready(function() {
            @if(request()->is('admin/products/*'))
                $('#editModal{{ $product->id ?? '' }}').modal('show');
            @else
                $('#addModal').modal('show');
            @endif
        });
    </script>
@endif
@endsection

@push('scripts')
<style>
    .form-control {
        border: 1px solid #ced4da !important;
    }
</style>
<style>
    .form-label {
        font-weight: 600;
    }

    .modal .form-control, .modal .form-select {
        border-radius: 0.5rem;
        border-color: #ced4da;
    }

    #image-preview img {
        object-fit: cover;
    }
</style>
<script>
    function removeExistingImage(button) {
        const wrapper = button.closest('.position-relative');
        wrapper.remove();
    }

    function addImageInput() {
        const group = document.createElement('div');
        group.classList.add('input-group', 'mb-2');

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.classList.add('form-control');
        input.accept = 'image/*';
        input.onchange = function () {
            previewImage(input);
        };

        group.appendChild(input);
        document.getElementById('image-upload-group').appendChild(group);
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded border';
                img.style.width = '70px';
                img.style.height = '70px';
                img.style.marginRight = '6px';
                document.getElementById('image-preview').appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Notifikasi Session -->
<script>
    // Notifikasi Success
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#2d4271'
        });
    @endif

    // Notifikasi Error
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#2d4271'
        });
    @endif

    // Notifikasi Validasi Error
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: `@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach`,
            confirmButtonColor: '#2d4271'
        });
    @endif
</script>
<script>
function deleteConfirmation(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Hapus produk?',
        text: "Tindakan ini tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2d4271',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
            Swal.fire({
                title: 'Menghapus...',
                text: 'Sedang memproses penghapusan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        }
    });
}
</script>
@endpush
