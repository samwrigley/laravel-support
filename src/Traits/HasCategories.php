<?php

namespace SamWrigley\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCategories
{
    /**
     * Impose requirements upon the exhibiting class.
     */
    abstract public function categories();

    /**
     * Scope a query to eager load `categories`
     * relationship to reduce database queries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCategories(Builder $query)
    {
        return $query->with('categories');
    }

    /**
     * Assign categories to item.
     *
     * @param int[] $categories
     * @return void
     */
    public function assignCategories(array $categories)
    {
        $this->categories()->attach($categories);
    }

    /**
     * Update item's categories.
     *
     * @param int[] $categories
     * @return void
     */
    public function updateCategories(array $categories)
    {
        $this->categories()->sync($categories);
    }
}
