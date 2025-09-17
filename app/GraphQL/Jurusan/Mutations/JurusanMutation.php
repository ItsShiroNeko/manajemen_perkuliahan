<?php

namespace App\GraphQL\Jurusan\Mutations;

use App\Models\Jurusan\Jurusan;

class JurusanMutation 
{
    public function restore($_, array $args): ?Jurusan
    {
        return Jurusan::withTrashed()->find($args['id'])?->restore()
        ? Jurusan::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Jurusan
    {
        $Jurusan = Jurusan::withTrashed()->find($args['id']);
        if ($Jurusan) {
            $Jurusan->forceDelete();
            return $Jurusan;
        }
        return null;
    }
}   