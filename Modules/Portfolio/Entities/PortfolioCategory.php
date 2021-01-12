<?php

namespace Modules\Portfolio\Entities;

use App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioCategory extends Model
{
    use HasFactory;
    use Sluggable;
    use Sluggable;
    public function sluggable()
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        return [
            'slug' => [
                'source' => $column
            ]
        ];
    }
    protected $fillable = [
        'id',
        'status',
        'img',
        'title_ru',
        'title_uk',
        'title_en',
        'slug',
        'sort',
        'deleted_at',
        'content_uk',
        'content_ru',
        'content_en',
        'description_uk',
        'description_ru',
        'description_en',
    ];
    public function getTitleAttribute()
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        return $this->{$column};
    }
    public function getDescriptionAttribute()
    {
        $locale = App::getLocale();
        $column = "description_" . $locale;
        return $this->{$column};
    }
    public function getContentAttribute()
    {
        $locale = App::getLocale();
        $column = "content_" . $locale;
        return $this->{$column};
    }



}
