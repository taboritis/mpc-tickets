<?php

namespace App\Http\Controllers;

use App\Note;

/**
 * Class NotesController
 * @package App\Http\Controllers
 */
class NotesController extends Controller
{
    /**
     * Secure from unwanted access.
     * NotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('support');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $notes = Note::with('author', 'referable')
            ->paginate(25);

        return view('notes.index', compact('notes'));
    }
}
