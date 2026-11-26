<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja';

    protected $fillable = ['nomor_meja', 'kapasitas', 'zona', 'status'];

    public const DAFTAR_KAPASITAS = [2, 4, 8];
    public const DAFTAR_ZONA      = ['Indoor', 'VIP'];
    public const DAFTAR_STATUS    = ['Tersedia', 'Terisi', 'Dipesan', 'Perbaikan'];
}
