<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <!-- Custom CSS -->
    <style>
        /* Tambahkan style berikut */
        body {
            display: flex; /* Gunakan Flexbox */
            min-height: 100vh; /* Pastikan mencakup seluruh tinggi viewport */
            flex-direction: column; /* Susun elemen secara vertikal */
        }
        #wrapper {
            display: flex; /* Gunakan Flexbox */
            flex-grow: 1; /* Biarkan berkembang mengisi ruang yang tersisa */
        }
        #content-wrapper {
            flex-grow: 1; /* Biarkan konten berkembang mengisi ruang */
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Header (Navbar) -->
    @yield('header')

    <div id="wrapper">
        <!-- Sidebar -->
        @include('template.sidebar_admin')

        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <!-- Main Content -->
            <div class="container-fluid">
                @yield('main')
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2-dropdown').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
    <!-- Custom JS -->
    @stack('scripts')
</body>
</html>
