<?php

namespace Modules\Menu\Entities;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        'id',
        'status',
        'title_ru',
        'title_uk',
        'title_en',
        'path',
        'sort',
        'parent_id',
        'menu_id',
        'icon'

    ];

    public function getTitleAttribute()
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        return $this->{$column};
    }

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
    public function parentMenuItem()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Menu\Database\factories\MenuItemFactory::new();
    }
}
