<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCategory
{
    abstract public function category();

    /**
     * Scope a query to eager load `category`
     * relationship to reduce database queries.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCategory(Builder $query)
    {
        return $query->with('category');
    }

    /**
     * Add category to item.
     *
     * @param  int  $category
     * @return void
     */
    public function addCategory(int $category)
    {
        $this->category()->associate($category);
    }

    /**
     * Remove category from item.
     *
     * @return void
     */
    public function removeCategory()
    {
        $this->category()->dissociate();
    }
}
