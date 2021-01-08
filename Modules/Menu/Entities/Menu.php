<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        'id',
        'status',
        'name',
    ];

    protected static function newFactory()
    {
        return \Modules\Menu\Database\factories\MenuFactory::new();
    }
}
