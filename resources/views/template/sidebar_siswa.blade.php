<style>
    /* Pastikan tinggi halaman penuh agar sidebar bisa memenuhi layar */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    /* Jadikan sidebar flex container dan atur tinggi penuh */
    #sidebar {
        display: flex;
        flex-direction: column;
        height: 100vh; /* agar sidebar memenuhi tinggi layar */
    }

    /* Buat bagian menu fleksibel (mengisi ruang sisanya) */
    .sb-sidenav-menu {
        flex: 1;
    }

    /* Efek hover untuk menu sidebar */
    .nav-link:hover {
        background-color: #495057; /* Warna latar belakang saat hover */
        color: #ffffff;           /* Warna teks saat hover */
        text-decoration: none;    /* Menghilangkan garis bawah pada teks */
    }

    /* Menambahkan transisi untuk efek yang lebih halus */
    .nav-link {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
</style>
<nav id="sidebar" class="bg-dark text-white" style="width: 250px;">
    <div class="sb-sidenav-menu">
        <div class="nav flex-column">
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/siswa">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt me-2"></i></div>
                Dashboard
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/siswaBuku">
                <div class="sb-nav-link-icon"><i class="fas fa-book me-2"></i></div>
                Daftar Buku
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/siswaPeminjaman">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake me-2"></i></div>
                Peminjaman
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="{{ route('pengaturan') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-cog me-2"></i></div>
                Pengaturan
            </a>
            <form action="/logout" method="POST" class="nav-link nav-item">
                @csrf
                @method('DELETE')
                <button class="w-100 bg-transparent border-0 text-white d-flex align-items-center" type="submit" onclick="return confirm
                ('Apakah Anda ' +
                 'yakin ingin keluar?')">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt me-2"></i></div>
                    Logout
                </button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center small text-white mt-auto py-2">
        © Web Perpustakaan 2023
    </footer>
</nav>
