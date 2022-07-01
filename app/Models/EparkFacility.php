<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EparkFacility extends Model
{
    use \Awobaz\Compoships\Compoships;
    public $table='epark_facility';
//    public $fillable

    use HasFactory;
}
