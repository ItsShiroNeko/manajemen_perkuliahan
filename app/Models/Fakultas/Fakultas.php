<?php

namespace App\Models\Fakultas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Jurusan\Jurusan;

class Fakultas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fakultas';

    protected $fillable = [
        'kode_fakultas',
        'nama_fakultas',
        'dekan',
        'alamat',
        'telepon',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }
}