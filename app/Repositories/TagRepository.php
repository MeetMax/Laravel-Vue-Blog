<?php

namespace App\Repositories;
use App\Tag;

class TagRepository{
    use BaseRepository;
    protected $model;
    public function __construct(Tag $tag)
    {
        $this->model=$tag;
    }

    /**
     * 移除关联该标签的文章或者讨论的关联关系
     * @param $id
     */
    public function detach($id){
        $this->getById($id)->discussions()->detach();
        $this->getById($id)->articles()->detach();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getByName($name){
        return $this->model->where('tag_name',$name)->first();
    }

    /**
     * @param $name
     * @param int $pageSize
     */
    public function getArticleByTag($name,$pageSize=8){
        $model=$this->getByName($name);
        if($model){
            return $model
                ->articles()
                ->select('title','description','updated_at','category_id','is_original')
                ->where('status',1)
                ->with('category','tags')
                ->withCount('comments')
                ->paginate($pageSize);
        }
        return abort(404);
    }

    /**
     * @param $name
     * @param int $pageSize
     */
    public function getDiscussionByTag($name,$pageSize=8){
        $model=$this->getByName($name);
        if($model){
            return $model
                ->discussions()
                ->select('title','description','created_at')
                ->where('status',1)
                ->with('tags')
                ->withCount('comments')
                ->paginate($pageSize);
        }
        return abort(404);
    }


}