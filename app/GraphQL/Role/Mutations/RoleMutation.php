<?php

namespace App\GraphQL\Role\Mutations;

use App\Models\Role\Role;

class RoleMutation 
{
    public function restore($_, array $args): ?Role
    {
        return Role::withTrashed()->find($args['id'])?->restore()
        ? Role::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Role
    {
        $Role = Role::withTrashed()->find($args['id']);
        if ($Role) {
            $Role->forceDelete();
            return $Role;
        }
        return null;
    }
}   