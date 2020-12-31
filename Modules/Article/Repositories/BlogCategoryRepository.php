<?php

namespace Modules\Article\Repositories;

use App;
use Modules\Article\Entities\Category as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

//use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class BlogCategoryRepository.
 */
class BlogCategoryRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    // получить модель для редактирования в админке
    public function getEdit($id)
    {

        // клонируем модельку и получаем данные по id
        return $this->startConditions()->find($id);
    }

    /**
     * получаем котегории для вывода в списке
     */
    public function getForComboBox()
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        $columns = implode(',', [
            'id',
            'slug',
            'parent_id',
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

    /**
     * @param null $perPage
     * @return mixed
     *
     */

    public function getAllWithCategoryPaginate($perPage = null)
    {
        $columns = ['id','icon', 'title_uk', 'title_ru', 'title_en', 'parent_id', 'sort'];
        $locale = App::getLocale();
        $column = "title_" . $locale;
        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([ // включаем жадную для вывода парент-категории
                "parentCategory:id,$column",
            ])
            ->paginate($perPage);
        return $result;
    }
    public function getCountCategory()
    {

            return $this->startConditions()->get()->count();

    }




}
