<?php

namespace Humweb\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    /**
     * Get all of the relations that are assigned this category.
     *
     * @param  string $related
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categorized($related)
    {
        return $this->morphedByMany($related, 'categorizable');
    }
}
