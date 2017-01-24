<?php

namespace Humweb\Categories;

use Baum\Node;

/**
 * App\Category
 *
 * @property integer                                                                     $id
 * @property integer                                                                     $parent_id
 * @property integer                                                                     $lft
 * @property integer                                                                     $rgt
 * @property integer                                                                     $depth
 * @property string                                                                      $title
 * @property string                                                                      $slug
 * @property-read \Humweb\Categories\Category                                            $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Humweb\Categories\Category[] $children
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereDepth($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Humweb\Categories\Category whereParams($value)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutNode($node)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutSelf()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutRoot()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node limitDepth($limit)
 */
class Category extends Node
{
    public    $timestamps = false;
    protected $table      = 'categories';
    protected $fillable   = ['title', 'slug'];
}
