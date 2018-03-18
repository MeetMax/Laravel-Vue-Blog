<?php

namespace App\Http\Controllers\Api;
use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Repositories\DiscussionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $article;
    protected $user;
    protected $discussion;
    protected $comment;
    /**
     * ArticleController constructor.
     * @param ArticleRepository $article
     */
    public function __construct(ArticleRepository $article,UserRepository $userRepository,DiscussionRepository $discussionRepository,CommentRepository $commentRepository)
    {
        $this->article=$article;
        $this->user=$userRepository;
        $this->discussion=$discussionRepository;
        $this->comment=$commentRepository;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $pageSize=$request->input('pageSize');
        $currentPage=$request->input('currentPage');
        $data['pageList']=$this->article->getPage($pageSize,$currentPage);
        $data['count']=$this->article->getCount();
        return $data;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(){
        return $this->article->all();
    }

    /**
     * @param ArticleRequest $request
     * @return array
     */
    public function store(ArticleRequest $request){
        $data=$request->all();
        $data['html_content']=$this->article->parsedown($data['raw_content']);
        if($this->article->store($data)){
            $article=$this->article->getLastModel();
            $article->tags()->attach($data['tags']);
            return ['code'=>0,'msg'=>'保存成功'];
        }
        return ['code'=>1,'msg'=>'保存失败'];
    }

    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id){
        $article=$this->article->getById($id);
        $tags_id=$this->article->getTagsId($id);
        $article['tags_id']=$tags_id;
        return $article;
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
       if($this->article->destroy($id))
           $this->article->destroyComment($id,'articles');
           return ['code'=>0,'msg'=>'删除成功'];
        return ['code'=>1,'msg'=>'删除失败'];
    }

    /**
     * @param $id
     * @param ArticleRequest $request
     * @return array
     */
    public function update($id,ArticleRequest $request){
        $data=$request->all();
        if($this->article->updateArticle($id,$data)){
            if(isset($data['tags'])){
                $this->article->syncTag($id,$data['tags']);
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
        if($this->article->createComments($id,$data)){
            return ['code'=>0,'msg'=>'评论成功'];
        }else{
            return ['code'=>1,'msg'=>'评论失败'];
        }
    }

    public function dashboardCount(){
        $userCount=$this->user->getCount();
        $articleCount=$this->article->getCount();
        $discussionCount=$this->discussion->getCount();
        $commentCount=$this->comment->getCount();
        return compact('userCount','articleCount','discussionCount','commentCount');
    }
}
