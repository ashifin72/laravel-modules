<?php


namespace Modules\Menu\Repositories;


use Modules\Menu\Entities\Menu as Model;
use App\Repositories\CoreRepository;

class MenuRepository extends CoreRepository
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



    /**
     * получаем модель для редактирования в админке по id
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithMenuPaginate($perPage = null)
    {
        $columns = ['id', 'name', 'status'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

}
