@extends('layouts.app')

@section('judul', 'Tambah Meja')

@section('isi')
    <h1>Tambah Meja</h1>

    <form method="post" action="{{ route('meja.store') }}">
        @csrf
        @include('meja._form', ['meja' => null])

        <br><br>
        <button type="submit" class="hijau">Simpan</button>
        <a href="{{ route('meja.index') }}" class="tombol abu">Batal</a>
    </form>
@endsection
