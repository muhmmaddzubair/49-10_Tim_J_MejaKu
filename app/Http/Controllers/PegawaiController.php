<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // READ: Menampilkan semua data pegawai
    public function index(Request $request)
    {
        $keyword = $request->search;

        $pegawai = Pegawai::when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%$keyword%")
                  ->orWhere('posisi', 'like', "%$keyword%")
                  ->orWhere('jabatan', 'like', "%$keyword%")
                  ->orWhere('kontak', 'like', "%$keyword%");
            });
        })->orderBy('id', 'desc')->get();

        return view('pegawai.index', compact('pegawai', 'keyword'));
    }

    // Menampilkan halaman tambah pegawai
    public function create()
    {
        return view('pegawai.create');
    }

    // CREATE: Menyimpan data pegawai
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'posisi' => 'required|in:Chef,Waiter,Kasir',
            'jabatan' => 'required|max:100',
            'kontak' => 'required|max:20',
        ]);

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Menampilkan halaman edit pegawai
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('pegawai.edit', compact('pegawai'));
    }

    // UPDATE: Memperbarui data pegawai
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|max:100',
            'posisi' => 'required|in:Chef,Waiter,Kasir',
            'jabatan' => 'required|max:100',
            'kontak' => 'required|max:20',
        ]);

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // DELETE: Menghapus data pegawai
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }
}
