<?php

namespace App\Repositories;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageRepository{
    use BaseRepository;
    protected $model;
    public function __construct(Image $image)
    {
        $this->model=$image;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteImage($id){
        $image=$this->getById($id);
        return Storage::delete($image['raw_image_path']);
    }

}