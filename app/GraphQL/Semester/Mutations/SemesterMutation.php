<?php

namespace App\GraphQL\Semester\Mutations;

use App\Models\Semester\Semester;

class SemesterMutation 
{
    public function restore($_, array $args): ?Semester
    {
        return Semester::withTrashed()->find($args['id'])?->restore()
        ? Semester::find($args['id'])
        : null;
    }

    public function forceDelete($_, array $args): ?Semester
    {
        $Semester = Semester::withTrashed()->find($args['id']);
        if ($Semester) {
            $Semester->forceDelete();
            return $Semester;
        }
        return null;
    }
}   