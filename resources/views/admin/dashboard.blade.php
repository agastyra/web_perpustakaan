@extends('template.layout')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Halaman Dashboard Admin Perpustakaan</li>
    </ol>

    @if ($level === 'admin')
        <h3>Selamat datang, {{ $level }}</h3>
    @endif

    <!-- Cards -->
    <div class="row">
        <!-- Primary Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">Primary Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="small text-white stretched-link">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- Warning Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">Warning Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="small text-white stretched-link">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- Success Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="small text-white stretched-link">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- Danger Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="small text-white stretched-link">View Details</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
