<?php

namespace App\Http\Controllers\Api;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comment;

    /**
     * ArticleController constructor.
     * @param CommentRepository $article
     */
    public function __construct(CommentRepository $comment)
    {
        $this->comment=$comment;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $pageSize=$request->input('pageSize');
        $currentPage=$request->input('currentPage');
        $data['pageList']=$this->comment->getComment($pageSize,$currentPage);
        $data['count']=$this->comment->getCount();
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request){
        $data=$request->all();
        if($this->comment->store($data))
            return ['code'=>0,'msg'=>'保存成功'];
        return ['code'=>1,'msg'=>'保存失败'];
    }

    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id){
        return $this->comment->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
        if($this->comment->destroy($id))
            return ['code'=>0,'msg'=>'删除成功'];
        return ['code'=>1,'msg'=>'删除失败'];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function update($id,Request $request){
        $data=$request->all();
        if(isset($data['raw_content'])){
            $data['html_content']=$this->comment->parsedown($data['raw_content']);
        }
        if($this->comment->update($id,$data))
            return ['code'=>0,'msg'=>'修改成功'];
        return ['code'=>1,'msg'=>'修改失败'];
    }

    public function getTableType(){
        $data=[
            ['value'=>'discusions','name'=>'讨论'],
            ['value'=>'articles','name'=>'文章']
        ];
        return $data;
    }
}
