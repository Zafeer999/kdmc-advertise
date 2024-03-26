<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoardingPermissionDoc extends BaseModel
{
    use HasFactory;

    protected $fillable = [ 'hoarding_permission_id', 'document_id', 'path' ];

    public function hoardingPermission()
    {
        return $this->belongsTo(HoardingPermission::class);
    }
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
