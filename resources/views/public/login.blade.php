<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Web Perpustakaan</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
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
    <section class="login-container">
        <div class="card shadow-lg">
            @if ($errors->any())
            <div class="alert alert-danger my-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-header text-center">
                <img src="{{ asset('storage/img/book.png') }}" alt="Gambar Buku" width="80px" height="80px">
                <h3>Login - Web Perpustakaan</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" name="user_username" id="username" class="form-control"
                               placeholder="Masukkan username Anda">
                    </div>
                    <div class="form-group my-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" name="user_password" id="password" class="form-control"
                               placeholder="Masukkan password Anda">
                    </div>
                    <div class="form-group my-3 text-center">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="/register" class="text-primary">Tidak punya akun? Silahkan mendaftar</a>
            </div>
        </div>
    </section>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
