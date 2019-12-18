<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Ticket
 * @package App
 */
class Ticket extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'referable');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeOld(Builder $query)
    {
        return $query->where('closed_at', '!=', null);
    }
}
