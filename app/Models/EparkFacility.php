<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EparkFacility extends Model
{
    use \Awobaz\Compoships\Compoships;

    public $table = 'epark_facility';
//    public $fillable


    public function form()
    {
        return $this->belongsTo(FormModel::class, "form_id", "id");
    }

    public function prefecture()
    {
        return $this->belongsTo(EparkPref::class, "epark_pref_id", "id");
    }

    public function getFormNameAttribute()
    {
        if (empty($this->fom_id)) {
            return "-";
        }
        return $this->form->name;
    }

    public function getPrefectureNameAttribute()
    {
        if (empty($this->epark_pref_id)) {
            return "-";
        }
        return $this->prefecture->name;
    }
}
