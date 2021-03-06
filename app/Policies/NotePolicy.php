<?php

namespace App\Policies;

use App\Note;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any notes.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->type === 'support_member';
    }

    /**
     * Determine whether the user can view the note.
     *
     * @param \App\User $user
     * @param \App\Note $note
     *
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        return $user->type === 'support_member';
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSupportMember();
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param \App\User $user
     * @param \App\Note $note
     *
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param \App\User $user
     * @param \App\Note $note
     *
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can restore the note.
     *
     * @param \App\User $user
     * @param \App\Note $note
     *
     * @return mixed
     */
    public function restore(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the note.
     *
     * @param \App\User $user
     * @param \App\Note $note
     *
     * @return mixed
     */
    public function forceDelete(User $user, Note $note)
    {
        //
    }
}
