<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosedFacility extends Model
{
    public $table="closed_facility";
    protected $fillable=[
        'facility_name','modified_name','address','downtown','closed_date'
    ];
    use HasFactory;
}
