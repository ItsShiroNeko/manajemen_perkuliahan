<?php 
namespace App\GraphQL\Krs\Queries;

use App\Models\Krs\Krs;

class KrsQuery {
    public function all($_, array $args)
    {
        $query = Krs::query();
        if (!empty($args['search'])) {
            $query->where('nama_mk', 'like', '%' . $args['search'] . '%');
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