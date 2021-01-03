<?php

namespace App\Http\Middleware;

use Closure;
use App;
use League\Flysystem\Adapter\Local;
use Request;
use App\Repositories\Admin\LocalRepository;
use App\Models\Admin\Locale;

class LocaleMiddleware
{



    public static $languages = ['en', 'ru', 'uk']; // Указываем, какие языки будем использовать в приложении.





    /**
     * Получаем локализацию по умалчиванию
     */
    public static function getFavoriteLocale()
    {
        $mainLang = Locale::where('favorite', '=', '1')->first();
        return $mainLang->local;
    }



    public static function getLocale()
    {

        $uri = Request::path(); //получаем URI
        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"


        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

            if ($segmentsURI[0] != self::getFavoriteLocale()) return $segmentsURI[0];

        }
        return null;
    }


    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) App::setLocale($locale);
        //если метки нет - устанавливаем основной язык по умалчиванию

        else App::setLocale(self::getFavoriteLocale());

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }
}
