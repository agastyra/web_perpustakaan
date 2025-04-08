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
                <h1 class="mt-4">Rak</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Data Rak</li>
                </ol>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('updated'))
                    <div class="alert alert-warning">{{ session('updated') }}</div>
                @elseif(session('deleted'))
                    <div class="alert alert-danger">{{ session('deleted') }}</div>
                @endif
                <a href="/admincreateRak" class="btn btn-primary mb-3">Tambah Rak</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Rak</th>
                                <th>Nama Rak</th>
                                <th>Lokasi Rak</th>
                                <th>Kapasitas Rak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rak as $r)
                            <tr>
                                <td>{{ $r->rak_id }}</td>
                                <td>{{ $r->rak_nama }}</td>
                                <td>{{ $r->rak_lokasi }}</td>
                                <td>{{ $r->rak_kapasitas }} Buku</td>
                                <td>
                                    <a href="{{ url('/adminupdateRak/'.$r->rak_id) }}" class="btn btn-warning me-2">Update</a>
                                    <a href="{{ url('/admindeleteRak/'.$r->rak_id) }}" onclick="return confirm('Yakin ingin menghapus rak ini?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $rak->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
