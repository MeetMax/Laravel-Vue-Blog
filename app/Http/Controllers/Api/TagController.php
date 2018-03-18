<?php

namespace App\Http\Controllers\Api;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tag;

    /**
     * ArticleController constructor.
     * @param TagRepository $tag
     */
    public function __construct(TagRepository $tag)
    {
        $this->tag=$tag;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->tag->all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request){
        $data=$request->all();
        if($this->tag->store($data))
            return ['code'=>0,'msg'=>'保存成功'];
        return ['code'=>1,'msg'=>'保存失败'];
    }


    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id){
        return $this->tag->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
        $this->tag->detach($id);
        if($this->tag->destroy($id)){
            return ['code'=>0,'msg'=>'删除成功'];
        }
        return ['code'=>1,'msg'=>'删除失败'];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function update($id,Request $request){
        $data=$request->all();
        if($this->tag->update($id,$data))
            return ['code'=>0,'msg'=>'修改成功'];
        return ['code'=>1,'msg'=>'修改失败'];
    }
}
