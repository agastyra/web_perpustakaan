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
                    <h1 class="mt-4">Tambah Buku</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Halaman Tambah Data Buku</li>
                    </ol>
                    @if ($errors->any())
                    <div class="alert alert-danger my-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex items-center gap-4">
                            <div class="form-group">
                                <label for="buku_urlgambar" class="form-label">Upload Sampul</label>
                                <input type="file" name="buku_urlgambar" id="buku_urlgambar" class="form-control"
                                       accept="image/jpeg,image/png,image/jpg">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="buku_judul" class="form-label">Judul Buku *</label>
                                <input type="text" name="buku_judul" id="buku_judul" class="form-control"
                                       placeholder="Masukkan judul buku" required>
                            </div>
                            <div class="col-md-4">
                                <label for="buku_penulis_id" class="form-label">Penulis Buku *</label>
                                <select name="buku_penulis_id" id="buku_penulis_id"
                                        class="form-control select2-dropdown" style="width: 100%" required>
                                    <option selected disabled>-Pilih Penulis Buku-</option>
                                    @foreach ($penulis as $p)
                                        <option value="{{ $p->penulis_id }}">{{ $p->penulis_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="buku_penerbit_id" class="form-label">Penerbit Buku *</label>
                                <select name="buku_penerbit_id" id="buku_penerbit_id"
                                        class="form-control select2-dropdown" style="width: 100%" required>
                                    <option selected disabled>-Pilih Penerbit Buku-</option>
                                    @foreach ($penerbit as $p)
                                        <option value="{{ $p->penerbit_id }}">{{ $p->penerbit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="buku_thnterbit" class="form-label">Tahun Terbit *</label>
                                <input type="text" name="buku_thnterbit" id="buku_thnterbit" class="form-control"
                                       placeholder="Masukkan tahun terbit" required>
                            </div>
                            <div class="col-md-4">
                                <label for="buku_kategori_id" class="form-label">Kategori Buku *</label>
                                <select name="buku_kategori_id" id="buku_kategori_id"
                                        class="form-control select2-dropdown" style="width: 100%" required>
                                    <option selected disabled>-Pilih Kategori Buku-</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="buku_rak_id" class="form-label">Rak Buku *</label>
                                <select name="buku_rak_id" id="buku_rak_id" class="form-control select2-dropdown"
                                        style="width: 100%" required>
                                    <option selected disabled>-Pilih Rak Buku-</option>
                                    @foreach ($rak as $r)
                                        <option value="{{ $r->rak_id }}">{{ $r->rak_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="buku_isbn" class="form-label">Nomor ISBN *</label>
                                <input type="text" name="buku_isbn" id="buku_isbn" class="form-control"
                                       placeholder="Masukkan nomor ISBN" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary me-2">Tambah Buku</button>
                                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
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
