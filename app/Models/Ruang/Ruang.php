<?php

<?php

// App/Models/Role/Role.php
namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\User;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'nama_role',
        'deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

// App/Models/User/User.php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role\Role;
use App\Models\Dosen\Dosen;
use App\Models\Mahasiswa\Mahasiswa;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'status',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }
}

// App/Models/Fakultas/Fakultas.php
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

// App/Models/Jurusan/Jurusan.php
namespace App\Models\Jurusan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fakultas\Fakultas;
use App\Models\Dosen\Dosen;
use App\Models\Mahasiswa\Mahasiswa;
use App\Models\MataKuliah\MataKuliah;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
        'fakultas_id',
        'jenjang',
        'akreditasi',
        'kaprodi',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}

// App/Models/Semester/Semester.php
namespace App\Models\Semester;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Kelas\Kelas;
use App\Models\Krs\Krs;
use App\Models\Khs\Khs;

class Semester extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'semester';

    protected $fillable = [
        'kode_semester',
        'nama_semester',
        'tahun_ajaran',
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'is_active' => 'boolean',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
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

// App/Models/Ruangan/Ruangan.php
namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JadwalKuliah\JadwalKuliah;

class Ruangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruangan';

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'gedung',
        'lantai',
        'kapasitas',
        'jenis_ruang',
        'fasilitas',
    ];

    protected function casts(): array
    {
        return [
            'lantai' => 'integer',
            'kapasitas' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class);
    }
}