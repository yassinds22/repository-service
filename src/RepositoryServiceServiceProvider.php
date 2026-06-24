<?php

namespace Custom\RepositoryService;

use Illuminate\Support\ServiceProvider;
use Custom\RepositoryService\Console\Commands\MakeRepositoryCommand;
use Custom\RepositoryService\Console\Commands\MakeServiceCommand;

class RepositoryServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Create the directories if they don't exist
        $this->createDirectories();

        // 2. Register artisan commands if running in console
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepositoryCommand::class,
                MakeServiceCommand::class,
            ]);
        }
    }

    /**
     * Create Repositories and Services directories in the app folder if they don't exist.
     */
    protected function createDirectories(): void
    {
        $repositoriesPath = app_path('Repositories');
        $servicesPath = app_path('Services');

        if (!file_exists($repositoriesPath)) {
            mkdir($repositoriesPath, 0755, true);
        }

        if (!file_exists($servicesPath)) {
            mkdir($servicesPath, 0755, true);
        }
    }
}
