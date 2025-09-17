<?php

namespace App\GraphQL\Dosen\Mutations;

use App\Models\Dosen\Dosen;

class DosenMutation 
{
    public function restore($_, array $args): ?Dosen
    {
        return Dosen::withTrashed()->find($args['id'])?->restore()
        ? Dosen::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Dosen
    {
        $Dosen = Dosen::withTrashed()->find($args['id']);
        if ($Dosen) {
            $Dosen->forceDelete();
            return $Dosen;
        }
        return null;
    }
}   