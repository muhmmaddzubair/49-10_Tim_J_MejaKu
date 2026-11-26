<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class MejaController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Meja::class);

        $query = Meja::query();

        if ($request->filled('cari')) {
            $query->where('nomor_meja', 'like', '%' . $request->cari . '%');
        }

        $daftarMeja = $query->orderBy('nomor_meja')->get();

        return view('meja.index', compact('daftarMeja'));
    }

    public function create()
    {
        Gate::authorize('create', Meja::class);

        return view('meja.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Meja::class);

        $data = $request->validate([
            'nomor_meja' => ['required', 'max:10', 'unique:meja,nomor_meja'],
            'kapasitas'  => ['required', Rule::in(Meja::DAFTAR_KAPASITAS)],
            'zona'       => ['required', Rule::in(Meja::DAFTAR_ZONA)],
            'status'     => ['required', Rule::in(Meja::DAFTAR_STATUS)],
        ], $this->pesanError());

        Meja::create($data);

        return redirect()->route('meja.index')->with('sukses', 'Data meja berhasil ditambah');
    }

    public function edit(Meja $meja)
    {
        Gate::authorize('update', $meja);

        return view('meja.edit', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        Gate::authorize('update', $meja);

        if (Gate::allows('ubahDataMeja', $meja)) {
            // Admin: boleh ubah semua kolom
            $data = $request->validate([
                'nomor_meja' => ['required', 'max:10', Rule::unique('meja', 'nomor_meja')->ignore($meja->id)],
                'kapasitas'  => ['required', Rule::in(Meja::DAFTAR_KAPASITAS)],
                'zona'       => ['required', Rule::in(Meja::DAFTAR_ZONA)],
                'status'     => ['required', Rule::in(Meja::DAFTAR_STATUS)],
            ], $this->pesanError());
        } else {
            // Kasir/Waiter: hanya status. Field lain yang dikirim paksa diabaikan.
            $data = $request->validate([
                'status' => ['required', Rule::in(Meja::DAFTAR_STATUS)],
            ], $this->pesanError());
        }

        $meja->update($data);

        return redirect()->route('meja.index')->with('sukses', 'Data meja berhasil diubah');
    }

    public function destroy(Meja $meja)
    {
        Gate::authorize('delete', $meja);

        $meja->delete();

        return redirect()->route('meja.index')->with('sukses', 'Data meja berhasil dihapus');
    }

    private function pesanError(): array
    {
        return [
            'nomor_meja.required' => 'Nomor meja wajib diisi.',
            'nomor_meja.max'      => 'Nomor meja maksimal 10 karakter.',
            'nomor_meja.unique'   => 'Nomor meja sudah dipakai.',
            'kapasitas.required'  => 'Kapasitas wajib dipilih.',
            'kapasitas.in'        => 'Kapasitas harus 2, 4, atau 8 kursi.',
            'zona.required'       => 'Zona wajib dipilih.',
            'zona.in'             => 'Zona harus Indoor atau VIP.',
            'status.required'     => 'Status wajib dipilih.',
            'status.in'           => 'Status tidak valid.',
        ];
    }
}