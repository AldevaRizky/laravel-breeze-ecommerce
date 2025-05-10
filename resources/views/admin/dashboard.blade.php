@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
  <div class="container-fluid py-4">
    <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
    <p class="mb-4">Check the sales, value, and bounce rate by country.</p>

    <!-- Dashboard Stats -->
    <div class="row">
        <!-- Total Users Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow-lg me-3 d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-users" style="font-size: 40px;"></i> <!-- Font Awesome Icon -->
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="mb-0">Total Users</h5>
                            <span class="text-muted">Jumlah pengguna terdaftar</span>
                        </div>
                    </div>
                    <h3 class="font-weight-bolder mt-4">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow-lg me-3 d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-tags" style="font-size: 40px;"></i> <!-- Font Awesome Icon -->
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="mb-0">Total Categories</h5>
                            <span class="text-muted">Jumlah kategori produk</span>
                        </div>
                    </div>
                    <h3 class="font-weight-bolder mt-4">{{ $totalCategories }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow-lg me-3 d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-boxes" style="font-size: 40px;"></i> <!-- Font Awesome Icon -->
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="mb-0">Total Products</h5>
                            <span class="text-muted">Jumlah produk terdaftar</span>
                        </div>
                    </div>
                    <h3 class="font-weight-bolder mt-4">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional info (Optional) -->
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-header">
                    <h6>Overview</h6>
                </div>
                <div class="card-body">
                    <p>Here you can display charts, recent activities, or other details about your admin panel.</p>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
