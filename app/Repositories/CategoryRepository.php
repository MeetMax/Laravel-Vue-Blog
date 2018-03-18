<?php

namespace App\Repositories;
use App\Article;
use App\Category;

class CategoryRepository{
    use BaseRepository;
    protected $model;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model=$category;
    }

    /**
     * 删除分类下的所有文章
     * @param $id
     */
    public function destroyArticle($id)
    {
        $article=new Article();
        $article->where('category_id',$id)->delete();
    }

    /**
     * 根据名字获取分类模型
     * @param $category_name
     * @return mixed
     */
    public function getByName($category_name)
    {
        return $this->model->where('category_name',$category_name)->first();
    }

    /**
     * 获取分类下的文章
     * @param $category_name
     * @param int $pageSize
     * @return mixed
     */
    public function getArticleByCategory($category_name,$pageSize=8)
    {
        $model=$this->getByName($category_name);
        if($model)
            return $model
                ->articles()
                ->where('status',1)
                ->select('id','title','description','created_at','category_id','is_original')
                ->with('tags','category')
                ->withCount('comments')
                ->paginate($pageSize);
        return abort(404);

    }
}