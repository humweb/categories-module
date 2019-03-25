<?php

namespace Humweb\Categories;

trait Categorizable
{
    /**
     * The "booting" method of the trait.
     *
     * @return void
     */
    protected static function bootCategorizable()
    {
        static::deleting(function ($model) {
            $model->categories->each->delete();
        });
    }

    /**
     * Get all categories for the relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Humweb\Categories\Category::class, 'categorizable')->withPivot('created_at');
    }

    /**
     * Attach one or multiple category to the model.
     *
     * @param  mixed  $categories
     * @return static
     */
    public function categorize($categories)
    {
        $this->categories()->sync($categories, false);

        return $this;
    }

    /**
     * Remove all categories from the model and assign the given ones.
     *
     * @param  mixed  $categories
     * @return static
     */
    public function recategorize($categories = [])
    {
        $this->categories()->sync($categories);

        return $this;
    }

    /**
     * Detach one or multiple category from the model.
     *
     * @param  mixed  $categories
     * @return static
     */
    public function uncategorize($categories)
    {
        $this->categories()->detach($categories);

        return $this;
    }

    /**
     * Get the number of categories for the relation.
     *
     * @return int
     */
    public function getCategoriesCountAttribute()
    {
        if ($this->relationLoaded('categories')) {
            return $this->categories->count();
        }

        return $this->categories()->count();
    }
}
