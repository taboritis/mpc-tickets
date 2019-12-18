<?php

namespace App\Filters;

class TicketFilters extends Filters
{
    protected $filters = [ 'assignedTo' ];

    public function assignedTo(string $string)
    {
        return $this->builder->whereHas('assignedTo', function ($query) use ($string) {
            return $query->where('users.surname', 'like', "%{$string}%")
                ->orWhere('users.name', 'like', "%{$string}%");
        });
    }
}