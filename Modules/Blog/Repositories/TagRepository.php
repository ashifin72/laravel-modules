<?php


namespace Modules\Blog\Repositories;


use App;
use Modules\Blog\Entities\Tag as Model;
use App\Repositories\CoreRepository;


class TagRepository extends CoreRepository
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

    public function getAllWithTagPaginate($num = 20)
    {
        $columns = ['id', 'title_uk', 'title_ru', 'title_en', 'slug'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->paginate($num);
        return $result;
    }
    /**
     * получаем Teub для вывода в списке
     */
    public function getForComboBox()
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        $columns = [
            'id',
            "$column",
        ];
//        $result[] = $this->startConditions()->all();
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->toBase()
            ->get();
//        dd($result->first());

        return $result;

    }

}
