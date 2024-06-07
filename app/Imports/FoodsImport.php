<?php

namespace App\Imports;

use App\Models\Food;

use Maatwebsite\Excel\Concerns\ToModel;

class FoodsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {     
        return new Food([
            'nama' => $row[0],
            'berat' => $row[1],
            'kalorigram' => $row[2],
            'urt' => $row[3],
            'kaloriurt' => $row[4],
            'kategori' => $row[5], 
        ]);
    }
}
