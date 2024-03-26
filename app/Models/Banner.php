<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Banner extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['banner_size', 'amount'];

    public static function booted()
    {
        static::created(function (Banner $banner)
        {
            if(Auth::check())
            {
                self::where('id', $banner->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (Banner $banner)
        {
            if(Auth::check())
            {
                self::where('id', $banner->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (Banner $banner)
        {
            if(Auth::check())
            {
                self::where('id', $banner->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
