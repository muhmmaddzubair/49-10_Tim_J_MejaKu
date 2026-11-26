
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pegawai</title>
</head>
<body>

    <h2>Tambah Data Pegawai</h2>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('pegawai.store') }}" method="POST">
        @csrf

        <label>Nama Pegawai</label><br>
        <input type="text" name="nama" value="{{ old('nama') }}" required>
        <br><br>

        <label>Posisi</label><br>
        <select name="posisi" required>
            <option value="">-- Pilih Posisi --</option>
            <option value="Chef">Chef</option>
            <option value="Waiter">Waiter</option>
            <option value="Kasir">Kasir</option>
        </select>
        <br><br>

        <label>Jabatan</label><br>
        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required>
        <br><br>

        <label>Kontak</label><br>
        <input type="text" name="kontak" value="{{ old('kontak') }}" required>
        <br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('pegawai.index') }}">Kembali</a>
    </form>

</body>
</html>
