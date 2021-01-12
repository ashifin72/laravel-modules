<?php

namespace Modules\Portfolio\Entities;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioFeedback extends Model
{
    use HasFactory;

  use SoftDeletes;
  protected $fillable = [
    'id',
    'portfolio_id',
    'status',
    'img',
    'title_ru',
    'title_uk',
    'title_en',
    'name_ru',
    'name_uk',
    'name_en',
    'description_ru',
    'description_uk',
    'description_en',
    'sort',
    'deleted_at',
    'status',
    'screen',

    'created_at',
    'updated_at',
    'deleted_at',

  ];

  public function getTitleAttribute()
  {
    $locale = App::getLocale();
    $column = "title_" . $locale;
    return $this->{$column};
  }
  public function getNameAttribute()
  {
    $locale = App::getLocale();
    $column = "name_" . $locale;
    return $this->{$column};
  }
  public function getDescriptionAttribute()
  {
    $locale = App::getLocale();
    $column = "description_" . $locale;
    return $this->{$column};
  }
  public function parentPortfolios()
  {
    return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
  }

    protected static function newFactory()
    {
        return \Modules\Portfolio\Database\factories\PortfolioFeedbackFactory::new();
    }
}
