<?php

namespace App\Providers;

use App\Console\Core\Registry\CommandRegistry;
use App\Console\PictureImport\Command\DefaultCommand;
use App\Console\PictureImport\Command\OnlyNewCommand;
use App\Console\PictureImport\Command\OverwriteCommand;
use function foo\func;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommandRegistry::class, function ($app) {
            return new CommandRegistry(
                $app->make(OverwriteCommand::class),
                $app->make(OnlyNewCommand::class),
                $app->make(DefaultCommand::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
