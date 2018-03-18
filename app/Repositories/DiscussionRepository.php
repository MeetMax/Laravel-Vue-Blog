<?php

namespace App\Repositories;
use App\Discussion;

class DiscussionRepository{
    use BaseRepository;
    protected $model;
    public function __construct(Discussion $discussion)
    {
        $this->model=$discussion;
    }
    /**
     * API查询分页
     * @return mixed
     */
    public function getDiscussion($pageSize,$currentPage)
    {
        return $this->model
            ->orderBy('created_at','desc')
            ->with('user')
            ->offset($pageSize*($currentPage-1))
            ->limit($pageSize)
            ->get();
    }

    /**
     * WEB查询分页
     * @param $pageSize
     * @return mixed
     */
    public function getWebDiscussion($pageSize=8){
        return $this->model
            ->where('status',1)
            ->select('id','created_at','title','description')
            ->orderBy('updated_at','desc')
            ->with('tags')
            ->withCount('comments')
            ->paginate($pageSize);
    }

    /**
     * 获取热门讨论
     * @param $limit
     * @return mixed
     */
    public function getHotDiscussion($limit=5){
        $data=$this->model
            ->where('status',1)
            ->select('id','title')
            ->orderBy('view_count','desc')
            ->where('status',1)
            ->withCount('comments')
            ->orderBy('created_at','desc')
            ->limit($limit)
            ->get();
        return $data;
    }

    /**
     * 获取某条讨论
     * @param $id
     * @return mixed
     */
    public function showDiscussion($id)
    {
        return $this->model->where([
            ['id','=',$id],
            ['status','=',1]
        ])->with(['tags','user'=>function($query){
            $query->select('id','name');
        }])
            ->withCount('comments')
            ->get();
    }

}