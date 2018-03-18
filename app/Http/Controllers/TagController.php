<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\DiscussionRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tags;
    protected $article;
    protected $category;
    protected $discussion;
    public function __construct(CategoryRepository $categoryRepository,ArticleRepository $articleRepository,TagRepository $tagRepository,DiscussionRepository $discussionRepository)
    {
        $this->tags=$tagRepository;
        $this->category=$categoryRepository;
        $this->article=$articleRepository;
        $this->discussion=$discussionRepository;
    }

    public function getArticleByTag($name){
        $articles=$this->tags->getArticleByTag($name,8);
        $categories=$this->category->getWithCount('articles');
        $hot_articles=$this->article->getHotArticles(5);
        $tags=$this->tags->getWithCount('articles');
        return view('article.index',compact('articles','categories','hot_articles','tags'));
    }

    public function getDiscussionByTag($name){
        $discussions=$this->tags->getDiscussionByTag($name,8);
        $hot_discussion=$this->discussion->getHotDiscussion(5);
        $tags=$this->tags->getWithCount('discussions');
        return view('discussion.index',compact('discussions','hot_discussion','tags'));
    }
}
