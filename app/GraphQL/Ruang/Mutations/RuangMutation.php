<?php

namespace App\GraphQL\Ruang\Mutations;

use App\Models\Ruang\Ruang;

class RuangMutation 
{
    public function restore($_, array $args): ?Ruang
    {
        return Ruang::withTrashed()->find($args['id'])?->restore()
        ? Ruang::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Ruang
    {
        $Ruang = Ruang::withTrashed()->find($args['id']);
        if ($Ruang) {
            $Ruang->forceDelete();
            return $Ruang;
        }
        return null;
    }
}   