<?php

namespace App\Imports;

use App\Jamb;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class JambsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Jamb::updateOrcreate([
        //     'jambregno'=> $row[0],
        //     'surname'=> $row[1],
        //     'middlename'=> $row[2],
        //     'firstname'=> $row[3]
        // ]);

        $jamb = Jamb::updateOrCreate(
            [
                'jambregno'=> strtoupper($row[0]),
                'surname'=> ucfirst($row[1]),
                'firstname'=> ucfirst($row[2]),
                'middlename'=> ucfirst($row[3])
            ]
        );

        return $jamb;
    }
}
