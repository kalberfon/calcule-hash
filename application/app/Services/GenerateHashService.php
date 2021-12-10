<?php

namespace App\Services;

use App\Contracts\ServiceResponse\GenerateHashServiceResponseListener;
use App\Repositories\HashRepository;
use Illuminate\Support\Str;
use Mockery\Exception;

class GenerateHashService
{
    public function handle(GenerateHashServiceResponseListener $listenerResponse, HashRepository $hashCallRepository, string $string)
    {
        try {
            list($hash, $tries, $key) = $this->generateHash($string);

            $log = $hashCallRepository->create([
                "input" => $string,
                "output" => $hash,
                "key" => $key,
                "tries" => $tries,
            ]);

            if ($log) {
                return $listenerResponse->hashSuccessCreated(
                    $log
                );
            } else {
                goto handle_error;
            }
        } catch (Exception $e) { // Tratamento para algum caso de exceção ao salvar no banco
            goto handle_error;
        }

        handle_error: {
            return $listenerResponse->hashError(
                __('we had an error, try again later')
            );
        }
    }
    private function generateHash($key): array
    {
        $hash = "";
        for ($tries = 0; strpos($hash, '0000') !== 0; $tries++) {
            $key = Str::random(8);
            $hash = md5("{$key}{$key}");
        }

        return [$hash, $tries, $key];
    }
}
