<?php
 namespace APP\Repositories;

 use App\Comment;

 trait BaseRepository
 {

     /**
      * 根据id获取model
      * @param $id
      * @return model
      */
     public function getById($id)
     {
         return $this->model->findOrFail($id);
     }

     /**
      * 基本删除操作
      * @param $id
      * @return BaseRepository
      */
     public function destroy($id)
     {
         return $this->getById($id)->delete();
     }

     /**
      * API查询分页
      * @return mixed
      */
     public function getPage($pageSize, $currentPage)
     {
         return $this->model->orderBy('created_at', 'desc')->offset($pageSize * ($currentPage - 1))->limit($pageSize)->get();
     }

     /**
      * 查询所有数据
      * @return mixed
      */
     public function all()
     {
         return $this->model->orderBy('created_at', 'desc')->get();
     }

     /**
      * 查询表的总数量
      * @return mixed
      */
     public function getCount()
     {
         return $this->model->count();
     }

     /**
      * 新增记录
      * @param $model
      * @param $input
      * @return mixed
      */
     public function store($input)
     {
         $this->model->fill($input);
         return $this->model->save();
     }

     /**
      * 获取新增记录的id
      * @return mixed
      */
     public function getId()
     {
         return $this->model->id;
     }

     /**
      * 获取最近新增的Model
      * @return model
      */
     public function getLastModel()
     {
         return $this->getById($this->model->id);
     }

     /**
      * 修改记录
      * @param $id
      * @param $input
      * @return model
      */
     public function update($id, $input)
     {
         $this->model = $this->getById($id);

         $this->model->fill($input);

         return $this->model->save();
     }

     /**
      * 将tag_id组合成数组
      * @param $id
      * @return array
      */
     public function getTagsId($id)
     {
         $tags = $this->getById($id)->tags()->get();
         $tags_id = [];
         foreach ($tags as $tag) {
             $tags_id[] = $tag->id;
         }
         return $tags_id;
     }

     /**
      * 把markdown转化成Html
      * @param $data
      * @return string
      */
     public function parsedown($data)
     {
         $parsedown = new \Parsedown();
         return $parsedown->text($data);
     }

     /**
      * 同步更新tags
      * @param $id
      * @param array $tags
      */
     public function syncTag($id, array $tags)
     {
         $this->getById($id)->tags()->sync($tags);
     }

     /**
      * 创建评论
      * @param $id
      * @param $data
      */
     public function createComments($id, $data)
     {
         $data['html_content'] = $this->parsedown($data['raw_content']);
         $comments = new Comment($data);
         return $this->getById($id)->comments()->save($comments);
     }

     /**
      * 删除评论
      * @param $commentable_id
      * @param $commentable_type
      */
     public function destroyComment($commentable_id, $commentable_type)
     {
         $comment = new Comment();
         $comment->where([
             ['commentable_id', '=', $commentable_id],
             ['commentable_type', '=', $commentable_type]
         ])->delete();
     }


     /**
      * 获取表行的数量
      * @return mixed
      */
     public function getWithCount($type)
     {
         return $this
             ->model
             ->withCount($type)
             ->get();
     }

     /**
      * 获取文章或者讨论的所有评论
      * @param $commentable_id
      * @param $commentable_type
      * @return mixed
      */
     public function getCommentsBy($commentable_id, $commentable_type)
     {
         return $this->model
             ->where([
                 ['commentable_id', '=', $commentable_id],
                 ['commentable_type', '=', $commentable_type],
                 ['status', '=', 1]
             ])->with('user')->get();
     }

     /**
      * @param $id
      * @return mixed
      */
     public function increment($id)
     {
         return $this->getById($id)->increment('view_count');
     }

 }