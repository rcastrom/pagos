<?php

namespace App\Imports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class PagosImport implements ToModel, WithHeadingRow
{
    private $numRows=0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->numRows;
        return new Pago([
            'referencia'=>$row['referencia'],
            'encontrado'=>$row['encontrado'],
            'enviado'=>$row['enviado']
        ]);
    }
    public function getRowCount(): int
    {
        return $this->numRows;
    }
}
