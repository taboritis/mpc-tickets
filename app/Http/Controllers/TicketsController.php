<?php

namespace App\Http\Controllers;

class TicketsController extends Controller
{
    public function index()
    {
        return view('tickets.index');
    }
}
