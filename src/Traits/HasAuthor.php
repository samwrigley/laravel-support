<?php

namespace SamWrigley\Support\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    abstract public function author(): BelongsTo;

    /**
     * Scope a query to eager load `author`
     * relationship to reduce database queries.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAuthor(Builder $query): Builder
    {
        return $query->with('author');
    }
}
