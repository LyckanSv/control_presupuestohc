<?php

namespace App\Admin\Controllers;


use App\Hora;
use App\UserInfo;
use App\AdminUser;
use App\Materia;

use Encore\Admin\Widgets\Table;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Admin\Forms\UploadFile;
use Encore\Admin\Grid\Tools\AbstractTool;

class ReporteDecanoController extends Controller
{   
    public function index(Content $content)
    {   
        $headers = ['Facultad', 'Pago Estimado', 'Pago Real'];
        $rows = [
            [ 'Administracion y finanzas', '300', '200'],
            [ '', '<strong>Total Estimado</strong>', '200'],
            [ '', '<strong>Total Estimado</strong>', '200'],
            [ '', '<strong>Ahorro</strong>', '999'],
        ];

        $table = new Table($headers, $rows);
                
        return $content
            ->title('Reporte')
            ->row($table);
    }
}
