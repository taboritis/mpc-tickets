<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tickets.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the ticket.
     *
     * @param \App\User $user
     * @param \App\Ticket $ticket
     *
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->isAuthor($ticket) || $user->isSupportMember();
    }

    /**
     * Determine whether the user can create tickets.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param \App\User $user
     * @param \App\Ticket $ticket
     *
     * @return bool
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->isAuthor($ticket) || $user->isSupportMember();
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param \App\User $user
     * @param \App\Ticket $ticket
     *
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->email === 'admin@admin.com';
    }

    /**
     * Determine whether the user can restore the ticket.
     *
     * @param \App\User $user
     * @param \App\Ticket $ticket
     *
     * @return mixed
     */
    public function restore(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ticket.
     *
     * @param \App\User $user
     * @param \App\Ticket $ticket
     *
     * @return mixed
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }
}
