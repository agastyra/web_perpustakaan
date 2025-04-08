@extends('template.layout')

@section('title', 'Update Penerbit')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid p-4">
                <h1 class="mt-4">Update Data Penerbit</h1>
                <form action="{{ route('penerbit.update', $penerbit->penerbit_id) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>ID Penerbit *</label>
                            <input type="text" class="form-control" value="{{ $penerbit->penerbit_id }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Nama Penerbit *</label>
                            <input type="text" name="penerbit_nama" class="form-control" value="{{ $penerbit->penerbit_nama }}" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alamat *</label>
                            <input type="text" name="penerbit_alamat" class="form-control" value="{{ $penerbit->penerbit_alamat }}" required>
                        </div>
                        <div class="col-md-6">
                            <label>Nomor Telepon *</label>
                            <input type="text" name="penerbit_notelp" class="form-control" value="{{ $penerbit->penerbit_notelp }}" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ $penerbit->penerbit_email }}" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('penerbit') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
