<?php
/**
 * Created by PhpStorm.
 * User: Sasha San
 * Date: 21.05.2019
 * Time: 11:43
 */

namespace App\Repositories;

use App\Models\Locale;
use Illuminate\Database\Eloquent\Model;
use function PHPSTORM_META\elementType;


abstract class CoreRepository
{


    /**
     * с какой моделью он работает
     * Illuminate\Database\Eloquent\Model;
     * @var Model
     */
    protected $model;


    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();


    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }



    public function getAllWithPaginate($perPage = null, $columns = [])
    {
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('sort', 'DESC')
            ->paginate($perPage);

        return $result;
    }

    public function getAllCategoryPaginate($field = 'category_id', $category_id)
    {
        $columns = ['title_ru', 'title_uk', 'title_en', 'slug', 'img', 'description_ru', 'description_uk', 'description_en'];
        $result = $this
            ->startConditions()
            ->where($field, '=', $category_id)
            ->select($columns)
            ->orderBy('sort', 'DESC')
            ->paginate(12);

        return $result;
    }


    public function getEditId($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getEditSlug($slug, $column = 'slug')
    {
        return $this
            ->startConditions()
            ->where($column, '=', $slug)
            ->first();
    }

    //  получаем колличество сущьностей в таблице

    public function getCount()
    {
        return $this->startConditions()->get()->count();
    }


    public function getRequestID($get = true, $id = 'id')
    {
        if ($get) {
            $data = $_GET;
        } else {
            $data = $_POST;
        }
        $id = !empty($data[$id]) ? (int)$data[$id] : null;
        //Если $id не получили то выбросим сразу ошибку
        if (!$id) {
            throw new \Exception('Проверить Откуда id, если getRequestID(false) == $_POST', 404);
        }
        return $id;
    }

    public function issetItem($item)
    {
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись [{$id}] не найденна!"])
                ->withInput();
        }
    }



    public function resultRecording($result, $route, $id = null)
    {
        if ($result) {
            return redirect()->route($route, $id)
                ->with(['success' => 'Успешное сохраненно!']);
        } else {
            return back()
                // если есть ошибка выдай и отправь назад на исходную точку с сохранением данных в инпуте
                ->withErrors(['msg' => 'Ошибка сохранения!',])
                ->withInput();
        }
    }


    /**
     * @return Model
     */
    public function getIdLocale()
    {
        if (session('Locale') && session('Locale') == 'uk') {
            $id_local = 2;
        } else {
            $id_local = 1;
        }
        return $id_local;
    }

    /**
     * получаем активные  локали для вывода вадминке
     */
    public function getActiveLocales()
    {
        $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));
        return $locales;
    }


}
