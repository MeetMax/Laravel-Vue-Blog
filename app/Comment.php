<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable=[
        'raw_content',
        'html_content',
        'commentable_id',
        'commentable_type',
        'status',
        'user_id'
    ];

    public function commentable(){
        return $this->morphTo();
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
