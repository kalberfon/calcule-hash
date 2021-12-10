<?php

namespace App\Observers;

use App\Contracts\Repositories\HashRepositoryListener;
use App\Models\Hash;

class HashObserver
{
    /**
     * Handle the Hash "created" event.
     *
     * @param  \App\Models\Hash  $hash
     * @return void
     */
    public function created(Hash $hash)
    {
        $repository = app()->make(HashRepositoryListener::class);
        $repository->registerBatchAndBlock($hash);
    }
}
