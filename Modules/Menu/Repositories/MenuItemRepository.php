<?php


namespace Modules\Menu\Repositories;


use App;
use Modules\Menu\Entities\MenuItem as Model;
use App\Repositories\CoreRepository;

class MenuItemRepository extends CoreRepository
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
        return Model::class;   }



    /**
     * получаем модель для редактирования в админке по id
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithMenuItem($perPage = null, $id)
    {
        $columns = ['id', 'title_ru', 'title_uk', 'title_en',  'status', 'path', 'sort', 'menu_id', 'parent_id', 'icon'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('menu_id', '=', $id)
            ->orderBy('sort', 'DESC')
            ->paginate($perPage);

        return $result;
    }

    /**
     * получаем пункты меню для вывода в списке
     */
    public function getForComboBox($menu_id)
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
            ->where('menu_id', '=', $menu_id)
            ->toBase()
            ->get();


        return $result;

    }



}
