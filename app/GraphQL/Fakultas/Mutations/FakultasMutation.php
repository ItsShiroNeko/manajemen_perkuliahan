<?php

namespace App\GraphQL\Fakultas\Mutations;

use App\Models\Fakultas\Fakultas;

class FakultasMutation 
{
    public function restore($_, array $args): ?Fakultas
    {
        return Fakultas::withTrashed()->find($args['id'])?->restore()
        ? Fakultas::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Fakultas
    {
        $Fakultas = Fakultas::withTrashed()->find($args['id']);
        if ($Fakultas) {
            $Fakultas->forceDelete();
            return $Fakultas;
        }
        return null;
    }
}   