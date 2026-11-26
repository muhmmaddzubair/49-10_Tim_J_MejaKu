<?php

namespace App\Policies;

use App\Models\Meja;
use App\Models\User;

class MejaPolicy
{
    private const PERAN_AKSES = ['admin', 'kasir', 'waiter'];

    // Lihat daftar meja
    public function viewAny(User $user): bool
    {
        return in_array($user->role, self::PERAN_AKSES, true);
    }

    // Tambah meja
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    // Buka form edit (minimal untuk ubah status)
    public function update(User $user, Meja $meja): bool
    {
        return in_array($user->role, self::PERAN_AKSES, true);
    }

    // Ubah nomor / kapasitas / zona (aturan buatan sendiri)
    public function ubahDataMeja(User $user, Meja $meja): bool
    {
        return $user->role === 'admin';
    }

    // Hapus meja
    public function delete(User $user, Meja $meja): bool
    {
        return $user->role === 'admin';
    }
}