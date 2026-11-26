@extends('layouts.app')

@section('judul', 'Akses Ditolak')

@section('isi')
    <h1>403 - Akses Ditolak</h1>

    <p>Peran Anda tidak memiliki izin untuk membuka halaman atau melakukan tindakan ini.</p>

    <a href="{{ route('beranda') }}" class="tombol abu">Kembali ke Beranda</a>
@endsection