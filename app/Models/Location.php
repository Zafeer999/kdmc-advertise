<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Location extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ward_id', 'location', 'description'];

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    public static function booted()
    {
        static::created(function (Location $location)
        {
            if(Auth::check())
            {
                self::where('id', $location->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (Location $location)
        {
            if(Auth::check())
            {
                self::where('id', $location->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (Location $location)
        {
            if(Auth::check())
            {
                self::where('id', $location->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
