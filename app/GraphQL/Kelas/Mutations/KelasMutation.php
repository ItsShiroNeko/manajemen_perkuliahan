<?php

namespace App\GraphQL\Kelas\Mutations;

use App\Models\Kelas\Kelas;

class KelasMutation 
{
    public function restore($_, array $args): ?Kelas
    {
        return Kelas::withTrashed()->find($args['id'])?->restore()
        ? Kelas::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Kelas
    {
        $Kelas = Kelas::withTrashed()->find($args['id']);
        if ($Kelas) {
            $Kelas->forceDelete();
            return $Kelas;
        }
        return null;
    }
}   