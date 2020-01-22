<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Log;
use Faker\Generator as Faker;
use Carbon\Carbon;

class CreateLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createlog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        
        
        $carbon = new Carbon();
        $month = $carbon->month;
        $day = $carbon->day;
    
        factory(Log::class)->create([ 
            'month' => $month,
            'day' => $day,
            'created_at' =>$carbon,
        ]);
        
        // ログを出力
        logger()->info('Logをコマンドを実行しました');
        // Log::info('php artisan command:createlog が実行されました');
        
    }
}
