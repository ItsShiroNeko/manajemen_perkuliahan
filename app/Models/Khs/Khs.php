<?php

namespace App\Models\Khs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Khs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'khs';

    protected $fillable = [
        'mahasiswa_id',
        'semester_id',
        'ip',
        'ipk',
        'total_sks',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
            'ip' => 'decimal:2',
            'ipk' => 'decimal:2',
        ];
    }
}
