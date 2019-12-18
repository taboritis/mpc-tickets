<?php

namespace App\Http\Controllers\api;

use App\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;

class TicketsApiController extends Controller
{
    public function index()
    {
        $tickets = Ticket::paginate(25);

        return TicketResource::collection($tickets);
    }
}