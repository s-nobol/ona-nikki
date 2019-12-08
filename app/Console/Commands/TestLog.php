<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testlog:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'write test log info messages in log file';

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
     * @return mixed
     */
    public function handle()
    {
        logger()->info('This is WriteLog Command.');
    }
}
