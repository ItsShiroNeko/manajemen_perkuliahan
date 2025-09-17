<?php 
namespace App\GraphQL\Ruang\Queries;

use App\Models\Ruang\Ruang;

class RuangQuery {
    public function all($_, array $args)
    {
        $query = Ruang::query();
        if (!empty($args['search'])) {
            $query->where('tahun_ajaran', 'like', '%' . $args['search'] . '%');
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