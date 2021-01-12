<?php


namespace Modules\Portfolio\Repositories;


use Modules\Portfolio\Entities\PortfolioFeedback as Model;
use App\Repositories\CoreRepository;
use App;

class FeedbackRepository extends CoreRepository
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
    public function getFeedbackPortfolio($id)
    {
        return $this
            ->startConditions()
            ->where('portfolio_id', '=', $id)
            ->first();
    }

}
