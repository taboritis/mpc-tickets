<?php

namespace App\Filters;

class TicketFilters extends Filters
{
    protected $filters = [ 'assignedTo', 'author', 'title', 'openTicketsOnly' ];

    public function assignedTo(string $name)
    {
        return $this->builder->whereHas('assignedTo', function ($query) use ($name) {
            return $query->where('users.surname', 'like', "%{$name}%")
                ->orWhere('users.name', 'like', "%{$name}%");
        });
    }

    public function author(string $name)
    {
        return $this->builder->whereHas('author', function ($query) use ($name) {
            return $query->where('users.surname', 'like', "%{$name}%")
                ->orWhere('users.name', 'like', "%{$name}%");
        });
    }

    public function title(string $title)
    {
        return $this->builder->where('title', 'like', "%{$title}%");
    }

    public function openTicketsOnly($value)
    {
        return ($value == 'true')
            ? $this->builder->where('closed_at', '!=', null)
            : $this->builder;
    }
}