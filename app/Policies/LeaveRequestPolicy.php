<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Auth\Access\Response;


class LeaveRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveRequest $leaveRequest)
    {

        return ($leaveRequest->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403, "you can only access your requests");
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
    public function update(User $user, LeaveRequest $leaveRequest)
    {
        return $leaveRequest->user_id === $user->id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeaveRequest $leaveRequest)
    {
        return  $leaveRequest->user_id === $user->id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveRequest $leaveRequest)
    {
        return  $leaveRequest->user_id === $user->id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
    public function reviewRequest(User $user, LeaveRequest $leaveRequest): Response
    {
        return $leaveRequest->reviewed_by === $user->id
            ? Response::allow()
            : Response::denyWithStatus(403, 'You are not authorized to review this leave request.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveRequest $leaveRequest)
    {
        return  $leaveRequest->user_id === $user->id
            ? Response::allow()
            : Response::denyWithStatus(403, "You are not authorized to delete Request");
    }
}
