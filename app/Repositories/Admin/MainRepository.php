<?php

namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

class MainRepository extends CoreRepository
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;

    }
    /*
    * получаем количество локализаций
    */

    public static function getCountLocal()
    {
        return DB::table('locales')->get()->count();
    }

    /*
     * получаем количество юзеров
     */

    public static function getCountUsers()
    {
        return DB::table('users')->get()->count();
    }
     /*
      *   Поучаем колличество пунктов меню основного языка
      */
    public static function getCountMenu()
    {
        $count =  DB::table('menus')->where('local_id', '1')->get()->count();
        return $count;
    }

    /*
    *   Поучаем колличество фотографий в галерее
    */
    public static function getcountSection()
    {
        $count =  DB::table('sliders')->where('local_id', '1')->get()->count();
        return $count;
    }
    /*
     * получаем количество вопростов в FAQ
     */

    public static function getcountPortfolio()
    {
        return DB::table('faqs')->get()->count();
    }
    /*
     * Получаем данные пользователя
     */
    public static function  getPhotoUser()
    {

    }

}
