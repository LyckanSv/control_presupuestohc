<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('edificios', EdificioController::class);
    $router->resource('aulas', AulaController::class);
    $router->get('/api/edificios', 'EdificioController@edificios');
    $router->resource('dias', DiaController::class);
});
