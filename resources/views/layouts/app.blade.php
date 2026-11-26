<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="kotak">

        @auth
            <div class="navbar">
                <span>
                    Login sebagai <strong>{{ auth()->user()->name }}</strong>
                    ({{ ucfirst(auth()->user()->role) }})
                </span>
                <span>
                    <a href="{{ route('beranda') }}" class="tombol abu">Beranda</a>
                    <form method="post" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="merah">Logout</button>
                    </form>
                </span>
            </div>
        @endauth

        @yield('isi')
    </div>
</body>
</html>