<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('uploadExcel', 'UploadController@index');
    

    $router->resource('presupuestos', PresupuestoController::class);
    $router->get('/api/presupuestos', 'PresupuestoController@presupuestos');

    $router->resource('acreditaciones', UsuarioAcreditacionController::class);
    
    $router->resource('escuelas', EscuelaController::class);
    $router->get('/api/escuelas', 'EscuelaController@escuelas');

    $router->resource('facultades', FacultadController::class);
    $router->get('/api/facultades', 'FacultadController@facultades');
    
    $router->resource('materias', MateriaController::class);
    $router->get('/api/materias', 'MateriaController@materias');

    $router->resource('users', UserController::class);
    $router->get('/api/users', 'UserController@users');

    $router->get('/api/admin-users', 'AdminUserController@adminUsers');

    $router->resource('user-infos', UserInfoController::class);
    $router->resource('horas', HoraController::class);

    //REPORTES
    $router->resource('reporte-director', ReporteDirectorController::class);
    $router->resource('reporte-catedratico', ReporteCatedraticoController::class);
    $router->resource('reporte-decano', ReporteDecanoController::class);


});
