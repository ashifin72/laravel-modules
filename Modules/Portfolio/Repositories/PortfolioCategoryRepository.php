<?php


namespace Modules\Portfolio\Repositories;


use Modules\Portfolio\Entities\PortfolioCategory as Model;
use App\Repositories\CoreRepository;
use App;

class PortfolioCategoryRepository extends CoreRepository
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

    public function getAllWithFilterHome($columns = [])
    {
        $result = $this
            ->startConditions()
            ->where('status', '=', '1')
            ->orderBy('sort', 'DESC')
            ->get($columns);
        return $result;
    }



}
