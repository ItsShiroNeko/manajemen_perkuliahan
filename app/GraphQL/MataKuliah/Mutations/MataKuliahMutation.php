<?php

namespace App\GraphQL\MataKuliah\Mutations;

use App\Models\MataKuliah\MataKuliah;

class MataKuliahMutation 
{
    public function restore($_, array $args): ?MataKuliah
    {
        return MataKuliah::withTrashed()->find($args['id'])?->restore()
        ? MataKuliah::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?MataKuliah
    {
        $MataKuliah = MataKuliah::withTrashed()->find($args['id']);
        if ($MataKuliah) {
            $MataKuliah->forceDelete();
            return $MataKuliah;
        }
        return null;
    }
}   