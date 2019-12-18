<?php

namespace App\Http\Controllers\api;

use App\Ticket;
use Illuminate\Http\Request;
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

    /**
     * @param Ticket $ticket
     *
     * @return TicketResource
     */
    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        Ticket::create($inputs);

        return response('Ticket created', 201);
    }
}