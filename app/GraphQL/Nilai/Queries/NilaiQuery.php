<?php 
namespace App\GraphQL\Nilai\Queries;

use App\Models\Nilai\Nilai;

class NilaiQuery {
    public function allArsip($_, array $args)
    {
        $query = Nilai::onlyTrashed();
        if (!empty($args['search'])) {
            $query->where('tugas', 'like', '%' . $args['search'] . '%');
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
    public function all($_, array $args)
    {
        $query = Nilai::query();
        if (!empty($args['search'])) {
            $query->where('tugas', 'like', '%' . $args['search'] . '%');
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