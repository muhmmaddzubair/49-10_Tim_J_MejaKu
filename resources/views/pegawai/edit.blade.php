<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Data Pegawai</h2>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Pegawai</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $pegawai->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Posisi</label>
            <select name="posisi" class="form-select" required>
                @foreach (['Chef', 'Waiter', 'Kasir'] as $p)
                    <option value="{{ $p }}" @selected(old('posisi', $pegawai->posisi) === $p)>{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control"
                   value="{{ old('jabatan', $pegawai->jabatan) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control"
                   value="{{ old('kontak', $pegawai->kontak) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>