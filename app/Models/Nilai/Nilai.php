<?php

namespace App\Models\Nilai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\KrsDetail\KrsDetail;

class Nilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nilai';

    protected $fillable = [
        'krs_detail_id',
        'tugas',
        'quiz',
        'uts',
        'uas',
        'nilai_akhir',
        'nilai_huruf',
        'nilai_mutu',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tugas' => 'decimal:2',
            'quiz' => 'decimal:2',
            'uts' => 'decimal:2',
            'uas' => 'decimal:2',
            'nilai_akhir' => 'decimal:2',
            'nilai_mutu' => 'decimal:2',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function krsDetail()
    {
        return $this->belongsTo(KrsDetail::class);
    }
}
