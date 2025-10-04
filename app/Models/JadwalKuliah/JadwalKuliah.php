<?php

namespace App\Models\JadwalKuliah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Kelas\Kelas;
use App\Models\Ruangan\Ruangan;

class JadwalKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_kuliah';

    protected $fillable = [
        'kelas_id',
        'ruangan_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jam_mulai' => 'datetime:H:i',
            'jam_selesai' => 'datetime:H:i',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
