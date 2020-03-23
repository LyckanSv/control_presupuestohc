<?php

namespace App\Admin\Controllers;


use App\Hora;
use App\UserInfo;
use App\AdminUser;
use App\Materia;
use App\Escuela;

use Encore\Admin\Widgets\Table;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Admin\Forms\UploadFile;
use Encore\Admin\Grid\Tools\AbstractTool;
use App\UsuarioAcreditacion;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;


class ReporteCatedraticoController extends Controller
{   

    

    public function index(Content $content)
    {   
        $headers = ['Codigo', 'Nombre Docente', 'Codigo Materia', 'Materia', 'Horas estimadas', 'Horas impartidas', 'Pago estimado', 'Pago real'];
        $rows = [];

        $ts = 0;
        $tr = 0;
        $ah = 0;
        $currentAdmin = Admin::user();
        $currentUser = UserInfo::find($currentAdmin->id);

        $horasGeneral = Hora::where('materia_id', 1)->get();
        $horasT = $horasGeneral->groupBy('materia_id');
        foreach ($horasT as $key => $horas) {
            $materia = Materia::find($key);
            $numeroDeHoras = 0;
            $numeroDeHorasEfectivas = 0;
            $pagoEstimado = 0;
            $pagoefectivo = 0;
            foreach ($horas as $key => $hora) {
                $totaPorAcreditacion = 0;
                $totaPorAcreditacionEfectiva = 0;

                $m1s = UsuarioAcreditacion::where([
                    ['usuario_id','=',$hora->docente_id],
                    ['Acreditacion','=','Maestria1'],
                ])->get();

                $m2 = UsuarioAcreditacion::where([
                    ['usuario_id','=',$hora->docente_id],
                    ['Acreditacion','=','Maestria2'],
                ])->get();

                
                $doc = UsuarioAcreditacion::where([
                    ['usuario_id','=',$hora->docente_id],
                    ['Acreditacion','=','Doctorado'],
                ])->get();
                
                
                $dot = UsuarioAcreditacion::where([
                    ['usuario_id','=',$hora->docente_id],
                    ['Acreditacion','=','Doctrinado'],
                ])->get();
                
                foreach ($doc as $m) {
                    $totaPorAcreditacion += (300*0.15); 
                    if($hora->estado != "No Impartida") {
                        $totaPorAcreditacionEfectiva += (300*0.15); 
                    }
                }
                foreach ($dot as $m) {
                    $totaPorAcreditacion += (300*0.17); 
                    if($hora->estado != "No Impartida") {
                        $totaPorAcreditacionEfectiva += (300*0.17); 
                    }
                }
                foreach ($m2 as $m) {
                    $totaPorAcreditacion += (300*0.13); 
                    if($hora->estado != "No Impartida") {
                        $totaPorAcreditacionEfectiva += (300*0.13); 
                    }
                }
                foreach ($m1s as $m) {
                    $totaPorAcreditacion += (300*0.11);
                    if($hora->estado != "No Impartida") {
                        $totaPorAcreditacionEfectiva += (300*0.11); 
                    }
                }

                $numeroDeHoras++;
                if($hora->estado != "No Impartida") {
                    $numeroDeHorasEfectivas++;
                    $pagoefectivo += 300 + $totaPorAcreditacionEfectiva;
                }else{
                }
                $pagoEstimado += 300 + $totaPorAcreditacion;
            }
            $ts += $pagoEstimado;
            $tr += $pagoefectivo;
            array_push($rows,[$currentUser->codigo, $currentAdmin->username, 
            $materia->codigo, $materia->nombre,$numeroDeHoras, 
            $numeroDeHorasEfectivas, $pagoEstimado, $pagoefectivo ]);
        }

                

        array_push($rows,[ '', '', '', '', '', '', '<strong>Total Estimado</strong>', $ts]);
        array_push($rows,[ '', '', '', '', '', '',  '<strong>Total Real</strong>', $tr]);

        $table = new Table($headers, $rows);
                
        return $content
            ->title('Reporte')
            ->row($table);
    }
}
