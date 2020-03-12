<?php

namespace App\Imports;

use App\ExcelPayload;
use App\Materia;
use App\Hora;
use App\AdminUser;
use App\UserInfo;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rowIndex = 0;
        $rowInit = 7;
        $collectionUserInfo = [];

        foreach ($rows as $row) 
        {
            if($rowIndex > 7) {
                

                if ($row[0] != null) {

                    $materiasFiltradas = Materia::where('codigo', $row[0])->get();
                    
                    //Validamos si existe el usuario
                     if(sizeof($materiasFiltradas) > 0){
                        
                        //Validamos si existe la info del docente
                        $docentesInfoFiltrados = UserInfo::where('codigo', $row[3])->get();
                        if(sizeof($docentesInfoFiltrados) > 0){

                            // Obtenemos el usuario desde la info del usuario
                            $usuarioId = $docentesInfoFiltrados[0]->usuario_id;
                            $docente = AdminUser::find(1);
                            \Log::debug($docente);
                            $hora = new Hora();
                            $hora->materia_id = $materiasFiltradas[0]->id;
                            $hora->docente_id = $docente->id;
                            $hora->seccion = $row[4];
                            $hora->hora = $row[5];
                            $hora->dias = $row[6];
                            $hora->cupo = $row[7];
                            $hora->inscritos = $row[8];
                            $hora->disponible = $row[9];
                            $hora->aula = $row[10];
                            if($row[11] != null){
                                $hora->estado = $row[11];
                            }else {
                                $hora->estado = 'abierto';
                            }
                            
                            array_push($collectionUserInfo, $hora);
                            \Log::debug('DATOS TRATADOS');
                            \Log::debug($collectionUserInfo);

                        }else{
                            throw new \Exception("No existe el usuario");
                        }
                     }else {
                        throw new \Exception("Una o alguna de las materias no existe");
                     }

                     \Log::debug('DATOS TRATADOS');
                     \Log::debug($collectionUserInfo);

                     foreach ($collectionUserInfo as $value) {
                         $value->save();
                     }
                }
            }

            
            $rowIndex = $rowIndex + 1;
        }
    }
}