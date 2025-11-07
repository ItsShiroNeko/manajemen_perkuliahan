<?php

namespace App\GraphQL\Loaders;

use App\Models\Fakultas;
use Nuwave\Lighthouse\Execution\BatchLoader\BatchLoader;

class FakultasLoader extends BatchLoader
{
    public function resolve()
    {
        $ids = $this->keys();
        $fakultas = Fakultas::whereIn('id', $ids)->get()->keyBy('id');
        foreach ($this->keys as $key) {
            $this->set($key, $fakultas[$key] ?? null);
        }
    }
}
