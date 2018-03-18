<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $comment;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->comment=$commentRepository;
    }

    public function store(Request $request){
        $data=$request->all();
        if(Auth::user()->status===1){
            $data['html_content']=$this->comment->parsedown($data['raw_content']);
            if($this->comment->store($data)){
                return back()->withInput();
            }
        }else{
            abort(404);
        }
    }
}
