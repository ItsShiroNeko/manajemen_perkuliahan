<?php

namespace App\Models\MataKuliah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Jurusan\Jurusan;
use App\Models\Kelas\Kelas;
use App\Models\KrsDetail\KrsDetail;

class MataKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'jurusan_id',
        'sks',
        'semester_rekomendasi',
        'jenis',
        'deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'sks' => 'integer',
            'semester_rekomendasi' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function krsDetail()
    {
        return $this->hasMany(KrsDetail::class);
    }
}
