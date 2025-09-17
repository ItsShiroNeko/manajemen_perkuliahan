<?php

namespace App\Models\Krs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Krs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'semester_id',
        'tanggal_pengisian',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
            'tanggal_pengisian' => 'date',
        ];
    }
}
