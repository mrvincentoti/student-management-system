<?php

namespace App\Imports;

use App\Models\Jamblist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JamblistImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jamblist([
            'jambregno'     => $row['jambregno'],
            'surname'    => $row['surname'],
            'middlename'    => $row['middlename'],
            'firstname'    => $row['firstname']
        ]);
    }
}
