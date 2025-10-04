<?php

namespace App\Models\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\User;
use App\Models\Jurusan\Jurusan;
use App\Models\Kelas\Kelas;
use App\Models\Krs\Krs;

class Dosen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'nidn',
        'nip',
        'nama_lengkap',
        'gelar_depan',
        'gelar_belakang',
        'jurusan_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email_pribadi',
        'status_kepegawaian',
        'jabatan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
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

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function krsPembimbingAkademik()
    {
        return $this->hasMany(Krs::class, 'dosen_pa_id');
    }
}
