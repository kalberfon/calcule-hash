<?php


namespace App\Contracts\Repositories;


use App\Models\Hash;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface HashRepositoryListener
 * @package App\Contracts\Repositories
 */
interface HashRepositoryListener
{
    /**
     * @param array $colls
     * @return Hash
     */
    public function create(array $colls): Hash;

    /**
     * @param Hash  $hash
     * @return bool
     */
    public function registerBatchAndBlock(Hash $hash): bool;

    /**
     * @param int $page
     * @param array $filters
     * @param int $perpage
     * @return LengthAwarePaginator
     */
    public function paginate(int $page, array $filters = [], $perpage = 50): LengthAwarePaginator;
}
