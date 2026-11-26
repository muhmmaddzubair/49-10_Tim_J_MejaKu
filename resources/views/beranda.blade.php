@extends('layouts.app')

@section('judul', 'Beranda')

@section('isi')
    <h1>Beranda</h1>

    <p>
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>.
        Peran Anda: <strong>{{ ucfirst(auth()->user()->role) }}</strong>.
    </p>

    <h3>Menu yang bisa Anda akses</h3>

    @php
        $bisaMeja = auth()->user()->can('viewAny', \App\Models\Meja::class);
    @endphp

    <ul>
        @if ($bisaMeja)
            <li><a href="{{ route('meja.index') }}">Master Meja &amp; Area</a></li>
        @endif
    </ul>

    @unless ($bisaMeja)
        <p>Peran Anda belum memiliki menu yang bisa diakses.</p>
    @endunless
@endsection