<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reload extends Model
{
    protected $fillable = [
        'user_id','target', 'achivement', 'days'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
