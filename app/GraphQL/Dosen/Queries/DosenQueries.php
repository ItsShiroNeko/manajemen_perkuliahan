<?php 
namespace App\GraphQL\Dosen\Queries;

use App\Models\Dosen\Dosen;

class DosenQuery {
    public function all($_, array $args)
    {
        $query = Dosen::query();
        if (!empty($args['search'])) {
            $query->where('nama', 'like', '%' . $args['search'] . '%');
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