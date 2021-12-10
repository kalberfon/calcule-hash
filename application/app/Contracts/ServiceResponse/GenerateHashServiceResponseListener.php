<?php
namespace App\Contracts\ServiceResponse;

use App\Models\Hash;

/**
 * Interface GenerateHashServiceResponseListener
 * @package App\Contracts\ServiceResponse
 */
interface GenerateHashServiceResponseListener
{
    /**
     * @param Hash $hash
     * @return mixed
     */
    public function hashSuccessCreated(Hash $hash);

    /**
     * @param $error
     * @return mixed
     */
    public function hashError($error);
}
