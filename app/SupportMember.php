<?php

namespace App;

/**
 * Class SupportMember
 * @package App
 */
class SupportMember extends User
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'users';

    /**
     * Filter User model by type = support_member
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('type', 'support_member');
        });
    }

    /**
     * Override ticket method
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }
}
