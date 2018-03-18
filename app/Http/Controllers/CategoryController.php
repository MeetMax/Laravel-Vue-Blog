<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $article;
    protected $tags;
    public function __construct(CategoryRepository $categoryRepository,ArticleRepository $articleRepository,TagRepository $tags)
    {
        $this->category=$categoryRepository;
        $this->article=$articleRepository;
        $this->tags=$tags;
    }

    public function index($name){
        $articles=$this->category->getArticleByCategory($name,8);
        $categories=$this->category->getWithCount('articles');
        $hot_articles=$this->article->getHotArticles(5);
        $tags=$this->tags->getWithCount('articles');
        return view('article.index',compact('articles','categories','hot_articles','tags'));
    }
}
