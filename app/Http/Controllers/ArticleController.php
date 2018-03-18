<?php

namespace App\Http\Controllers;
use App\Repositories\ArticleRepository;

use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    protected $article;
    protected $category;
    protected $tags;
    protected $comment;
    public function __construct(ArticleRepository $article,CategoryRepository $category,TagRepository $tags,CommentRepository $commentRepository)
    {
        $this->article=$article;
        $this->category=$category;
        $this->tags=$tags;
        $this->comment=$commentRepository;
    }

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles=$this->article->getArticlePage(8);
        $categories=$this->category->getWithCount('articles');
        $hot_articles=$this->article->getHotArticles(5);
        $tags=$this->tags->getWithCount('articles');
        return view('article.index',compact('articles','categories','hot_articles','tags'));
    }

    public function show($id)
    {
        $this->article->increment($id);
        $article=$this->article->showArticle($id);
        $comments=$this->comment->getCommentsBy($id,'articles');
           if($article){
               return view('article.show',compact('article','comments'));
           }
        return abort(404);
    }

}
