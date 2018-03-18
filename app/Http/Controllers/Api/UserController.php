<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    /**
     * ArticleController constructor.
     * @param UserRepository $article
     */
    public function __construct(UserRepository $user)
    {
        $this->user=$user;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $pageSize=$request->input('pageSize');
        $currentPage=$request->input('currentPage');
        $data['pageList']=$this->user->getPage($pageSize,$currentPage);
        $data['count']=$this->user->getCount();
        return $data;
    }

    /**
     * @param UserRequest $request
     * @return array
     */
    public function store(UserRequest $request){
        $data=$request->all();
        $data['password']=bcrypt($data['password']);
        if($this->user->store($data))
            return ['code'=>0,'msg'=>'保存成功'];
        return ['code'=>1,'msg'=>'保存失败'];
    }


    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id){
        return $this->user->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
        if($this->user->destroy($id))
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
        if(isset($data['password'])){
            $data['password']=bcrypt($data['password']);
        }
        if($this->user->update($id,$data))
            return ['code'=>0,'msg'=>'修改成功'];
        return ['code'=>1,'msg'=>'修改失败'];
    }
}
