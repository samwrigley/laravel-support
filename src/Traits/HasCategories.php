<?php

namespace SamWrigley\Support\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasCategories
{
    abstract public function categories(): BelongsToMany;

    /**
     * Scope a query to eager load `categories`
     * relationship to reduce database queries.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCategories(Builder $query): Builder
    {
        return $query->with('categories');
    }

    /**
     * Add categories to item.
     *
     * @param  int[] $categories
     * @return void
     */
    public function addCategories(array $categories): void
    {
        $this->categories()->attach($categories);
    }

    /**
     * Update item's categories.
     *
     * @param  int[] $categories
     * @return void
     */
    public function updateCategories(array $categories): void
    {
        $this->categories()->sync($categories);
    }
}
