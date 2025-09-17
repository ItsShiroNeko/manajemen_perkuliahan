<?php

namespace App\GraphQL\Khs\Mutations;

use App\Models\Khs\Khs;

class KhsMutation 
{
    public function restore($_, array $args): ?Khs
    {
        return Khs::withTrashed()->find($args['id'])?->restore()
        ? Khs::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Khs
    {
        $Khs = Khs::withTrashed()->find($args['id']);
        if ($Khs) {
            $Khs->forceDelete();
            return $Khs;
        }
        return null;
    }
}   