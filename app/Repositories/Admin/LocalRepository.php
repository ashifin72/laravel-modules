<?php


namespace App\Repositories\Admin;

use App\Models\Locale as Model;
use App\Repositories\CoreRepository;


class LocalRepository extends CoreRepository
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
            'local',
            'status',
            'sort'
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->orderBy('sort', 'desc')
            ->toBase()
            ->get();


        return $result;

    }
// получаем id языка по умалчиванию
    public function receiveLocale()
    {
        $items = $this
            ->startConditions()
            ->get(['id', 'favorite', 'local']);
        foreach ($items as $item) {
            if ($item->favorite == '1') {
                return $item->id;
            }
        }
    }
    // получаем локаль по умалчиванию
    public function gettingLocale()
    {
        $idFavorite = $this->receiveLocale();
        $item = $this->getEditId($idFavorite);
        return $item->local;
    }

    // перезаписываем новый язык по умалчиванию
    public function saveLocale($id, $idFavorite)
    {
        if($idFavorite != $id){
            $endFavorite = $this->getEditId($idFavorite);
            $endFavorite->favorite = '0';
            $endFavorite->save();
            $startFavorite = $this->getEditId($id);
            $startFavorite->favorite = '1';
            $startFavorite->save();

            return redirect()
                ->route('admin.locales.index')
                ->with(['success' => __('admin.favorite') . ' ' .$startFavorite->local ]);

        } else{
            return back()
                ->withErrors(['msg' => __('admin.error_save')])
                ->withInput();
        }
    }
}
