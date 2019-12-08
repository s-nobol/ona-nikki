<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use Log;

use App\Log;
use Faker\Generator as Faker;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *  php artisan testlog:info
     * @var array
     */
    protected $commands = [
        Commands\TestLog::Class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('testlog:info')->everyFiveMinutes();
        
        
        $schedule->call(function() {
            
            
            $carbon = new Carbon();
            $month = $carbon->month;
            $day = $carbon->day;
        
             factory(Log::class)->create([ 
                'month' => $month,
                'day' => $day,
                'created_at' =>$carbon,
            ]);
            
            
            logger()->info('Logを作成しました');
            
        })->everyFifteenMinutes();
        
        
    }
    
    
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
