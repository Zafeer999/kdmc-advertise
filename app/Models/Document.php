<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Document extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'initial', 'is_required'];

    public static function booted()
    {
        static::created(function (Document $document)
        {
            if(Auth::check())
            {
                self::where('id', $document->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (Document $document)
        {
            if(Auth::check())
            {
                self::where('id', $document->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (Document $document)
        {
            if(Auth::check())
            {
                self::where('id', $document->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
