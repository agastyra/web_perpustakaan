@extends('template.layout_siswa')

@section('title', 'Peminjaman - Perpustakaan')

@section('header')
    @include('template.navbar_siswa')
@endsection

@section('main')
<div id="layoutSidenav">
    {{-- @include('template.sidebar_siswa') <!-- Sidebar di sini --> --}}
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Peminjaman Buku</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Halaman Peminjaman Buku</li>
            </ol>
            <form action="" id="form-peminjaman">
                <div class="row">
                    <div class="col-12 col-md-4 form-group">
                        <label for="nama" class="form-label">Nama Peminjam *</label>
                        <input type="hidden" name="peminjaman_user_id" id="peminjaman_user_id" value="{{ Auth::user()->id }}">
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->user_name }}" readonly>
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <label for="peminjaman_tglpinjam" class="form-label">Tanggal Pinjam *</label>
                        <input type="date" name="peminjaman_tglpinjam" id="peminjaman_tglpinjam" class="form-control"
                               readonly
                               value="{{ Date('Y-m-d') }}">
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <label for="peminjaman_tglkembali" class="form-label">Tanggal Kembali *</label>
                        <input type="date" name="peminjaman_tglkembali" id="peminjaman_tglkembali" readonly
                               class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                    </div>
                    <div class="col-12 col-md6 form-group">
                        <label for="peminjaman_note" class="form-label">Keterangan</label>
                        <textarea name="peminjaman_note" id="peminjaman_note" class="form-control"
                                  maxlength="100"></textarea>
                    </div>
                </div>
                <div class="row mt-3 mb-5">
                    <h5 class="mb-3">Detail Buku</h5>
                    <div class="col-12">
                        <table class="table table-bordered w-100">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Buku</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Penerbit</th>
                            </tr>
                            </thead>
                            <tbody id="detail_buku"></tbody>
                        </table>
                        <button type="button" class="btn btn-outline-danger user-select-none" id="hapus-buku">
                            Hapus Buku Terakhir
                        </button>
                        <button type="button" class="btn btn-success user-select-none" id="tambah-buku">
                            Tambah Buku
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 form-group">
                        <button type="submit" class="btn btn-primary">Buat Peminjam</button>
                        <a href="/siswaPeminjaman" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
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

@push('scripts')
    <script>
        const btnAddRow = $('#tambah-buku')
        const btnDelRow = $("#hapus-buku")

        btnAddRow.on('click', addRow)
        btnDelRow.on('click', removeRow)

        $(window).on('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });
        $(document).ready(function () {
            const tableBuku = $('#detail_buku')
            document.cookie = `peminjaman_detail=${[]}; path=${window.location.pathname}; expires=${new Date(Date.now() + 60 * 1000).toUTCString()}`
            if(tableBuku.find('tr').length <= 1) return btnDelRow.prop('disabled', true)
        })
        $("#form-peminjaman").on("submit", submit)

        function addRow() {
            const tableBuku = $('#detail_buku')
            tableBuku.append(renderDetailBuku())
            $('.select2-dropdown').select2({
                theme: 'bootstrap-5'
            });
            btnDelRow.prop('disabled', false)
        }
        function removeRow() {
            const tableBuku = $('#detail_buku')
            tableBuku.find('tr').last().remove()
            const peminjaman_detail = JSON.parse(document.cookie.split('; ').find(row => row.startsWith('peminjaman_detail=')).split('=')[1] || '[]')
            peminjaman_detail.pop()
            document.cookie = `peminjaman_detail=${JSON.stringify(peminjaman_detail)}; path=${location.pathname}; expires=${new Date(Date.now() + 60 * 1000).toUTCString()}`
            if(tableBuku.find('tr').length <= 1) return btnDelRow.prop('disabled', true)
        }

        $(document).on('change', '.buku-select', onChangeBuku)
        function renderDetailBuku() {
            const counter = $('#detail_buku tr').length + 1

            return `
                <tr>
                    <th scope="row">${counter}</th>
                    <td>
                        <select name="buku" class="form-control select2-dropdown buku-select"
                                style="width: 100%" required>
                            <option selected disabled>-Pilih Buku-</option>
                            @foreach($allBuku as $buku)
                                <option value="{{$buku->buku_id}}"
                                    data-buku-penulis="{{$buku->penulis->penulis_nama}}"
                                    data-buku-penerbit="{{$buku->penerbit->penerbit_nama}} ({{$buku->buku_thnterbit}})"
                                >{{$buku->buku_isbn}} |
                                    {{$buku->buku_judul}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="buku_penulis">-</td>
                    <td class="buku_penerbit">-</td>
                </tr>
            `
        }
        function onChangeBuku(e) {
            const penulis = $(e.target).find('option:selected').data('buku-penulis')
            const penerbit = $(e.target).find('option:selected').data('buku-penerbit')
            const tr = $(e.target).closest('tr')
            tr.find('.buku_penulis').text(penulis)
            tr.find('.buku_penerbit').text(penerbit)

            const peminjaman_detail = $('#detail_buku tr').map(function() {
                const bukuSelect = $(this).find('.buku-select')
                return {
                    buku_id: bukuSelect.val(),
                    buku_penulis: bukuSelect.find('option:selected').data('buku-penulis'),
                    buku_penerbit: bukuSelect.find('option:selected').data('buku-penerbit')
                }
            }).get()
            document.cookie = `peminjaman_detail=${JSON.stringify(peminjaman_detail)}; path=${window.location.pathname};expires=${new Date(Date.now() + 60 * 1000).toUTCString()}`
        }

        async function submit(e) {
            e.preventDefault()
            $(window).off('beforeunload')

            try {
                await fetch("{{route('peminjaman.post')}}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        peminjaman_user_id: $("#peminjaman_user_id").val(),
                        peminjaman_tglpinjam: $("#peminjaman_tglpinjam").val(),
                        peminjaman_tglkembali: $("#peminjaman_tglkembali").val(),
                        peminjaman_note: $("#peminjaman_note").val(),
                        peminjaman_detail: JSON.parse(document.cookie.split('; ').find(row => row.startsWith('peminjaman_detail=')).split('=')[1] || '[]')
                    })
                })

                window.location.href = "{{ route('siswaPeminjaman') }}";
            } catch (e) {
                window.location.href = "{{ route('siswaPeminjaman') }}"
            }
        }
    </script>
@endpush
