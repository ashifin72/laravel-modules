<?php

namespace Modules\Blog\Observers;

use App;

use Modules\Blog\Entities\Category;
use Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \Modules\Blog\Entities\Category  $category
     * @return void
     */
    public function created(Category $category)
    {

    }

    public function creating(Category $category)
    {

        $this->setSlug($category);

    }

    public function setSlug($category)
    {
        $locale = App::getLocale();
        $column = "title_" . $locale;
        if (empty($category->slug)) {
            $category->slug = Str::slug($category->$column);
        }
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \Modules\Blog\Entities\Category Category $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    public function updating(Category $category)
    {
        $this->setSlug($category);

    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Modules\Blog\Entities\Category Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \Modules\Blog\Entities\Category Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \Modules\Blog\Entities\Category Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
