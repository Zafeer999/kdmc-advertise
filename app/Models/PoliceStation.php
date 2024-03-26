<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PoliceStation extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ward_id', 'police_station', 'description'];

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    public static function booted()
    {
        static::created(function (PoliceStation $policestation)
        {
            if(Auth::check())
            {
                self::where('id', $policestation->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (PoliceStation $policestation)
        {
            if(Auth::check())
            {
                self::where('id', $policestation->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (PoliceStation $policestation)
        {
            if(Auth::check())
            {
                self::where('id', $policestation->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
