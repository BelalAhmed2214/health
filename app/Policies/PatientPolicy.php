<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;

class PatientPolicy
{
    /**
     * Super admin can do anything.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return null; // fall through to individual methods
    }

    /**
     * Index / listing is handled via query scoping in PatientService.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSectionUser();
    }

    /**
     * Section user can only view patients belonging to their section.
     */
    public function view(User $user, Patient $patient): bool
    {
        return $user->section?->value === $patient->section?->value;
    }

    /**
     * Section user can create patients (section will be forced in service layer).
     */
    public function create(User $user): bool
    {
        return $user->isSectionUser();
    }

    /**
     * Section user can only edit patients in their section.
     */
    public function update(User $user, Patient $patient): bool
    {
        return $user->section?->value === $patient->section?->value;
    }

    /**
     * Only super admin can delete (handled via before()).
     */
    public function delete(User $user, Patient $patient): bool
    {
        return false;
    }
}
