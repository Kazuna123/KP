<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kendaraan Dinas</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8f5f0;
            font-family: 'Poppins', sans-serif;
            color: #4e342e;
        }
        nav {
            background-color: #795548;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a {
            color: #fff;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            margin: 2rem auto;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            max-width: 900px;
        }
        button, .btn {
            background-color: #a1887f;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover, .btn:hover {
            background-color: #8d6e63;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #d7ccc8;
        }

    </style>
</head>
<body>
<nav>
    <div><b>Kendaraan Dinas</b></div>
    <div>
        <a href="{{ route('pegawai.index') }}">Pegawai</a>
        <a href="{{ route('kendaraan.index') }}">Kendaraan</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>
