<?php

namespace App\Imports;

use App\Models\CompareTel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TelImport implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection->each(function ($facility) {
            $data=['tel'=>$facility->first(),'tel_natural'=>str_replace("-","",$facility->first())];

            CompareTel::create($data);
        });
    }
    public function headingRow()
    {
        return 1;
    }
}
