<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Factory;

class MakeTestDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testdb:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make test db';

    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    private $fileSystem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Factory $storage)
    {
        parent::__construct();

        $this->fileSystem = $storage->disk('database');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fileSystem->delete('database.sqlite');
        $this->fileSystem->put('database.sqlite', '');
        $this->call('migrate', [
            '--database' => 'sqlite'
        ]);
    }
}
