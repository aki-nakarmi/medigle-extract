<?php

namespace App\Exports;

use App\Models\CompareTel;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TelExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $comparedTel = CompareTel::with("eparkFacility")->get();
//        $comparedTel->map(function ($tel){
//            dump($tel->eparkFacility->count());
//        });
        return $comparedTel->pluck("eparkFacility")->flatten()->sortBy(function ($epark){
            return $epark->tel;
        });
    }

    public function headings(): array
    {
        return [
            "medigleID",
            "施設名",
            "電話番号",
            "施設形態",
            "開設者",
            "院長",
            "郵便番号",
            "都道府県",
            "市区郡",
            "町村字番地",
            "建物名",
            "閉院",
            "表示",
        ];

        // TODO: Implement headings() method.
    }

    public function map($row): array
    {
        return [
            Arr::get($row, 'id', '-'),
            Arr::get($row, 'facility_name', '-'),
            Arr::get($row, 'tel', '-'),
            $row->formName,
            $row->founder_name??"-",
            $row->doctor_name??"-",
            $row->zip??"-",
            $row->prefectureName,
            Arr::get($row, 'address1', '-'),
            Arr::get($row, 'address2', '-'),
            Arr::get($row, 'building', '-'),
            Arr::get($row, 'is_closed', '-'),
            Arr::get($row, 'show', '-'),
        ];
    }
}
