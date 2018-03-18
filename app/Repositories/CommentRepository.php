<?php

namespace App\Repositories;
use App\Comment;


class CommentRepository{
    use BaseRepository;
    protected $model;
    public function __construct(Comment $comment)
    {
        $this->model=$comment;
    }

    /**
     * 查询分页
     * @return mixed
     */
    public function getComment($pageSize,$currentPage)
    {
        return $this->model->orderBy('created_at','desc')->with('user','commentable')->offset($pageSize*($currentPage-1))->limit($pageSize)->get();
    }

}