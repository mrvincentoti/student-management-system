<?php

namespace App\Exports;

use App\Jamb;
use Maatwebsite\Excel\Concerns\FromCollection;

class JambsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jamb::all();
    }
}
