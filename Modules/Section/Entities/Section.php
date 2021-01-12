<?php

namespace Modules\Section\Entities;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;

  use SoftDeletes;
  protected $fillable = [
    'id',

    'status',
    'img',
    'title_ru',
    'title_uk',
    'title_en',

    'sort',
    'deleted_at',

    'description_uk',
    'description_ru',
    'description_en',
    'slogan_uk',
    'slogan_ru',
    'slogan_en',

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
  public function getSloganAttribute()
  {
    $locale = App::getLocale();
    $column = "slogan_" . $locale;
    return $this->{$column};
  }

    protected static function newFactory()
    {
        return \Modules\Section\Database\factories\SectionFactory::new();
    }
}
