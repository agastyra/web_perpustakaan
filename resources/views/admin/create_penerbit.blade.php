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

                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form action="{{ route('penerbit.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="penerbit_nama" class="form-label">Nama Penerbit *</label>
                            <input type="text" name="penerbit_nama" class="form-control" id="penerbit_nama" placeholder="Masukkan nama penerbit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="penerbit_alamat" class="form-label">Alamat *</label>
                            <input type="text" name="penerbit_alamat" class="form-control" id="penerbit_alamat" placeholder="Masukkan alamat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="penerbit_notelp" class="form-label">Nomor Telepon *</label>
                            <input type="text" name="penerbit_notelp" class="form-control" id="penerbit_notelp" placeholder="Masukkan nomor telepon" required>
                        </div>
                        <div class="col-md-6">
                            <label for="penerbit_email" class="form-label">Email *</label>
                            <input type="email" name="penerbit_email" class="form-control" id="penerbit_email" placeholder="Masukkan email" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
<button type="submit" class="btn btn-primary">Tambah Penerbit</button>
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
