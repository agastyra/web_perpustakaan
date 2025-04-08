@extends('template.layout')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    {{-- @include('template.sidebar_admin') --}}
    <div id="layoutSidenav_content">
        <main>
            <div class="container mt-5">
                <h2 class="text-center mb-4">Update Peminjaman Buku</h2>
                <form action="" id="form-peminjaman">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="nama" class="form-label">Nama Peminjam *</label>
                            <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                            <select name="peminjaman_user_id" id="peminjaman_user_id" class="form-control select2-dropdown" style="width: 100%" required>
                                <option selected disabled>-Pilih Penerbit Buku-</option>
                                @foreach ($siswa as $s)
                                    <option value="{{ $s->id }}"
                                        {{ $peminjaman->peminjaman_user_id == $s->id ? 'selected' : '' }}>
                                        {{ $s->user_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="statusKembali" class="form-label">Status Kembali</label>
                            <select class="form-select" id="peminjaman_statuskembali" name="peminjaman_statuskembali" required>
                                <option value="" disabled selected><em>-- Pilih Status --</em></option>
                                @foreach([0,1] as $status)
                                    <option value="{{ $status }}"
                                        {{ $peminjaman->peminjaman_statuskembali == $status ? 'selected' : '' }}
                                    >
                                        {{ $status == 0 ? 'BELUM' : 'SUDAH' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="peminjaman_tglpinjam" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" name="peminjaman_tglpinjam" value="{{
                            $peminjaman->peminjaman_tglpinjam }}"
                                   id="peminjaman_tglpinjam" required>
                        </div>
                        <div class="col-md-6">
                            <label for="peminjaman_tglkembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="peminjaman_tglkembali" required
                                   name="peminjaman_tglkembali" value="{{ $peminjaman->peminjaman_tglkembali }}">
                        </div>
                        <div class="col-md-6">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" placeholder="Tambahkan catatan jika
                            ada" name="peminjaman_note" id="peminjaman_note">{{ $peminjaman->peminjaman_note }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="denda" class="form-label">Denda</label>
                            <input type="text" class="form-control" id="peminjaman_denda" placeholder="Tambahkan denda jika ada" name="peminjaman_denda" value="{{ $peminjaman->peminjaman_denda }}">
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
                                <tbody id="detail_buku">
                                    @foreach($peminjaman_detail as $detail)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <select name="buku" class="form-control select2-dropdown buku-select"
                                                        style="width: 100%" required>
                                                    <option selected disabled>-Pilih Buku-</option>
                                                    @foreach($allBuku as $buku)
                                                        <option value="{{$buku->buku_id}}"
                                                                data-buku-penulis="{{$buku->penulis->penulis_nama}}"
                                                                data-buku-penerbit="{{$buku->penerbit->penerbit_nama}} ({{$buku->buku_thnterbit}})"
                                                                {{ $detail["buku_id"] == $buku->buku_id ? 'selected' : '' }}
                                                        >{{$buku->buku_isbn}} |
                                                            {{$buku->buku_judul}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="buku_penulis">{{ $detail["penulis"]["penulis_nama"] }}</td>
                                            <td class="buku_penerbit">{{ $detail["penerbit"]["penerbit_nama"] }} ({{
                                            $detail["buku_thnterbit"] }})
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-danger user-select-none" id="hapus-buku">
                                Hapus Buku Terakhir
                            </button>
                            <button type="button" class="btn btn-success user-select-none" id="tambah-buku">
                                Tambah Buku
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-warning me-2" type="submit">Update</button>
                        <a href="/adminPeminjaman" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4 text-center">
                    <div class="text-muted">&copy; Web Perpustakaan 2023</div>
                </div>
            </footer>
        </main>
    </div>
</div>
@endsection

@push("scripts")
    <script>
        const btnAddRow = $('#tambah-buku')
        const btnDelRow = $("#hapus-buku")

        btnAddRow.on('click', addRow)
        btnDelRow.on('click', removeRow)

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
            const cookie = document.cookie.split('; ').find(row => row.startsWith('peminjaman_detail=')).split("=")[1]
            const peminjaman_detail = JSON.parse(decodeURIComponent(cookie)) || []
            peminjaman_detail.pop()
            document.cookie = `peminjaman_detail=${encodeURIComponent(JSON.stringify((peminjaman_detail)))}; path=${location.pathname}; expires=${new Date(Date.now() + 60 * 1000).toUTCString()}`
            if(tableBuku.find('tr').length <= 1) return btnDelRow.prop('disabled', true)
        }

        $(window).on('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });
        $(document).ready(function () {
            const tableBuku = $('#detail_buku')
            $('.select2-dropdown').select2({
                theme: 'bootstrap-5'
            });

            const peminjamanDetail = [];
            tableBuku.find("tr").each(function () {
                const bukuId = $(this).find(".buku-select").val().trim();
                const bukuPenulis = $(this).find(".buku_penulis").text().trim();
                const bukuPenerbit = $(this).find(".buku_penerbit").text().trim();

                if (bukuId) {
                    peminjamanDetail.push({
                        buku_id: bukuId,
                        buku_penulis: bukuPenulis,
                        buku_penerbit: bukuPenerbit
                    });
                }
            });

            document.cookie = `peminjaman_detail=${encodeURIComponent(JSON.stringify(peminjamanDetail))}; path=${location.pathname}; expires=${new Date(Date.now() + 60 * 1000).toUTCString()}`;

            if(tableBuku.find('tr').length <= 1) return btnDelRow.prop('disabled', true)
        })
        $("#form-peminjaman").on("submit", submit)

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
                                        {{$buku->buku_judul}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="buku_penulis">-</td>
                    <td class="buku_penerbit">-</td>
                </tr>
            `
        }
        function onChangeBuku(e) {
            const cookie = document.cookie.split('; ').find(row => row.startsWith('peminjaman_detail=')).split("=")[1]
            const peminjaman_detail = JSON.parse(decodeURIComponent(cookie)) || []
            const penulis = $(e.target).find('option:selected').data('buku-penulis')
            const penerbit = $(e.target).find('option:selected').data('buku-penerbit')
            const tr = $(e.target).closest('tr')
            tr.find('.buku_penulis').text(penulis)
            tr.find('.buku_penerbit').text(penerbit)

            peminjaman_detail.push({
                buku_id: e.target.value,
                buku_penulis: $(e.target).find('option:selected').data('bukuPenulis'),
                buku_penerbit: $(e.target).find('option:selected').data('bukuPenerbit')
            })

            document.cookie = `peminjaman_detail=${encodeURIComponent(JSON.stringify((peminjaman_detail)))}; path=${location.pathname}; expires=${new Date(Date.now() + 60 * 1000).toUTCString()}`
        }

        async function submit(e) {
            e.preventDefault()
            $(window).off('beforeunload')
            const cookie = document.cookie.split('; ').find(row => row.startsWith('peminjaman_detail=')).split("=")[1]
            const peminjaman_detail = JSON.parse(decodeURIComponent(cookie)) || []

            try {
                await fetch("{{route('peminjaman.update', $peminjaman->id)}}", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        peminjaman_user_id: $("#peminjaman_user_id").val(),
                        peminjaman_tglpinjam: $("#peminjaman_tglpinjam").val(),
                        peminjaman_tglkembali: $("#peminjaman_tglkembali").val(),
                        peminjaman_note: $("#peminjaman_note").val(),
                        peminjaman_denda: $("#peminjaman_denda").val(),
                        peminjaman_statuskembali: $("#peminjaman_statuskembali").val(),
                        peminjaman_detail
                    })
                })

                window.location.href = "{{ route('adminPeminjaman') }}";
            } catch (e) {
                window.location.href = "{{ route('adminPeminjaman') }}";
            }
        }
    </script>
@endpush
