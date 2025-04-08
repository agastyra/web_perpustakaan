<style>
    /* Efek hover untuk menu sidebar */
    .nav-link:hover {
        background-color: #495057; /* Warna latar belakang saat hover */
        color: #ffffff; /* Warna teks saat hover */
        text-decoration: none; /* Menghilangkan garis bawah pada teks */
    }

    /* Menambahkan transisi untuk efek yang lebih halus */
    .nav-link {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
</style>

<nav id="sidebar" class="bg-dark text-white" style="width: 250px;">
    <div class="sb-sidenav-menu">
        <div class="nav flex-column">
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/admin">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt me-2"></i></div>
                Dashboard
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/buku">
                <div class="sb-nav-link-icon"><i class="fas fa-book me-2"></i></div>
                Buku
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/kategoriBuku">
                <div class="sb-nav-link-icon"><i class="fas fa-list me-2"></i></div>
                Kategori Buku
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/penulis">
                <div class="sb-nav-link-icon"><i class="fas fa-pencil-alt me-2"></i></div>
                Penulis
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/penerbit">
                <div class="sb-nav-link-icon"><i class="fas fa-building me-2"></i></div>
                Penerbit
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/adminPeminjaman">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake me-2"></i></div>
                Peminjaman
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/adminRak">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes me-2"></i></div>
                Rak</a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="{{ route('pengaturan') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-cog me-2"></i></div>
                Pengaturan
            </a>
            <a class="nav-link text-white nav-item d-flex align-items-center" href="/login">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt me-2"></i></div>
                Logout
            </a>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center small text-white mt-auto py-2">
        © Web Perpustakaan 2023
    </footer>
</nav>
