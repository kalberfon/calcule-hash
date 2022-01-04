<?php

namespace App\Console\Commands;

use App\Models\Hash;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * Class TestHashCalculate
 * @package App\Console\Commands
 */
class TestHashCalculate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:calcule {string : Texto que sera transformado em hash } {--R|request=1 : numero de requisições a serem feitas}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test creating and increment hash\'s';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $this->callHash($this->argument('string'), $this->option("request") ?? 1);

        return Command::SUCCESS;
    }

    /**
     * @param $string
     * @param int $attempts
     * @return mixed
     */
    private function callHash($string, int $attempts)
    {

        $request = Request::create(route('hash.store'), "POST", [
            "string" => $string
        ]);
        /** @var JsonResponse $response */
        $response = app()->handle($request);
        /**
         * Cria a request e roda ela pelo handle da aplicação
         *  O retorno ira responder o mesmo que qualquer requisição normal na api
         *  Para continuar será limpo o cache onde é salva a tabela de rate limit
         *  e continuará a rodar a aplicação
         */
        if ($response->status() === 429) {
            Artisan::call("cache:clear");
            $this->warn("Servidor respondeu {$response->status()}, limpando cache e continuando\n");

            goto continue_left_than;
        } else {
            $response = $response->getData();
            $string = $response->hash;
            $this->info("Chave gerada {$string}");
            $attempts = $attempts - 1;

            goto continue_left_than;
        }

        continue_left_than: {
            if ($attempts > 1)
                return $this->callHash($string, $attempts);
        }
    }

}
