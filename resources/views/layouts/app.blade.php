<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChiDimsum - Menu Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        /* Tambahan style cepat jika file CSS belum terbaca */
        body { font-family: 'Poppins', sans-serif; background-color: #f4f4f4; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .sticky-nav { position: sticky; top: 0; z-index: 1000; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-danger shadow-sm sticky-nav mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('menu.index') }}">
                <i class="fas fa-utensils me-2"></i> ChiDimsum
            </a>
            
            <div class="d-flex align-items-center">
                @if(session('table_number'))
                    <span class="badge bg-white text-danger me-3 rounded-pill px-3 py-2">
                        <i class="fas fa-chair me-1"></i> Meja #{{ session('table_number') }}
                    </span>
                @endif
                
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none small opacity-75">
                    <i class="fas fa-user-shield"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center py-4 text-muted mt-5">
        <small>&copy; 2026 ChiDimsum Digital Menu. All Rights Reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>