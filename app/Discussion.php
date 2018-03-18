<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{

    protected $fillable=[
        'title',
        'raw_content',
        'description',
        'html_content',
        'user_id',
        'status',
    ];
    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->morphToMany('App\Tag','taggable');
    }
}
