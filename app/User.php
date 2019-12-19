<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add global scope
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('ticket_count', function ($builder) {
            $builder->withCount('tickets');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'requested_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'referable');
    }

    /**
     * @return string
     */
    public function fullname()
    {
        return "{$this->name} {$this->surname}";
    }

    /**
     * @return bool
     */
    public function isSupportMember(): bool
    {
        return $this->type === 'support_member';
    }

    /**
     * @param Ticket $ticket
     *
     * @return bool
     */
    public function isAuthor(Ticket $ticket): bool
    {
        return ($this->id == $ticket->requested_by);
    }

    /**
     * @return string
     */
    public function path()
    {
        return "/users/{$this->id}";
    }
}
