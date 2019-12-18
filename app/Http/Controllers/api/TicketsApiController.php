<?php

namespace App\Http\Controllers\api;

use App\Ticket;
use App\Filters\TicketFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;

class TicketsApiController extends Controller
{
    public function index(TicketFilters $filters)
    {
        $limit = $this->getLimit();

        $tickets = Ticket::with('assignedTo', 'author')
            ->filter($filters)
            ->paginate($limit);

        return TicketResource::collection($tickets);
    }

    /**
     * @return int
     */
    private function getLimit(): int
    {
        $limit = request('limit') ?? 10;
        return ($limit > 100) ? 100 : $limit;
    }
}