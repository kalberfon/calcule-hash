<?php
namespace App\Repositories;

use App\Contracts\Repositories\HashRepositoryListener;
use App\Models\Hash;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * Class HashRepository
 * @package App\Repositories
 */
class HashRepository implements HashRepositoryListener
{
    /**
     * @param array $colls
     * @return Hash
     */
    public function create(array $colls): Hash
    {
        return Hash::create($colls);
    }

    /**
     * @param $hash
     * @return bool
     * @throws \Exception
     */
    public function registerBatchAndBlock(Hash $hash): bool
    {
        $cols = [
            "batch" => new Carbon()
        ];
        $hash->load('previusBlock');

        if ($hash->previusBlock) {
            $cols["batch"] = $hash->previusBlock->batch;
            $cols["block_number"] = $hash->previusBlock->block_number + 1;
        }
        return $hash->update($cols);
    }

    /**
     * @param int $page
     * @param array $filters
     * @param int $perpage
     * @return LengthAwarePaginator
     */
    public function paginate(int $page, array $filters = [], $perpage = 50): LengthAwarePaginator
    {
        return Hash::
            when($filters["tries"] ?? false, fn ($filterTries) => $filterTries->where('tries', "<", $filters["tries"])) // filtra pelas tentativas
            /**
             * Para Adicionar novos filtros copie a linha a cima e cole e troque o indice
             */
            ->paginate($perpage, ['*'], 'page', $page);
    }
}
