<?php


namespace App\Repositories\Admin;


use App\Models\Admin\Info;
use App\Models\Admin\Info as Model;
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
    /**
     * получаем котегории для вывода в списке
     */
//    public function getForComboBox()
//    {
//        $columns = implode(',', [
//            'id',
//            'CONCAT (id, ". ", title) AS id_title',
//        ]);
//
//        $result = $this
//            ->startConditions()
//            ->selectRaw($columns)
//            ->toBase()
//            ->get();
//        return $result;
//
//    }

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
