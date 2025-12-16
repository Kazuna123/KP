<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan Dinas</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom --}}
    <style>
        body {
            background: #f6f3ee;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #6d4c41;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            padding-left: 10px;
            transition: .3s;
        }

        .sidebar .brand {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            padding-left: 15px;
            margin-bottom: 30px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            margin: 5px 0;
            font-size: 15px;
            color: #fff;
            border-radius: 10px;
            transition: .25s;
            text-decoration: none;
        }

        .menu-item:hover,
        .menu-active {
            background: #4e342e;
            transform: translateX(4px);
        }

        .menu-item i {
            font-size: 19px;
            margin-right: 10px;
        }

        /* CONTENT WRAPPER */
        .content {
            margin-left: 250px;
            padding: 25px 40px;
            animation: fadeIn .5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <nav class="sidebar shadow-lg">
        <div class="brand">
            Kendaraan Dinas
        </div>

        <a href="{{ route('dashboard') }}"
            class="menu-item {{ request()->is('/') || request()->is('dashboard') ? 'menu-active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('pegawai.index') }}"
           class="menu-item {{ request()->is('pegawai*') ? 'menu-active' : '' }}">
            <i class="bi bi-people"></i> Pegawai
        </a>

        <a href="{{ route('kendaraan.index') }}"
           class="menu-item {{ request()->is('kendaraan*') ? 'menu-active' : '' }}">
            <i class="bi bi-truck-front"></i> Kendaraan
        </a>

        <a href="{{ route('peminjaman.index') }}"
           class="menu-item {{ request()->is('peminjaman*') ? 'menu-active' : '' }}">
            <i class="bi bi-arrow-left-right"></i> Peminjaman
        </a>

        <a href="{{ route('logout') }}"
           class="menu-item"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="bi bi-box-arrow-right"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>

    {{-- Main Content --}}
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
