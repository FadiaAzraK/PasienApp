<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Pasien App')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f6fa;
        }

        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: #2d3436;
        }

        .navbar-custom .nav-link {
            font-weight: 500;
            color: #2d3436;
            padding: 10px 14px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .navbar-custom .nav-link:hover {
            background: #f1f2f6;
        }

        .navbar-custom .nav-link.active {
            background: #0984e3;
            color: white !important;
        }

        .page-container {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom mb-4">
    <div class="container">

        <a class="navbar-brand" href="{{ route('patients.index') }}">
            PasienApp
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <ul class="navbar-nav ms-auto"> 
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('patients.index') ? 'active' : '' }}"
                        href="{{ route('patients.index') }}">
                        Pasien
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('visits.index') ? 'active' : '' }}"
                        href="{{ route('visits.index') }}">
                        Riwayat Kunjungan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('visits.create') ? 'active' : '' }}"
                        href="{{ route('visits.create') }}">
                        Pendaftaran Kunjungan
                    </a>
                </li>
                
            </ul>

        </div>
    </div>
</nav>


<div class="container mb-5">
    
    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="page-container">
        @yield('content')
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>