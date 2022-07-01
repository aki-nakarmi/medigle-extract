<?php

namespace App\Exports;

use App\Models\ClosedFacility;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClosedExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct()
    {
    }

    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $closedFacilities = ClosedFacility::with('eparkFacility')->get();

        $result=$closedFacilities->filter(function ($facility) {
            return $facility->eparkFacility->count() > 0;
        })->reduce(function ($sum, $facility) {
            $eparks = $facility->eparkFacility;
            if ($facility->eparkFacility->count() > 1) {
                $eparks = $facility->eparkFacility->filter(function ($epark) {
                    return $epark->show == 1;
                });
            }
            $data = $eparks->map(function ($d) use ($facility) {
                $d['closed'] = $facility;
                return $d;
            });
            return $sum->push($data->toArray());

        }, collect([]))->flatten(1);
return $result;
    }

    public function headings(): array
    {
        return [
            'medigleID',
            '電話番号',
            '都道府県',
            '市区郡',
            '町村番地',
            '建物名',
            '施設名',
            'modified_name',
            '住所',
            '市区郡',
            '廃止年月日',
        ];
    }

    public function map($row): array
    {

        return [
            Arr::get($row,'id','-'),
           Arr::get($row,'tel','-'),
            '',
            Arr::get($row,'address1','-'),
            Arr::get($row,'address2','-'),
            Arr::get($row,'address3','-'),
            Arr::get($row,'closed.modified_name','-'),
            Arr::get($row,'closed.address','-'),
            Arr::get($row,'closed.city','-'),
            Arr::get($row,'closed.closed_date','-'),

        ];
    }
}
