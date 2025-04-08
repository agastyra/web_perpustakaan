@extends('template.layout')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    {{-- @include('template.sidebar_admin') --}}
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid p-4">
                <h1 class="mt-4">Tambah Penerbit</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Tambah Data Penerbit</li>
                </ol>

                <form action="/penerbit/store" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="id_penerbit" class="form-label">ID Penerbit *</label>
                            <input type="text" name="id_penerbit" class="form-control" id="id_penerbit" placeholder="Masukkan ID penerbit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_penerbit" class="form-label">Nama Penerbit *</label>
                            <input type="text" name="nama_penerbit" class="form-control" id="nama_penerbit" placeholder="Masukkan nama penerbit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat *</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Nomor Telepon *</label>
                            <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Masukkan nomor telepon" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a button class="btn btn-primary me-2" href="/penerbit">Tambah Penerbit</button></a>
                            <a href="/penerbit" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4 text-center">
                <div class="text-muted">Copyright &copy; Web Perpustakaan 2023</div>
            </div>
        </footer>
    </div>
</div>
@endsection
