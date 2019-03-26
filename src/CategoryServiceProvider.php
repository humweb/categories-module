<?php

namespace Humweb\Categories;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrations();
        $this->loadViews();
        $this->publishViews();
    }
}
