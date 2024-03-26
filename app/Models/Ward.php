<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Ward extends BaseModel
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['name', 'initial'];

    public function users()
    {
        return $this->hasMany(User::class, 'ward_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'ward_id', 'id');
    }

    public static function booted()
    {
        static::created(function (Ward $ward)
        {
            if(Auth::check())
            {
                self::where('id', $ward->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (Ward $ward)
        {
            if(Auth::check())
            {
                self::where('id', $ward->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleted(function (Ward $ward)
        {
            if(Auth::check())
            {
                self::where('id', $ward->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
