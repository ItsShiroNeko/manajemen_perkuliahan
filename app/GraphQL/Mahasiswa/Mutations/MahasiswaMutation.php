<?php

namespace App\GraphQL\Mahasiswa\Mutations;

use App\Models\Mahasiswa\Mahasiswa;

class MahasiswaMutation 
{
    public function restore($_, array $args): ?Mahasiswa
    {
        return Mahasiswa::withTrashed()->find($args['id'])?->restore()
        ? Mahasiswa::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Mahasiswa
    {
        $Mahasiswa = Mahasiswa::withTrashed()->find($args['id']);
        if ($Mahasiswa) {
            $Mahasiswa->forceDelete();
            return $Mahasiswa;
        }
        return null;
    }
}   