<?php

namespace App\Models\KrsDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KrsDetail  extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'krs_detail';

    protected $fillable = [
        'krs_id',
        'kelas_id',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }
}
