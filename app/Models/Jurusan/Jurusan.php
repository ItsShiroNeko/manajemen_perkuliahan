<?php

namespace App\Models\Jurusan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fakultas\Fakultas;
use App\Models\Dosen\Dosen;
use App\Models\Mahasiswa\Mahasiswa;
use App\Models\MataKuliah\MataKuliah;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
        'fakultas_id',
        'jenjang',
        'akreditasi',
        'kaprodi',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships dengan Eager Loading Prevention untuk relasi yang tidak digunakan
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }

    // Scope untuk search yang lebih efisien
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where(function($q) use ($search) {
                $q->where('nama_jurusan', 'like', '%' . $search . '%')
                  ->orWhere('kode_jurusan', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}