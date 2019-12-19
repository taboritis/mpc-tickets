<?php

namespace App\Http\Controllers\api;

use App\Note;
use App\User;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;

class CreateNotesApiController extends Controller
{
    public function user(User $user, Request $request)
    {
        $this->authorize('create', Note::class);

        $inputs = [
            'referable_type' => User::class,
            'referable_id' => $user->id,
            'content' => $request->content,
            'author_id' => auth()->id(),
        ];
        $note = Note::create($inputs);

        return (new NoteResource($note))->response();
    }

    public function ticket(Ticket $ticket, Request $request)
    {
        $inputs = [
            'referable_type' => Ticket::class,
            'referable_id' => $ticket->id,
            'content' => $request->content,
            'author_id' => auth()->id(),
        ];
        $note = Note::create($inputs);

        return (new NoteResource($note))->response();
    }
}
