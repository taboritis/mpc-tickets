<?php

namespace App\Http\Controllers;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('support');
    }

    public function index()
    {
    }
}
