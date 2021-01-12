<?php

namespace Modules\Section\Repositories;

use Modules\Section\Entities\SectionItem as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use App;


//use Your Model

/**
 * Class BlogCategoryRepository.
 */
class SectionItemRepository extends CoreRepository
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
     * получаем все записи для отдельной секции по section_id
     */
    public function getAllWithSectionItem($perPage = null, $section_id)
    {
        $columns = ['id', 'title_ru', 'title_uk', 'title_en',  'status', 'sort', 'img'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('section_id', '=', $section_id)
            ->orderBy('sort', 'DESC')
            ->paginate($perPage);

        return $result;
    }
    public function getAllWithSectionItemHome($columns = [], $section_id, $i)
    {
        $result = $this
            ->startConditions()
            ->take($i)
            ->where('section_id', '=', $section_id)
            ->orderBy('sort', 'DESC')
            ->get($columns);
        return $result;
    }


}
