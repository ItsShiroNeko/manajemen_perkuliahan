<?php

namespace App\GraphQL\JadwalKuliah\Mutations;

use App\Models\JadwalKuliah\JadwalKuliah;

class JadwalKuliahMutation 
{
    public function restore($_, array $args): ?JadwalKuliah
    {
        return JadwalKuliah::withTrashed()->find($args['id'])?->restore()
        ? JadwalKuliah::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?JadwalKuliah
    {
        $JadwalKuliah = JadwalKuliah::withTrashed()->find($args['id']);
        if ($JadwalKuliah) {
            $JadwalKuliah->forceDelete();
            return $JadwalKuliah;
        }
        return null;
    }
}   