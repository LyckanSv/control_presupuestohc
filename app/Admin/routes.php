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
    $router->resource('presupuestos', PresupuestoController::class);
    $router->resource('escuelas', EscuelaController::class);
    $router->resource('clase-impartidas', ClaseImpartidaController::class);
    $router->resource('tipo-acreditaciones', TipoAcreditacionController::class);
    $router->resource('directores', DirectorController::class);
    $router->resource('usuario-acreditacions', UsuarioAcreditacionController::class);
    $router->resource('bloque-horas', BloqueHoraController::class);
    $router->resource('estado-clases', EstadoClaseController::class);
    $router->resource('tipo-usuarios', TipoUsuarioController::class);
    $router->resource('facultads', FacultadController::class);
    $router->resource('materias', MateriaController::class);
    $router->resource('clases', ClaseController::class);
});
