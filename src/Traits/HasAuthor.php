<?php

namespace SamWrigley\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasAuthor
{
    /**
     * Impose requirements upon the exhibiting class.
     */
    abstract public function author();

    /**
     * Scope a query to eager load `author`
     * relationship to reduce database queries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAuthor(Builder $query)
    {
        return $query->with('author');
    }
}
