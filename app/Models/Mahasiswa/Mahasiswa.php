<?php

namespace App\Models\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\User;
use App\Models\Jurusan\Jurusan;
use App\Models\Krs\Krs;
use App\Models\Khs\Khs;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama_lengkap',
        'jurusan_id',
        'angkatan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email_pribadi',
        'nama_ayah',
        'nama_ibu',
        'no_hp_ortu',
        'status',
        'semester_saat_ini',
        'ipk',
        'total_sks',
    ];

    protected function casts(): array
    {
        return [
            'angkatan' => 'integer',
            'tanggal_lahir' => 'date',
            'semester_saat_ini' => 'integer',
            'ipk' => 'decimal:2',
            'total_sks' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function khs()
    {
        return $this->hasMany(Khs::class);
    }
}