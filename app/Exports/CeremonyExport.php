<?php

namespace App\Exports;

use App\Models\Ceremony;
use Maatwebsite\Excel\Concerns\FromCollection;

class CeremonyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ceremony::all();
    }
}
