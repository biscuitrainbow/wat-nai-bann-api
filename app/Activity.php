<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title', 'datetime', 'point', 'tags'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
