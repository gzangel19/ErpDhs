<?php

namespace App\Exports;

use App\Empresa;
use Maatwebsite\Excel\Concerns\FromCollection;


class EmpresaExport implements FromCollection
{
    

    public function collection()
    {
        return Empresa::where('tipo','like','Empresa')->get();
    }
}
