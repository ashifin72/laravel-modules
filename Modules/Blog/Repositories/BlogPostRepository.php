<?php

namespace Modules\Blog\Repositories;

use App;
use Modules\Blog\Entities\Post as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;


//use Your Model

/**
 * Class BlogCategoryRepository.
 */
class BlogPostRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * выводим список  постов с пагинацией
     */

    public function getAllWithPostPaginate($num = 20)
    {
        $columns = [
            'id',
            'title_uk',
            'title_ru',
            'title_en',
            'slug',
            'sort',
            'status',
            'img',
            'created_at',
            'category_id',

        ];
        $locale = App::getLocale();
        $column = "title_" . $locale;
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(["category:id,$column"])// жадная загрузка
            ->paginate($num);


        return $result;
    }

    public function getFrontPostPaginate()
    {
        $columns = [
            'id',
            'title_uk',
            'title_ru',
            'title_en',
            'description_ru',
            'description_en',
            'description_uk',
            'title_ru',
            'slug',
            'sort',
            'status',
            'img',
            'category_id',

        ];
        $locale = App::getLocale();
        $column = "title_" . $locale;
        $result = $this
            ->startConditions()
            ->where('category_id', '>', 1)//  исключаем статичные страницы
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(["category:id,$column,slug,icon"])// жадная загрузка
            ->paginate(20);


        return $result;
    }

    /**
     * получаем модель для редактирования в админке по id
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


}
