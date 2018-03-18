<?php

namespace App\Http\Controllers\Api;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    /**
     * ArticleController constructor.
     * @param CategoryRepository $article
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category=$category;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->category->all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request){
        $data=$request->all();
        if($this->category->store($data))
            return ['code'=>0,'msg'=>'保存成功'];
        return ['code'=>1,'msg'=>'保存失败'];
    }


    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id){
        return $this->category->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
        if($this->category->destroy($id)){
            $this->category->destroyArticle($id);
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
        if($this->category->update($id,$data))
            return ['code'=>0,'msg'=>'修改成功'];
        return ['code'=>1,'msg'=>'修改失败'];
    }
}
