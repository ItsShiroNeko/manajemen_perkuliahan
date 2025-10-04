<?php 
namespace App\GraphQL\Semester\Queries;

use App\Models\Semester\Semester;

class SemesterQuery {
    public function all($_, array $args)
    {
        $query = Semester::query();
        if (!empty($args['search'])) {
            $query->where('nama_lengkap', 'like', '%' . $args['search'] . '%');
        }
        $perPage = $args['first'] ?? 10;
        $page = $args['page'] ?? 1;

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return [
            'data' => $paginator->items(),
            'paginatorInfo' => [
                'hasMorePages' => $paginator->hasMorePages(),
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ];
    }
}