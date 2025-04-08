@extends('template.layout')

@section('title', 'Update Buku - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Buku</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Halaman Update Buku</li>
            </ol>

            <form action="{{ route('buku.update', ['id' => $buku->buku_id]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="buku_id" class="form-label">ID Buku</label>
                        <input type="text" id="buku_id" name="buku_id" class="form-control" value="{{ $buku->buku_id }}" readonly>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label for="buku_judul" class="form-label">Judul Buku *</label>
                        <input type="text" id="buku_judul" name="buku_judul" class="form-control" value="{{ $buku->buku_judul }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="buku_penulis_id" class="form-label">Penulis Buku *</label>
                        <select id="buku_penulis_id" name="buku_penulis_id" class="form-control select2-dropdown" style="width: 100%">
                            <option selected>-Pilih Penulis Buku-</option>
                            @foreach ($penulis as $p)
                                <option value="{{ $p->penulis_id }}" {{ $buku->buku_penulis_id == $p->penulis_id ? 'selected' : '' }}>{{ $p->penulis_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="buku_penerbit_id" class="form-label">Penerbit Buku *</label>
                        <select id="buku_penerbit_id" name="buku_penerbit_id" class="form-control select2-dropdown" style="width: 100%">
                            <option selected>-Pilih Penerbit Buku-</option>
                            @foreach ($penerbit as $p)
                                <option value="{{ $p->penerbit_id }}" {{ $buku->buku_penerbit_id == $p->penerbit_id ? 'selected' : '' }}>{{ $p->penerbit_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="buku_thnterbit" class="form-label">Tahun Terbit *</label>
                        <input type="number" id="buku_thnterbit" name="buku_thnterbit" class="form-control" value="{{ $buku->buku_thnterbit }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="buku_kategori_id" class="form-label">Kategori Buku *</label>
                        <select id="buku_kategori_id" name="buku_kategori_id" class="form-control select2-dropdown" style="width: 100%">
                            <option selected>-Pilih Kategori Buku-</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->kategori_id }}" {{ $buku->buku_kategori_id == $k->kategori_id ? 'selected' : '' }}>{{ $k->kategori_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="buku_rak_id" class="form-label">Rak Buku *</label>
                        <select id="buku_rak_id" name="buku_rak_id" class="form-control select2-dropdown" style="width: 100%">
                            <option selected>-Pilih Rak Buku-</option>
                            @foreach ($rak as $r)
                                <option value="{{ $r->rak_id }}" {{ $buku->buku_rak_id == $r->rak_id ? 'selected' : '' }}>
                                    {{ $r->rak_id }} - {{ $r->rak_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="buku_isbn" class="form-label">Nomor ISBN *</label>
                        <input type="text" id="buku_isbn" name="buku_isbn" class="form-control" value="{{ $buku->buku_isbn }}" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
