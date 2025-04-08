@extends('template.layout_siswa')

@section('title', 'Peminjaman - Perpustakaan')

@section('header')
    @include('template.navbar_siswa')
@endsection

@section('main')
<div id="layoutSidenav">
    {{-- @include('template.sidebar_siswa') <!-- Sidebar di sini --> --}}
    <div id="layoutSidenav_content">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Data Peminjaman Buku</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('updated'))
                <div class="alert alert-warning">{{ session('updated') }}</div>
            @elseif(session('deleted'))
                <div class="alert alert-danger">{{ session('deleted') }}</div>
            @endif

            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Kembali</th>
                        <th>Status Kembali</th>
                        <th>Note</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <ul>
                                    @foreach($item->detail as $detail)
                                        <li>
                                            {{$detail->buku->buku_judul}}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$item->peminjaman_tglpinjam}}</td>
                            <td>{{$item->peminjaman_tglkembali}}</td>
                            <td>
                                @if ($item->peminjaman_statuskembali === 1)
                                    <span class="badge bg-success">SUDAH KEMBALI</span>
                                @else
                                    <span class="badge bg-danger">BELUM KEMBALI</span>
                                @endif
                            </td>
                            <td>{{$item->peminjaman_note}}</td>
                            <td>Rp {{number_format($item->peminjaman_denda, 0, ',', '.')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $peminjaman->links('vendor.pagination.bootstrap-5') }}

            <a href="/siswacreatePeminjaman" class="btn btn-primary">Tambah Peminjaman</a>

        </div>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; Web Perpustakaan 2023</div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
