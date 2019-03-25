<?php
$router->group([
    'prefix' => 'admin/categories',
    'as'     => 'admin.category.'
], function ($router) {

    // Index
    $router->get('/', [
        'as'   => 'get.index',
        'uses' => 'CategoryController@getIndex'
    ]);

    // Create
    $router->get('create', [
        'as'   => 'get.create',
        'uses' => 'CategoryController@getCreate',
    ]);
    $router->post('create', [
        'as'   => 'post.create',
        'uses' => 'CategoryController@postCreate',
    ]);

    // Update
    $router->get('update/{id}', [
        'as'   => 'get.update',
        'uses' => 'CategoryController@getUpdate',
    ]);
    $router->post('update/{id}', [
        'as'   => 'post.update',
        'uses' => 'CategoryController@postUpdate',
    ]);

    // Delete
    $router->any('delete/{id}', [
        'as'   => 'get.delete',
        'uses' => 'CategoryController@getDelete',
    ]);

});