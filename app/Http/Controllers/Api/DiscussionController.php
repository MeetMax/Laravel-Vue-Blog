<?php

namespace App\Http\Controllers\Api;
use App\Repositories\DiscussionRepository;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    protected $discussion;

    /**
     * ArticleController constructor.
     * @param DiscussionRepository $article
     */
    public function __construct(DiscussionRepository $discussion)
    {
        $this->discussion=$discussion;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $pageSize=$request->input('pageSize');
        $currentPage=$request->input('currentPage');
        $data['pageList']=$this->discussion->getDiscussion($pageSize,$currentPage);
        $data['count']=$this->discussion->getCount();
        return $data;
    }

    public function getAll(){
        return $this->discussion->all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $Parsedown=new \Parsedown();
        $data['html_content']=$Parsedown->text($data['raw_content']);
        if($this->discussion->store($data)){
            $discussion=$this->discussion->getLastModel();
            $discussion->tags()->attach($data['tags']);
            return ['code'=>0,'msg'=>'保存成功'];
        }
        return ['code'=>1,'msg'=>'保存失败'];
    }


    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id)
    {
        $discussion=$this->discussion->getById($id);
        $discussion['tags_id']=$this->discussion->getTagsId($id);
        return $discussion;
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
        if($this->discussion->destroy($id))
            $this->discussion->destroyComment($id,'discussions');
            return ['code'=>0,'msg'=>'删除成功'];
        return ['code'=>1,'msg'=>'删除失败'];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function update($id,Request $request)
    {
        $data=$request->all();
        if(isset($data['raw_content'])){
            $data['html_content']=$this->discussion->parsedown($data['raw_content']);
        }
        if($this->discussion->update($id,$data)){
            if(isset($data['tags'])){
                $this->discussion->syncTag($id,$data['tags']);
            }
            return ['code'=>0,'msg'=>'修改成功'];
        }
        return ['code'=>1,'msg'=>'修改失败'];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function createComments(Request $request){
        $id=$request->input('able_id');
        $data=$request->all();
        if($this->discussion->createComments($id,$data)){
            return ['code'=>0,'msg'=>'评论成功'];
        }else{
            return ['code'=>1,'msg'=>'评论失败'];
        }
    }
}
