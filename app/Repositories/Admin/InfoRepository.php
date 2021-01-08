<?php


namespace App\Repositories\Admin;



use App\Models\Info as Model;
use App\Repositories\CoreRepository;

class InfoRepository extends CoreRepository
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


    public function getAllWithInfo($perPage = null, $columns = [])
    {
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        return $result;
    }

}
