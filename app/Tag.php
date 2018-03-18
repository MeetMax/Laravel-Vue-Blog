<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=[
        'tag_name',
        'status'
    ];
    public function articles(){
        return $this->morphedByMany('App\Article','taggable');
    }

    public function discussions(){
        return $this->morphedByMany('App\Discussion','taggable');
    }
}
