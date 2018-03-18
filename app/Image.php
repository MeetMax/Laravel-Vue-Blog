<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=[
        'raw_image_path',
        'raw_image_name',
        'original_name'
    ];
}
