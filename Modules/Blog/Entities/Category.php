<?php

namespace Modules\Blog\Entities;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;
    const ROOT_ID = 1;
    // добавляем  поля которые fill  может заполнить
    protected $fillable = [
        'title_uk',
        'title_ru',
        'title_en',
        'slug',
        'parent_id',

        'description_uk',
        'description_ru',
        'description_en',
        'sort',
        'status',
        'slug',
        'icon'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * @return mixed|string
     * выводим логику получения parentCategory()->title из вьюхи, если вдруг значение пустое
     */

    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
                ? 'корень'
                : '???');
        return $title;
    }

    public function isRoot()
    {
        return $this->id === Category::ROOT_ID;
    }

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
}
