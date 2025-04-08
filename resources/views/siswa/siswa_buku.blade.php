@extends('template.layout_siswa')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_siswa')
@endsection

@section('main')
        <main>
            <div id="layoutSidenav_content">
                <h1>Buku</h1>
                <p>Halaman Daftar Buku</p>
                <div class="row g-4">
                    @forelse ($buku as $item)
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset("storage/$item->buku_urlgambar") }}" alt="Bulan" class="img-fluid" style="max-width: 150px; height: auto;">
                                    <hr>
                                    <p class="fw-bolder fs-4">{{ $item->buku_judul }}</p>
                                    <p>{{ $item->penulis->penulis_nama }}</p>
                                    <a href="/siswacreatePeminjaman" button type="submit" class="btn btn-primary">Pinjam</button></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada buku</p>
                    @endforelse
                </div>
            </div>
        </main>
@endsection
