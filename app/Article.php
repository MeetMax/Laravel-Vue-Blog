<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'html_content',
        'raw_content',
        'is_original',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

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
