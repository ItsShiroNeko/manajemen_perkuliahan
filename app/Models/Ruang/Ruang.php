<?php

namespace App\Models\Ruang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruang';

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'kapasitas',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }
}
