<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $article;
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->article=$articleRepository;
    }

    public function index(){
        $catalogs=$this->article->getCatalog();
        return view('catalog.index',compact('catalogs'));
    }
}
