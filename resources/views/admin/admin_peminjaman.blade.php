@extends('template.layout')

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    {{-- @include('template.sidebar_admin') <!-- Sidebar di sini --> --}}
    <div id="layoutSidenav_content">
        <div class="container mt-5">
            <h2 class="text-center">Data Peminjaman Buku</h2>
            <table class="table table-bordered mt-4">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Kembali</th>
                    <th>Note</th>
                    <th>Denda</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($peminjaman as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->user->user_name}}</td>
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
                        <td>
                            <a class="btn btn-warning me-2" href="{{ route('adminupdatePeminjaman', $item->id)
                            }}">Update</a>
                            <form action="{{ route('peminjaman.delete', $item->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus peminjaman ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $peminjaman->links('vendor.pagination.bootstrap-5') }}
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
        $(document).ready(function () {
            document.cookie = "peminjaman_detail=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/;";
        })
    </script>
@endpush
