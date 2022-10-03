<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ClosedFacility extends Model
{
    use \Awobaz\Compoships\Compoships;
    public $table="closed_facility";
    protected $fillable=[
        'facility_name','modified_name','address','city','closed_date'
    ];

    public function eparkFacility(){
        return $this->hasMany(EparkFacility::class, ['facility_name', 'address1'], ['modified_name', 'city']);
    }
}
