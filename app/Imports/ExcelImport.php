<?php

namespace App\Imports;

use App\ExcelPayload;
use App\Materia;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rowIndex = 0;
        $rowInit = 7;
        foreach ($rows as $row) 
        {
            if($rowIndex > 7) {
                

                if ($row[0] != null) {
                    $materiasFiltradas = Materia::where('codigo', $row[0])->get();
                    
                     if(sizeof($materiasFiltradas) > 0){
                        \Log::debug($row);
                     }else {
                        throw new \Exception("Una o alguna de las materias no existe");
                     }
                }
            }
            
            $rowIndex = $rowIndex + 1;
        }
    }
}