<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sim extends Model
{
    protected $fillable = [
        'user_id','target', 'achivement', 'days'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
