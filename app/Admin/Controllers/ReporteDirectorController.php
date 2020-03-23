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


class ReporteDirectorController extends Controller
{   
    public function index(Content $content)
    {   
        $headers = ['Escuela', 'Pago Estimado', 'Pago Real'];
        $escuelas = Escuela::all();
        $rows = [];

        foreach ($escuelas as  $value) {
            $totalClases = 0;
            $totalClasesEfectivas = 0;
            $a = "";
            $materias = Materia::where('facultad_id', $value->id)->get();
            foreach ($materias as  $materia) {
                $horas = Hora::where('materia_id', $materia->id)->get();
                foreach ($horas as $hora) {
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
                    $a = $hora->estado;
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

                    $totalClases += 300 + $totaPorAcreditacion;
                    $totalClasesEfectivas += 300 + $totaPorAcreditacionEfectiva;
                }
            }

            array_push($rows,[$value->nombre, $totalClases, $totalClasesEfectivas]);
            
        }
        $ts = 0;
        $tr = 0;
        $ah = 0;
        foreach ($rows as $row) {
            $ts += $row[1];
            $tr += $row[2];
        }
        $ah = $ts - $tr;
        array_push($rows,[ '', '<strong>Total Estimado</strong>', $ts]);
        array_push($rows,[ '', '<strong>Total Real</strong>', $tr]);
        array_push($rows,[ '', '<strong>Ahorro</strong>', $ah]);
        

        $table = new Table($headers, $rows);
                
        return $content
            ->title('Reporte')
            ->row($table);
    }
}
