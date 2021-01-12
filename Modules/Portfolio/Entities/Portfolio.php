<?php

namespace Modules\Portfolio\Entities;

use App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory;
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
    use SoftDeletes;
    protected $fillable = [
        'id',
        'portfolio_categories_id',
        'portfolio_feedback_id',
        'status',
        'img',
        'title_ru',
        'title_uk',
        'title_en',
        'slug',
        'sort',
        'deleted_at',
        'url_site',
        'cms_site',
        'type_site',
        'time_site',
        'description_uk',
        'description_ru',
        'description_en',
        'customer_ru',
        'customer_uk',
        'customer_en',
        'content_ru',
        'content_uk',
        'content_en',
        'created_at',
        'updated_at',

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
    public function getCustomerAttribute()
    {
        $locale = App::getLocale();
        $column = "customer_" . $locale;
        return $this->{$column};
    }


    public function parentCategories()
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_categories_id', 'id');
    }
    public function parentFeeback()
    {
        return $this->belongsTo(PortfolioFeedback::class, 'portfolio_feedback_id', 'id');
    }

}
