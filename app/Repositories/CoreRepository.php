<?php
/**
 * Created by PhpStorm.
 * User: Sasha San
 * Date: 21.05.2019
 * Time: 11:43
 */

namespace App\Repositories;

use App\Models\locale;
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
    public function getAllCategoryPaginate($field='category_id', $category_id)
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

    public function getEditSlug($slug, $column='slug')
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

//    /**  Resize Images for My needs */
//    public static function resize($target, $dest, $wmax, $hmax, $ext)
//    {
//        list($w_orig, $h_orig) = getimagesize($target);
//        $ratio = $w_orig / $h_orig;
//
//        if (($wmax / $hmax) > $ratio) {
//            $wmax = $hmax * $ratio;
//        } else {
//            $hmax = $wmax / $ratio;
//        }
//
//        $img = "";
//        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
//        switch ($ext) {
//            case("gif"):
//                $img = imagecreatefromgif($target);
//                break;
//            case("png"):
//                $img = imagecreatefrompng($target);
//                break;
//            default:
//                $img = imagecreatefromjpeg($target);
//        }
//        $newImg = imagecreatetruecolor($wmax, $hmax);
//        if ($ext == "png") {
//            imagesavealpha($newImg, true);
//            $transPng = imagecolorallocatealpha($newImg, 0, 0, 0, 127);
//            imagefill($newImg, 0, 0, $transPng);
//        }
//        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig,
//            $h_orig); // копируем и ресайзим изображение
//        switch ($ext) {
//            case("gif"):
//                imagegif($newImg, $dest);
//                break;
//            case("png"):
//                imagepng($newImg, $dest);
//                break;
//            default:
//                imagejpeg($newImg, $dest);
//        }
//        imagedestroy($newImg);
//    }

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
