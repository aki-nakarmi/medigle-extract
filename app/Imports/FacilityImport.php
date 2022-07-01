<?php

namespace App\Imports;

use App\Models\ClosedFacility;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacilityImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $collection->each(function ($facility) {
            ClosedFacility::create($facility->toArray());
        });
    }

    public function headingRow()
    {
        return 1;
    }
}
