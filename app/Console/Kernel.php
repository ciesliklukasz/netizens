<?php

namespace App\Console;

use App\Console\Commands\Album\AlbumDelete;
use App\Console\Commands\Album\AlbumDeletePictures;
use App\Console\Commands\Album\AlbumShow;
use App\Console\Commands\Album\AlbumUpdate;
use App\Console\Commands\Picture\PictureImport;
use App\Console\Commands\Picture\PictureUpdate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        PictureImport::class,
        PictureUpdate::class,
        AlbumUpdate::class,
        AlbumShow::class,
        AlbumDeletePictures::class,
        AlbumDelete::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('inspire')
                  ->hourly();
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
