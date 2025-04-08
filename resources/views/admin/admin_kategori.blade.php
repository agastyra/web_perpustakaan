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
                <h1 class="mt-4">Kategori</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Data Kategori</li>
                </ol>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('updated'))
                    <div class="alert alert-warning">{{ session('updated') }}</div>
                @elseif(session('deleted'))
                    <div class="alert alert-danger">{{ session('deleted') }}</div>
                @endif
                <a href="/createkategoriBuku" class="btn btn-primary mb-3">Tambah Kategori</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategori as $item)
                            <tr>
                                <td>{{ $item->kategori_id }}</td>
                                <td>{{ $item->kategori_nama }}</td>
                                <td>
                                    <a href="/editkategoriBuku/{{ $item->kategori_id }}" class="btn btn-warning me-2">Update</a>
                                    <a href="/deletekategoriBuku/{{ $item->kategori_id }}" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @if($kategori->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data kategori.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
