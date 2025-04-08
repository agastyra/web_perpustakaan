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
                <h1 class="mt-4">Penerbit</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Data Penerbit</li>
                </ol>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('updated'))
                    <div class="alert alert-warning">{{ session('updated') }}</div>
                @elseif(session('deleted'))
                    <div class="alert alert-danger">{{ session('deleted') }}</div>
                @endif

                <a class="btn btn-primary mb-3" href="{{ route('penerbit.create') }}">Tambah Penerbit</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penerbit as $item)
                        <tr>
                            <td>{{ $item->penerbit_id }}</td>
                            <td>{{ $item->penerbit_nama }}</td>
                            <td>{{ $item->penerbit_alamat }}</td>
                            <td>{{ $item->penerbit_notelp }}</td>
                            <td>{{ $item->penerbit_email }}</td>
                            <td>
                                <a class="btn btn-warning me-2" href="{{ route('penerbit.edit', $item->penerbit_id) }}">Update</a>
                                <form action="{{ route('penerbit.delete', $item->penerbit_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus penerbit ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $penerbit->links('vendor.pagination.bootstrap-5') }}
            </div>
        </main>
    </div>
</div>
@endsection
