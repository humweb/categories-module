<?php

namespace Humweb\Categories;

use Humweb\Core\Data\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SluggableTrait;

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


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->slugOptions = [
            'maxlen'     => 200,
            'unique'     => true,
            'slug_field' => 'slug',
            'from_field' => 'title',
        ];
    }

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
