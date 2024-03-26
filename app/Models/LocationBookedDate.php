<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationBookedDate extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'hoarding_permission_id',
        'date',
        'payment_status'
    ];
}
