<?php

namespace App\Http\Controllers;

use App\Ticket;

/**
 * Class TicketsController
 * @package App\Http\Controllers
 */
class TicketsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('tickets.index');
    }

    /**
     * @param Ticket $ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Ticket $ticket)
    {
        $ticket->load('notes.author');

        return view('tickets.show', compact('ticket'));
    }
}
