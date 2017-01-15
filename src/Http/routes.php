<?php
$router->group([
    'prefix' => 'admin/category',
    'as'     => 'admin.category.'
], function ($router) {

    // Index
    $router->get('/', [
        'as'   => 'get.index',
        'uses' => 'CategoryController@getIndex'
    ]);

    // Create
    $router->get('create/{parent?}', [
        'as'   => 'get.create',
        'uses' => 'CategoryController@getCreate',
    ]);
    $router->post('create/{parent?}', [
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

    // Move / Reorder
    $router->post('move', [
        'as'   => 'move',
        'uses' => 'CategoryController@postMove'
    ]);
});