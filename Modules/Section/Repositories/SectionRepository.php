<?php


namespace Modules\Section\Repositories;


use Modules\Section\Entities\Section as Model;
use App\Repositories\CoreRepository;
use App;

class SectionRepository extends CoreRepository
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
     * получаем котегории для вывода в списке
     */
    public function getForComboBox()
    {
        // клонируем модельку и получаем все поля
//        return $this->startConditions()->all();
//        //  получаем только нужные поля
        $locale = App::getLocale();
        $column = "title_" . $locale;
        $columns = implode(',', [
            'id',
            "CONCAT (id, '. ', $column) AS id_title",
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
