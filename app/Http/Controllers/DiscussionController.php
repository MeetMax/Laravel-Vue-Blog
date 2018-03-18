<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use App\Repositories\DiscussionRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    protected $discussion;
    protected $tags;
    protected $comments;

    public function __construct(DiscussionRepository $discussionRepository,TagRepository $tagRepository,CommentRepository $commentRepository)
    {
        $this->discussion=$discussionRepository;
        $this->tags=$tagRepository;
        $this->comments=$commentRepository;
    }

    public function index(){
        $discussions=$this->discussion->getWebDiscussion(8);
        $tags=$this->tags->getWithCount('discussions');
        $hot_discussion=$this->discussion->getHotDiscussion(5);
        return view('discussion.index',compact('discussions','tags','hot_discussion'));
    }

    public function show($id){
        $this->discussion->increment($id);
        $discussion=$this->discussion->showDiscussion($id);
        $comments=$this->comments->getCommentsBy($id,'discussions');
        if($discussion){
            return view('discussion.show',compact('discussion','comments'));
        }
        abort(404);
    }

    public function create(Request $request){
        $tags=$this->tags->all();
        return view('discussion.create',compact('tags'));
    }

    public function store(Request $request)
    {
        $data=$request->all();
        if(Auth::user()->status===1){
            $data['html_content']=$this->discussion->parsedown($data['raw_content']);
            if($this->discussion->store($data)){
                $discussion=$this->discussion->getLastModel();
                $discussion->tags()->attach($data['tags']);
                return redirect()->to('discussion');
            }
            return abort(500);
        }else{
            abort(404);
        }

    }


}
