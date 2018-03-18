<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $image;
    public function __construct(ImageRepository $imageRepository)
    {
        $this->image=$imageRepository;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $pageSize=$request->input('pageSize');
        $currentPage=$request->input('currentPage');
        $data['pageList']=$this->image->getPage($pageSize,$currentPage);
        $data['count']=$this->image->getCount();
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request){
        $file=$request->file('image');
        $path=$file->store('public');
        if($file->isValid()){
            $data['original_name']=$file->getClientOriginalName();
            $data['raw_image_path']=$path;
            $data['raw_image_name']=$file->hashName();
            if($this->image->store($data)){
                return ['code'=>0,'msg'=>'上传成功'];
            }else{
                return ['code'=>1,'msg'=>'上传失败'];
            }
        }
    }

    /**
     * @param $id
     * @return \APP\Repositories\model
     */
    public function show($id){
        return $this->image->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id){
        if($this->image->deleteImage($id)){
            if($this->image->destroy($id)){
                return ['code'=>0,'msg'=>'删除成功'];
            }
            return ['code'=>1,'msg'=>'删除失败'];
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
        if(isset($data['raw_content'])){
            $data['html_content']=$this->image->parsedown($data['raw_content']);
        }
        if($this->image->update($id,$data))
            return ['code'=>0,'msg'=>'修改成功'];
        return ['code'=>1,'msg'=>'修改失败'];
    }
}
