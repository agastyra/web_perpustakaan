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
                <h1 class="mt-4">Buku</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Data Buku</li>
                </ol>

                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('updated'))
                    <div class="alert alert-warning">{{ session('updated') }}</div>
                @elseif(session('deleted'))
                    <div class="alert alert-danger">{{ session('deleted') }}</div>
                @endif

                <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Detail</th>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Penulis Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <button type="button"
                                        class="btn btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detail-buku"
                                        data-buku-id="{{ $item->buku_id }}"
                                        data-buku-isbn="{{ $item->buku_isbn }}"
                                        data-buku-judul="{{ $item->buku_judul }}"
                                        data-buku-kategori="{{ $item->kategori->kategori_nama }}"
                                        data-buku-penulis="{{ $item->penulis->penulis_nama }}"
                                        data-buku-tahun-terbit="{{ $item->buku_thnterbit }}"
                                        data-buku-rak="{{ $item->rak->rak_nama }}"
                                        data-buku-gambar="{{ asset("storage/$item->buku_urlgambar") }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $item->buku_isbn }}</td>
                                <td>{{ $item->buku_judul }}</td>
                                <td>{{ $item->penulis->penulis_nama ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('buku.edit', $item->buku_id) }}" class="btn btn-warning me-2">Update</a>
                                        <a href="{{ route('buku.delete', $item->buku_id) }}" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($buku->count() == 0)
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data buku.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $buku->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4 text-center">
                <div class="small">
                    <div class="text-muted">Copyright &copy; Web Perpustakaan 2023</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="modal fade"
    id="detail-buku"
    tabindex="-1"
    aria-labelledby="buku"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 buku-judul"></h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="" alt="" class="img-fluid buku-gambar">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <p>ISBN: <span class="buku-isbn fst-italic"></span></p>
                            </div>
                            <div class="col-12">
                                <p>Penulis: <span class="buku-penulis fst-italic"></span></p>
                            </div>
                            <div class="col-12">
                                <p>Kategori: <span class="buku-kategori fst-italic"></span></p>
                            </div>
                            <div class="col-12">
                                <p>Rak: <span class="buku-rak fst-italic"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).on('show.bs.modal', '#detail-buku', function (event) {
            const button = $(event.relatedTarget)
            const modal = $(this)

            modal.find('.buku-gambar').attr('src', button.data('buku-gambar'))
            modal.find('.buku-judul').text(`${button.data('buku-judul')} (${button.data('buku-tahun-terbit')})`)
            modal.find('.buku-isbn').text(`${button.data('buku-isbn')}`)
            modal.find('.buku-penulis').text(`${button.data('buku-penulis')}`)
            modal.find('.buku-kategori').text(`${button.data('buku-kategori')}`)
            modal.find('.buku-rak').text(`${button.data('buku-rak')}`)
        })
    </script>
@endpush
