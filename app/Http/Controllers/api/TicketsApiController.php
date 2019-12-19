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

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $ticket = Ticket::create($inputs);

        return (new TicketResource($ticket))->response();
    }

    /**
     * @param Ticket $ticket
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Ticket $ticket, Request $request)
    {
        $inputs = $request->all();

        $ticket->update($inputs);

        return (new TicketResource($ticket))->response();
    }
}