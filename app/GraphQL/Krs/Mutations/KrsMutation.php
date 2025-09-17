<?php

namespace App\GraphQL\Krs\Mutations;

use App\Models\Krs\Krs;

class KrsMutation 
{
    public function restore($_, array $args): ?Krs
    {
        return Krs::withTrashed()->find($args['id'])?->restore()
        ? Krs::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Krs
    {
        $Krs = Krs::withTrashed()->find($args['id']);
        if ($Krs) {
            $Krs->forceDelete();
            return $Krs;
        }
        return null;
    }
}   