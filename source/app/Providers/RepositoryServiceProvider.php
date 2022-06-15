<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Abstract\IAnnouncementRepository;
use App\Repositories\AnnouncementRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAnnouncementRepository::class, AnnouncementRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
