<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_ru',
        'title_uk',
        'title_en',
        'description_en',
        'description_ru',
        'description_uk',
        'content_en',
        'content_ru',
        'content_uk',
        'operating_time_uk',
        'operating_time_ru',
        'operating_time_en',
        'data_email',
        'data_phone1',
        'data_phone2',
        'data_phone3',
        'img',
        'img_head',
        'img_footer',
        'slogan_en',
        'slogan_ru',
        'slogan_uk',
        'facebook',
        'youtube',
        'instagram',
        'head_code',
        'footer_code',
    ];

    public function getTitleAttribute()
    {
        $locale = App::getLocale();

        $column = "title_" . $locale;
        return $this->{$column};
    }
    public function getContentAttribute()
    {
        $locale = App::getLocale();
        $column = "content_" . $locale;
        return $this->{$column};
    }
    public function getDescriptionAttribute()
    {
        $locale = App::getLocale();
        $column = "description_" . $locale;
        return $this->{$column};
    }

    public function getOperatingTimeAttribute()
    {
        $locale = App::getLocale();
        $column = "operating_time_" . $locale;
        return $this->{$column};
    }

    public function getSloganAttribute()
    {
        $locale = App::getLocale();
        $column = "slogan_" . $locale;
        return $this->{$column};
    }
}
