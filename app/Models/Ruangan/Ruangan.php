<?php
namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JadwalKuliah\JadwalKuliah;

class Ruangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruangan';

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'gedung',
        'lantai',
        'kapasitas',
        'jenis_ruang',
        'fasilitas',
    ];

    protected function casts(): array
    {
        return [
            'lantai' => 'integer',
            'kapasitas' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class);
    }
}