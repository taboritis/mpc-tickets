<?php

namespace App;

use App\Filters\Filters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Ticket
 * @package App
 */
class Ticket extends Model
{
    protected $guarded = [];

    /**
     * Relations to eager loading
     * @var array
     */
    protected $with = [ 'author', 'assignedTo', 'notes' ];

    /**
     * Delete related notes
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ticket) {
            $ticket->notes()->delete();
        });
    }

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
        $days = config('ticket.old');

        return $query
            ->where('closed_at', '<', now()->subDays($days))
            ->where('closed_at', '!=', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedTo()
    {
        return $this->belongsTo(SupportMember::class, 'assigned_to');
    }

    /**
     * @param Builder $query
     * @param Filters $filters
     *
     * @return mixed
     */
    public function scopeFilter(Builder $query, Filters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @return string
     */
    public function path()
    {
        return "/tickets/{$this->id}";
    }
}

