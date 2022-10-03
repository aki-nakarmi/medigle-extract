<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CompareTel extends Model
{
    public $table="compare_tel";
    protected $fillable=['tel','tel_natural'];

    public function eparkFacility(){
        return $this->hasMany(EparkFacility::class,"tel_natural", "tel_natural")->where("is_closed",false)->where("show",true);
    }

}
