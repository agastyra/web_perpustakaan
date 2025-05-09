@extends('template.layout')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid p-4">
                <h1 class="mt-4">Tambah Rak</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Tambah Rak</li>
                </ol>

                <form action="{{ route('storeRak') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="rak_nama" class="form-label">Nama Rak *</label>
                                <input type="text" name="rak_nama" class="form-control" placeholder="Masukkan Nama Rak" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="rak_lokasi" class="form-label">Lokasi Rak *</label>
                                <input type="text" name="rak_lokasi" class="form-control" placeholder="Masukkan Lokasi Rak" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="rak_kapasitas" class="form-label">Kapasitas Rak *</label>
                                <input type="number" name="rak_kapasitas" class="form-control" placeholder="Masukkan Kapasitas (Jumlah Buku)" required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Tambah Rak</button>
                            <a href="/adminRak" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
