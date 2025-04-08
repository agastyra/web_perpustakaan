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
                <h1 class="mt-4">Update Data Penulis</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Update Data Penulis</li>
                </ol>
                <form action="/updatePenulis/{{ $penulis->penulis_id }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">ID Penulis</label>
                            <input type="text" class="form-control" value="{{ $penulis->penulis_id }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama Penulis</label>
                            <input type="text" name="penulis_nama" class="form-control" value="{{ $penulis->penulis_nama }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="penulis_tmptlahir" class="form-control" value="{{ $penulis->penulis_tmptlahir }}" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="penulis_tgllahir" class="form-control" value="{{ $penulis->penulis_tgllahir }}" required>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="/penulis" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
