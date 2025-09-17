<?php

namespace App\Models\JadwalKuliah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_kuliah';

    protected $fillable = [
        'kelas_id',
        'ruang_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
            'jam_mulai' => 'datetime:H:i',
            'jam_selesai' => 'datetime:H:i',
        ];
    }
}
