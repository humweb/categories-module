<?php

namespace Humweb\Categories;

use Humweb\Modules\ModuleBaseProvider;

class CategoriesServiceProvider extends ModuleBaseProvider
{

    protected $moduleMeta = [
        'name'    => 'Categories',
        'slug'    => 'categories',
        'version' => '1.0',
        'author'  => '',
        'email'   => '',
        'website' => '',
    ];


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['modules']->put('categories', $this);
        $this->loadMigrations();
        $this->loadViews();
        $this->publishViews();
    }


    public function getAdminMenu()
    {
        return [
            'Content' => [
                [
                    'label'    => 'Categories',
                    'url'      => route('admin.category.get.index'),
                    'icon'     => '<i class="fa fa-book"></i>',
                    'children' => [
                        ['label' => 'List', 'url' => route('admin.category.get.index')],
                        ['label' => 'Create', 'url' => route('admin.category.get.create')],
                    ],
                ],
            ],
        ];
    }
}
