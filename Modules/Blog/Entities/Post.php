<?php

namespace Modules\Blog\Entities;

use App;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comment\Entities\Comment;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;
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

    const UNKNOWN_USER = 1;

    protected $fillable = [
        'title_uk',
        'title_ru',
        'title_en',
        'slug',
        'category_id',
        'description_uk',
        'description_ru',
        'description_en',
        'content_uk',
        'content_ru',
        'content_en',
        'status',
        'status_img',
        'sort',
        'published_at',
        'created_at',
        'img',
        'deleted_at',
        'keywords',
        'meta_desc',
        'youtube',
        'github',
        'file_sharing',
        'title_soc',
        'video',
        'description_soc',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * статья пренадлежит категории
     * названия полей в БД едентичны
     */

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * статья пренадлежит Пользователю
     * названия полей в БД едентичны
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function getTitleAttribute()
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        return $this->{$column};
    }
    public function getdescriptionAttribute()
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
