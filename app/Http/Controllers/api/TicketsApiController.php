<?php

namespace App\Http\Controllers\api;

use App\Ticket;
use App\Filters\TicketFilters;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class TicketsApiController
 * @package App\Http\Controllers\api
 */
class TicketsApiController extends BaseApiController
{
    /**
     * @param TicketFilters $filters
     *
     * @return ResourceCollection
     */
    public function index(TicketFilters $filters)
    {
        $limit = $this->getLimit();

        $tickets = Ticket::filter($filters)->paginate($limit);

        return TicketResource::collection($tickets);
    }

    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
    }
}