<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan Dinas</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    {{-- Custom --}}
    <style>
        body {
            background: #f6f3ee;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 245px;
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
            transform: translateX();
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
            to { opacity: 2; transform: translateY(0);}
        }

        /* SUBMENU*/
        .submenu {
        max-height: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        padding-left: 28px;
        transition: max-height 0.35s ease;
        }

        .submenu.show {
            max-height: 500px; /* cukup besar */
        }

        .has-sub {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .submenu-icon {
            transition: transform 0.3s ease;
        }

        .has-sub.open .submenu-icon {
            transform: rotate(180deg);
        }

        /*untuk UI maintenance*/
        .btn-soft-warning {
            background-color: #fff7e6;
            color: #f59e0b;
            border: 1px solid #fde68a;
            transition: all .2s ease;
        }

        .btn-soft-warning:hover {
            background-color: #f59e0b;
            color: #fff;
        }

        .btn-soft-danger {
            background-color: #fff1f2;
            color: #ef4444;
            border: 1px solid #fecaca;
            transition: all .2s ease;
        }

        .btn-soft-danger:hover {
            background-color: #ef4444;
            color: #fff;
        }

        .btn-soft-success {
            background-color: #ecfdf5;
            color: #10b981;
            border: 1px solid #a7f3d0;
            transition: all .2s ease;
        }

        .btn-soft-success:hover {
            background-color: #10b981;
            color: #fff;
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

        <div class="menu-item has-sub {{ request()->is('kendaraan*') ? 'menu-active open' : '' }}"
            onclick="toggleSubmenu('submenu-kendaraan')">
           <i class="bi bi-truck-front"></i> Kendaraan
           <i class="bi bi-chevron-down ms-auto submenu-icon"></i>
       </div>
       
       <div class="submenu {{ request()->is('kendaraan*') ? 'show' : '' }}"
            id="submenu-kendaraan">
       
           <a href="{{ route('kendaraan.index') }}"
              class="menu-item {{ request()->is('kendaraan*') ? 'menu-active' : '' }}">
               <i class="bi bi-dot"></i> Data Kendaraan
           </a>
       
           <a href="{{ route('maintenance.index') }}"
              class="menu-item">
               <i class="bi bi-tools"></i> Maintenance
           </a>
       
           <a href="{{ route('pajak.index') }}"
              class="menu-item">
               <i class="bi bi-receipt"></i> Pajak Kendaraan
           </a>
       </div>
       
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

    <script>
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id);
            const parent = submenu.previousElementSibling;
        
            submenu.classList.toggle('show');
            parent.classList.toggle('open');
        }
    </script>        
    </script>        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
</html>
