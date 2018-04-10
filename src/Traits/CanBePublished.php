<?php

namespace SamWrigley\Support\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait CanBePublished
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $canBePublishedFillable = [
        'published_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $canBePublishedDates = [
        'published_at',
    ];

    /**
     * Boot the current trait.
     *
     * @return void
     */
    public static function bootCanBePublished()
    {
        static::retrieved(
            function ($model) {
                $model->fillable = array_merge(
                    $model->fillable,
                    $model->canBePublishedFillable
                );

                $model->dates = array_merge(
                    $model->dates,
                    $model->canBePublishedDates
                );
            }
        );
    }

    /**
     * Set item to published at given datetime.
     *
     * @param \Illuminate\Support\Carbon $publishedDateTime
     * @return void
     */
    public function publish(Carbon $publishedDateTime)
    {
        $this->published_at = $publishedDateTime;

        $this->save();
    }

    /**
     * Set item to draft.
     *
     * @return void
     */
    public function draft()
    {
        $this->published_at = null;

        $this->save();
    }

    /**
     * Check if item is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->published_at <= Carbon::now();
    }

    /**
     * Check if item is scheduled.
     *
     * @return bool
     */
    public function isScheduled()
    {
        return $this->published_at < Carbon::now();
    }

    /**
     * Check if item is draft.
     *
     * @return bool
     */
    public function isDraft()
    {
        return is_null($this->published_at);
    }

    /**
     * Scope a query to published items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query
            ->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now());
    }

    /**
     * Scope a query to scheduled items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeScheduled(Builder $query)
    {
        return $query
            ->whereNotNull('published_at')
            ->where('published_at', '>', Carbon::now());
    }

    /**
     * Scope a query to draft items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft(Builder $query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * Scope a query by published month.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMonth(Builder $query, string $month)
    {
        return $query->whereMonth('published_at', $month);
    }

    /**
     * Scope a query by published year.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeYear(Builder $query, string $year)
    {
        return $query->whereYear('published_at', $year);
    }

    /**
     * Scope a query to items published between given datetimes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Carbon $startDateTime
     * @param \Illuminate\Support\Carbon $endDateTime
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereBetween(Builder $query, Carbon $startDateTime, Carbon $endDateTime)
    {
        return $query->whereBetween('published_at', [$startDateTime, $endDateTime]);
    }

    /**
     * Scope a query to items published before given datetime.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Carbon $beforeDateTime
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereBefore(Builder $query, Carbon $beforeDateTime)
    {
        return $query->where('published_at', '<', $beforeDateTime);
    }

    /**
     * Scope a query to items published after given datetime.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Carbon $afterDateTime
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereAfter(Builder $query, Carbon $afterDateTime)
    {
        return $query->where('published_at', '>', $afterDateTime);
    }
}
