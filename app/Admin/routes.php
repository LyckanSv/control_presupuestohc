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
    $router->get('/api/edificios', 'EdificioController@edificios');

    $router->resource('aulas', AulaController::class);
    $router->get('/api/aulas', 'AulaController@aulas');
    
    $router->resource('dias', DiaController::class);
    $router->get('/api/dias', 'DiaController@dias');

    $router->resource('presupuestos', PresupuestoController::class);
    $router->get('/api/presupuestos', 'PresupuestoController@presupuestos');
    
    $router->resource('escuelas', EscuelaController::class);
    $router->get('/api/escuelas', 'EscuelaController@escuelas');

    $router->resource('clase-impartidas', ClaseImpartidaController::class);
    $router->get('/api/clase-impartidas', 'ClaseImpartidaController@clasesImpartidas');    

    $router->resource('tipo-acreditaciones', TipoAcreditacionController::class);
    $router->get('/api/tipo-acreditaciones', 'AulaController@tipoAcreditaciones');

    $router->resource('directores', DirectorController::class);
    $router->get('/api/directores', 'DirectorController@directores');

    $router->resource('usuario-acreditacions', UsuarioAcreditacionController::class);
    $router->get('/api/usuario-acreditaciones', 'UsuarioAcreditacionController@usuarioAcreditaciones');

    $router->resource('bloque-horas', BloqueHoraController::class);
    $router->get('/api/bloque-horas', 'BloqueHoraController@bloqueHoras');

    $router->resource('estado-clases', EstadoClaseController::class);
    $router->get('/api/estado-clases', 'EstadoClaseController@estadoClases');

    $router->resource('tipo-usuarios', TipoUsuarioController::class);
    $router->get('/api/tipo-usuarios', 'TipoUsuarioController@tipoUsuarios');

    $router->resource('facultades', FacultadController::class);
    $router->get('/api/facultades', 'FacultadController@facultades');
    
    $router->resource('materias', MateriaController::class);
    $router->get('/api/materias', 'MateriaController@materias');

    $router->resource('clases', ClaseController::class);
    $router->get('/api/clases', 'ClaseController@clases');

    $router->resource('clase-dias', ClaseDiaController::class);
    $router->get('/api/clases', 'ClaseController@clases');
});
