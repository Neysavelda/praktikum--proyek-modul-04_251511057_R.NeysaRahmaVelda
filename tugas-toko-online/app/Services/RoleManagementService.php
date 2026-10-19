<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class RoleManagementService
{
    public function changeRole(User $actor, User $target, string $newRole): void
    {
        // BR-04: tidak boleh mengubah diri sendiri atau akun admin
        if ($actor->is($target) || $target->role === 'admin') {
            throw ValidationException::withMessages([
                'role' => 'Akun admin tidak dapat diubah di fitur ini.',
            ]);
        }

        // BR-05: role sama, tidak ada save sehingga Observer tidak jalan
        if ($target->role === $newRole) {
            return;
        }

        $target->role = $newRole;
        $target->save();
    }
}