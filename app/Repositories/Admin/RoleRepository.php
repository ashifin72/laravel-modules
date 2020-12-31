<?php


namespace App\Repositories\Admin;

use App\Models\Role as Model;
use App\Repositories\CoreRepository;


class RoleRepository extends CoreRepository
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * получаем языки для вывода в списке
     */
    public function getForComboBox()
    {
        // клонируем модельку и получаем все поля
//        return $this->startConditions()->all();
//        //  получаем только нужные поля
        $columns = implode(',', [
            'id',
            'name',

        ]);
//        $result[] = $this->startConditions()->all();
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
//        dd($result->first());

        return $result;

    }


}
