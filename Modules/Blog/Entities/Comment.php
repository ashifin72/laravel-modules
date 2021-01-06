<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        'id',
        'text',
        'name',
        'email',
        'status',
        'site',
        'blog_post_id',
        'parent_id'
    ];
    /**
     * получаем комментируемый пост
     * значения полей 'parent' = 'id' в таблице Comments
     */
    public function parentPost()
    {
        return $this->belongsTo(Post::class, 'blog_post_id', 'id');
    }

}
