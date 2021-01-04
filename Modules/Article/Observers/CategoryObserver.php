<?php

namespace Modules\Article\Observers;

use App;

use Modules\Article\Entities\Category;
use Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \Modules\Article\Entities\Category  $category
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
     * @param  \Modules\Article\Entities\Category Category $category
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
     * @param  \Modules\Article\Entities\Category Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \Modules\Article\Entities\Category Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \Modules\Article\Entities\Category Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
