<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->id === auth()->check()->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): Response
    {
        return ($user->id === $ticket->created_by || $user->isAdmin() || $user->id === $ticket->assigned_to)
            ? Response::allow()
            : Response::deny('You do not own this Ticket.')
        ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->id === $ticket->created_by) return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        if($user->role === 'admin') return true;

        if($user->role === 'user' 
        && $ticket->status === 'pending'
        && !$ticket->assigned_to 
        && $ticket->created_by === $user->id) return true;

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        return $user->id === auth()->check()->isAdmin();
    }
}
