<?php

namespace App\Policies;

use App\Models\ConductRecord;
use App\Models\User;

class ConductRecordPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'teacher']);
    }

    public function view(User $user, ConductRecord $record): bool
    {
        return $user->hasAnyRole(['admin', 'teacher']) 
            || ($user->hasRole('parent') && $user->isParentOf($record->student))
            || ($user->hasRole('student') && $user->id === $record->student->user_id);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'teacher']);
    }

    public function update(User $user, ConductRecord $record): bool
    {
        return $user->hasRole('admin') 
            || ($user->hasRole('teacher') && $user->id === $record->recorded_by);
    }

    public function delete(User $user, ConductRecord $record): bool
    {
        return $user->hasRole('admin');
    }
}