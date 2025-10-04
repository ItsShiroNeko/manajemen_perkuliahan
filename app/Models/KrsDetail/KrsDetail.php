<?php

namespace App\Models\KrsDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Krs\Krs;
use App\Models\Kelas\Kelas;
use App\Models\MataKuliah\MataKuliah;
use App\Models\Nilai\Nilai;

class KrsDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'krs_detail';

    protected $fillable = [
        'krs_id',
        'kelas_id',
        'mata_kuliah_id',
        'sks',
        'status_ambil',
    ];

    protected function casts(): array
    {
        return [
            'sks' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
