<?php

namespace Modules\Portfolio\Repositories;

use Modules\Portfolio\Entities\Portfolio as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use App;


//use Your Model

/**
 * Class BlogCategoryRepository.
 */
class PortfolioRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * выводим список  постов с пагинацией
     */


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
    public function getForComboBox()
    {

        $locale = App::getLocale();
        $column = "title_" . $locale;
        $columns = implode(',', [
            'id',
            "CONCAT (id, '. ', $column) AS id_title",
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;

    }

// для вывода гаlереи портфолио на главной
    public function getHomePortfolio()
    {
        $columns = ['img', 'title_ru', 'title_uk', 'title_en', 'description_ru', 'description_uk', 'description_en', 'filter_id', 'cms_site', 'slug'];
        $result = $this
            ->startConditions()
            ->take(5)
            ->select($columns)
            ->where('status', '=', '1')
            ->orderBy('sort', 'DESC')
            ->get();

        return $result;
    }

// для вывода портфолио ы архиве
    public function getArchevePortfolio($perPage = null)
    {
        $columns = ['id', 'img', 'title_ru', 'title_uk', 'title_en', 'sort', 'status', 'filter_id', 'slug', 'description_ru', 'description_uk', 'description_en'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('status', '=', '1')
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        return $result;
    }


}
