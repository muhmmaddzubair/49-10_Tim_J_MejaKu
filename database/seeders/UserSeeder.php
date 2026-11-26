<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // [nama, email, role, aktif]
        $akun = [
            ['Admin Restoran', 'admin@restoran.test',    'admin',  true],
            ['Kasir Satu',     'kasir@restoran.test',    'kasir',  true],
            ['Waiter Satu',    'waiter@restoran.test',   'waiter', true],
            ['Chef Satu',      'chef@restoran.test',     'chef',   true],
            ['Kasir Nonaktif', 'nonaktif@restoran.test', 'kasir',  false],
        ];

        foreach ($akun as $a) {
            $user = User::firstOrNew(['email' => $a[1]]);

            // forceFill dipakai karena role/aktif tidak ada di $fillable model User
            $user->forceFill([
                'name'     => $a[0],
                'password' => Hash::make('password'),
                'role'     => $a[2],
                'aktif'    => $a[3],
            ])->save();
        }
    }
}