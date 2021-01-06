<?php


namespace Modules\Blog\Repositories;


use Modules\Blog\Entities\Comment as Model;
use App\Repositories\CoreRepository;


class CommentRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithCommentsPaginate()
    {
        $columns = ['id', 'name', 'email', 'status', 'blog_post_id', 'text'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
//            ->with(['category:id,title'])// жадная загрузка
            ->paginate(20);
        return $result;
    }

}
