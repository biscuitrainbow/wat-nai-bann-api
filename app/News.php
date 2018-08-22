<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'content', 'due_date', 'category', 'cover','location'
    ];

    protected $appends = ['diff'];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getDiffAttribute($value)
    {
        return $this->created_at->diffForHumans();
    }
}
