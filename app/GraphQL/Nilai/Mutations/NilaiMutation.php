<?php

namespace App\GraphQL\Nilai\Mutations;

use App\Models\Nilai\Nilai;

class NilaiMutation 
{
    public function restore($_, array $args): ?Nilai
    {
        return Nilai::withTrashed()->find($args['id'])?->restore()
        ? Nilai::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Nilai
    {
        $Nilai = Nilai::withTrashed()->find($args['id']);
        if ($Nilai) {
            $Nilai->forceDelete();
            return $Nilai;
        }
        return null;
    }
}   