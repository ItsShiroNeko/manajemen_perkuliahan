<?php

namespace App\Models\Nilai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nilai';

    protected $fillable = [
        'krs_detail_id',
        'nilai_huruf',
        'nilai_angka',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
            'nilai_angka' => 'decimal:2',
        ];
    }
}
