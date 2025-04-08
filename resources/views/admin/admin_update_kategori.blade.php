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
                <h1 class="mt-4">Update Kategori</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Update Kategori</li>
                </ol>

                <form action="/updatekategoriBuku/{{ $kategori->kategori_id }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="kategori_id" class="form-label">ID Kategori</label>
                            <input type="text" id="kategori_id" class="form-control" value="{{ $kategori->kategori_id }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="kategori_nama" class="form-label">Nama Kategori *</label>
                            <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" value="{{ $kategori->kategori_nama }}" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning me-2">Update</button>
                            <a href="/kategoriBuku" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
