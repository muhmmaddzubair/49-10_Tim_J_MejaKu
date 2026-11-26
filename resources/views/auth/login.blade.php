@extends('layouts.app')

@section('judul', 'Login')

@section('isi')
    <h1>Login</h1>

    @if ($errors->any())
        <div class="pesan error">{{ $errors->first() }}</div>
    @endif

    <form method="post" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh: admin@restoran.test">

        <label>Password</label>
        <input type="password" name="password">

        <br><br>
        <button type="submit" class="hijau">Login</button>
    </form>

    {{-- Hapus kotak ini kalau aplikasi sudah dipakai sungguhan --}}
    <div class="pesan" style="margin-top:20px">
        <strong>Akun contoh</strong> (password semuanya: <code>password</code>)
        <ul>
            <li>admin@restoran.test: Admin</li>
            <li>kasir@restoran.test: Kasir</li>
            <li>waiter@restoran.test: Waiter</li>
            <li>chef@restoran.test: Chef</li>
            <li>nonaktif@restoran.test: akun nonaktif</li>
        </ul>
    </div>
@endsection