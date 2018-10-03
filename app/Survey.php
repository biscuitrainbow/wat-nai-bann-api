<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['point', 'result'];

    protected $casts = ['point' => 'int'];
}
