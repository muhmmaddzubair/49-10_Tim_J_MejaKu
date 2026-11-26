
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai Restoran</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            padding: 35px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #e5e5e5;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #777;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
        }

        .btn {
            padding: 9px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background: #2878d0;
            color: white;
        }

        .btn-edit {
            background: #f0ad4e;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .search {
            padding: 9px 11px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 190px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 13px;
        }

        th {
            background: #f2f4f7;
        }

        tr:hover {
            background: #fafafa;
        }

        .success {
            background: #dff0d8;
            color: #3c763d;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .empty {
            text-align: center;
            color: #777;
        }

        @media (max-width: 700px) {
            body {
                padding: 12px;
            }

            .top {
                flex-direction: column;
                align-items: flex-start;
            }

            .table-wrapper {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <p class="subtitle">
        Sistem pengelolaan data pegawai restoran.
    </p>

    <div class="top">
        <span>Login sebagai <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-delete">Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="top">
@if(auth()->user()->role === 'admin')
    <a href="{{ route('pegawai.create') }}" class="btn btn-add">
        + Tambah Pegawai
    </a>
@else
    <span></span>
@endif
        <form action="{{ route('pegawai.index') }}" method="GET">
            <input
                type="text"
                name="search"
                class="search"
                placeholder="Cari pegawai..."
                value="{{ $keyword }}"
            >
        </form>

    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Posisi</th>
                    <th>Jabatan</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pegawai as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->posisi }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>
                     @if(auth()->user()->role === 'admin')
                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-edit">
                 Edit
              </a>
            <form
            action="{{ route('pegawai.destroy', $item->id) }}"
            method="POST"
            style="display:inline"
            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
          >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">Hapus</button>
            </form>
         @else
           -
         @endif
                </td> 
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Data pegawai belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>

