<?php

namespace App\Policies;

use App\Models\Business\Task\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskStatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskStatus $taskStatus): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, TaskStatus $taskStatus)
    {
        return $user->id === $taskStatus->user_id;
    }

    public function delete(User $user, TaskStatus $taskStatus)
    {
        return $user->id === $taskStatus->user_id;
    }


    public function restore(User $user, TaskStatus $taskStatus): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TaskStatus $taskStatus): bool
    {
        return false;
    }
}
