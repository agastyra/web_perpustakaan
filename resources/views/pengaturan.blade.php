@php
$layout = auth()->user()->user_level == "admin" ? "template.layout" : "template.layout_siswa";
@endphp
@extends($layout)

@section('title', 'Dashboard - Admin Perpustakaan')

@section('header')
@include('template.navbar_admin')
@endsection

@section('main')
<div id="layoutSidenav">
    {{-- @include('template.sidebar_admin')
    <!-- Sidebar di sini --> --}}
    <div id="layoutSidenav_content">
        <main>
            <div class="container mt-4">
                @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h2 class="text-center">Pengaturan Akun</h2>
                <div class="d-flex items-center gap-4">
                    @if (is_null($user->user_pict_url))
                    <img src="{{ asset('assets/img/placeholder.png') }}"
                        alt="profile picture"
                        class="rounded-circle
                            img-profile img-thumbnail"
                        style="user-select: none"
                        width="200">
                    @else
                    <img src="{{ asset('storage/profile_pictures/'.basename($user->user_pict_url)) }}"
                        alt="profile picture"
                        class="rounded-circle img-profile img-thumbnail"
                        style="user-select: none"
                        width="200">
                    @endif
                    {{-- Upload Profile Form --}}
                    <form action="{{ route('action.upload_profile', ['id' => $user->id]) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="profile"
                                class="form-label">Upload Profile</label>
                            <input type="file"
                                name="profile"
                                id="profile"
                                class="form-control">
                            <div class="form-text"
                                id="basic-addon4">Ukuran maksimal 2MB.</div>
                            <div class="form-text"
                                id="basic-addon4">Gunakan foto ukuran 200 x 200.</div>
                        </div>
                        <div class="form-group my-3">
                            <button type="submit"
                                class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
                <form action="{{ route('updateSiswaPengaturan', $user->id)  }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama"
                            class="form-label">Nama</label>
                        <input type="text"
                            class="form-control"
                            id="user_nama"
                            name="user_name"
                            placeholder="Masukkan Nama"
                            value="{{
                        $user->user_name
                        }}">
                    </div>
                    <div class="mb-3">
                        <label for="username"
                            class="form-label">Username</label>
                        <input type="text"
                            class="form-control"
                            id="username"
                            name="user_username"
                            placeholder="Masukkan Username"
                            value="{{
                        $user->user_username
                        }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat"
                            class="form-label">Alamat</label>
                        <input type="text"
                            class="form-control"
                            id="alamat"
                            name="user_alamat"
                            placeholder="Masukkan Alamat"
                            value="{{ $user->user_alamat }}">
                    </div>
                    <div class="mb-3">
                        <label for="email"
                            class="form-label">Email</label>
                        <input type="email"
                            class="form-control"
                            id="email"
                            name="user_email"
                            placeholder="Masukkan Email"
                            value="{{
                        $user->user_email
                        }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp"
                            class="form-label">Nomor HP</label>
                        <input type="text"
                            class="form-control"
                            id="no_hp"
                            name="user_notelp"
                            placeholder="Masukkan Nomor HP"
                            value="{{
                        $user->user_notelp
                        }}">
                    </div>
                    <div class="mb-3">
                        <label for="password"
                            class="form-label">Password</label>
                        <input type="password"
                            class="form-control"
                            id="password"
                            name="user_password"
                            placeholder="Masukkan Password Baru">
                    </div>
                    <button type="submit"
                        class="btn btn-success">Update</button>
                    <a href="dashboard.html"
                        class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Web Perpustakaan 2023</div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection