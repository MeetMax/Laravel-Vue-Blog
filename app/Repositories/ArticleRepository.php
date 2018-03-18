<?php
    namespace App\Repositories;
    use App\Article;
    class ArticleRepository
    {
        use BaseRepository;
        protected $model;

        /**
         * ArticleRepository constructor.
         * @param Article $article
         */
        public function __construct(Article $article)
        {
            $this->model=$article;
        }

        public function getHotArticles($limit){
            $data=$this->model
                ->orderBy('view_count','desc')
                ->select('id','title','view_count')
                ->where('status',1)
                ->withCount('comments')
                ->orderBy('created_at','desc')
                ->limit($limit)
                ->get();
            return $data;
        }

        /**
         * @param $id
         * @return mixed
         */
        public function showArticle($id)
        {
            return $this->model->where([
                ['id','=',$id],
                ['status','=',1]
            ])->with('tags', 'category','user')->withCount('comments')->get();
        }
        /**
         * 获取WEb的文章分页
         * @param $pageSize
         * @return mixed
         */
        public function getArticlePage($pageSize)
        {
            return $this->model
                ->orderBy('created_at', 'desc')
                ->select('id','title','description','created_at','category_id','is_original')
                ->with('tags', 'category')
                ->withCount('comments')
                ->where('status', 1)
                ->paginate($pageSize);
        }
        /**
         * 更新文章
         * @param $id
         * @param $input
         * @return bool
         */
        public function updateArticle($id,$input)
        {
            $this->model=$this->getById($id);
            $input['html_content']=$this->parsedown($input['raw_content']);
            $this->model->fill($input);
            return $this->model->save();
        }

        /**
         * 归档目录
         * @return mixed
         */
        public function getCatalog(){
            return $this->model
                ->select('id','title','created_at')
                ->orderBy('created_at','desc')
                ->get();
        }


    }