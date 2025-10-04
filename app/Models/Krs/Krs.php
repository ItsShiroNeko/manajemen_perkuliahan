<?php

namespace App\Models\Krs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Mahasiswa\Mahasiswa;
use App\Models\Semester\Semester;
use App\Models\Dosen\Dosen;
use App\Models\KrsDetail\KrsDetail;

class Krs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'semester_id',
        'tanggal_pengisian',
        'tanggal_persetujuan',
        'status',
        'total_sks',
        'catatan',
        'dosen_pa_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengisian' => 'datetime',
            'tanggal_persetujuan' => 'datetime',
            'total_sks' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function dosenPa()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pa_id');
    }

    public function krsDetail()
    {
        return $this->hasMany(KrsDetail::class);
    }
}