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
                <h1 class="mt-4">Penulis</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Data Penulis</li>
                </ol>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('updated'))
                    <div class="alert alert-warning">{{ session('updated') }}</div>
                @elseif(session('deleted'))
                    <div class="alert alert-danger">{{ session('deleted') }}</div>
                @endif
                <a href="/createPenulis" class="btn btn-primary mb-3">Tambah Penulis</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Penulis</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penulis as $p)
                            <tr>
                                <td>{{ $p->penulis_id }}</td>
                                <td>{{ $p->penulis_nama }}</td>
                                <td>{{ $p->penulis_tmptlahir }}</td>
                                <td>{{ $p->penulis_tgllahir }}</td>
                                <td>
                                    <a href="/editPenulis/{{ $p->penulis_id }}" class="btn btn-warning btn-sm">Update</a>
                                    <a href="/deletePenulis/{{ $p->penulis_id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
