@extends('template.layout')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tambah Data Penulis</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Tambah Data Penulis</li>
                </ol>
                <form action="/storePenulis" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="penulis_nama" class="form-label">Nama Penulis</label>
                            <input type="text" name="penulis_nama" class="form-control" placeholder="Masukkan Nama Penulis" required>
                        </div>
                        <div class="col-md-4">
                            <label for="penulis_tmptlahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="penulis_tmptlahir" class="form-control" placeholder="Masukkan Tempat Lahir" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="penulis_tgllahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="penulis_tgllahir" class="form-control" required>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <a href="/penulis" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
