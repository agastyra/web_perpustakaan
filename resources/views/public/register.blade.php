<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Web Perpustakaan</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">
    <style>
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            padding-top: 200px;
        }
        .card {
            width: 350px;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Section Login -->
    <section class="register-container">
        <div class="card shadow-lg">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('updated'))
                <div class="alert alert-warning">{{ session('updated') }}</div>
            @elseif(session('deleted'))
                <div class="alert alert-danger">{{ session('deleted') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header text-center">
                <img src="{{ asset('assets/img/book.png') }}" alt="Gambar Buku" width="80px" height="80px">
                <h3>Sign In - Web Perpustakaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="user_name" class="form-label">Nama *</label>
                        <input type="text" name="user_name" id="user_name" placeholder="Masukkan nama Anda"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="form-label">Email *</label>
                        <input type="email" name="user_email" id="user_email" class="form-control"
                               placeholder="Masukkan email Anda">
                    </div>
                    <div class="form-group">
                        <label for="user_username" class="form-label">Username *</label>
                        <input type="text" name="user_username" id="user_username" class="form-control"
                               placeholder="Masukkan username Anda">
                    </div>
                    <div class="form-group my-3">
                        <label for="user_password" class="form-label">Password *</label>
                        <input type="password" name="user_password" id="user_password" class="form-control"
                               placeholder="Masukkan password Anda">
                    </div>
                    <div class="form-group my-3">
                        <label for="user_password_confirmation" class="form-label">Konfirmasi Password *</label>
                        <input type="password" name="user_password_confirmation" id="user_password_confirmation"
                               class="form-control"
                               placeholder="Konfirmasi password Anda">
                    </div>
                    <div class="form-group my-3 text-center">
                        <button class="btn btn-primary" type="submit">Sign In</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="/login" class="text-primary">Sudah punya akun? Silahkan Log In</a>
            </div>
        </div>
    </section>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
