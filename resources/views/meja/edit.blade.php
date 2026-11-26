@extends('layouts.app')

@section('judul', 'Edit Meja')

@section('isi')
    <h1>Edit Meja</h1>

    <form method="post" action="{{ route('meja.update', $meja) }}">
        @csrf
        @method('PUT')
        @include('meja._form', ['meja' => $meja])

        <br><br>
        <button type="submit" class="biru">Update</button>
        <a href="{{ route('meja.index') }}" class="tombol abu">Batal</a>
    </form>
@endsection
