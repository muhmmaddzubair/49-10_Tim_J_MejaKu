@extends('layouts.app')

@section('judul', 'Master Meja & Area')

@section('isi')
    <h1>Master Meja &amp; Area</h1>

    @if (session('sukses'))
        <div class="pesan">{{ session('sukses') }}</div>
    @endif

    <form method="get" action="{{ route('meja.index') }}">
        <input type="text" name="cari" placeholder="Cari nomor meja..." value="{{ request('cari') }}" style="width:60%">
        <button type="submit">Cari</button>
        <a href="{{ route('meja.index') }}" class="tombol abu">Reset</a>

        @can('create', \App\Models\Meja::class)
            <a href="{{ route('meja.create') }}" class="tombol hijau">+ Tambah Meja</a>
        @endcan
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nomor Meja</th>
            <th>Kapasitas</th>
            <th>Zona</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($daftarMeja as $meja)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $meja->nomor_meja }}</td>
                <td>{{ $meja->kapasitas }} kursi</td>
                <td>{{ $meja->zona }}</td>
                <td class="{{ $meja->status }}">{{ $meja->status }}</td>
                <td>
                    @can('update', $meja)
                        <a href="{{ route('meja.edit', $meja) }}" class="tombol biru">
                            @can('ubahDataMeja', $meja) Edit @else Ubah Status @endcan
                        </a>
                    @endcan

                    @can('delete', $meja)
                        <form method="post" action="{{ route('meja.destroy', $meja) }}" class="inline"
                              onsubmit="return confirm('Yakin mau hapus meja ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="merah">Hapus</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center">Data meja tidak ditemukan.</td>
            </tr>
        @endforelse
    </table>
@endsection