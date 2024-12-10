<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Foydalanuvchilar ro‘yxatini ko‘rish uchun ruxsat
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin'); // Admin roli bo‘lgan foydalanuvchi ko‘rishi mumkin
    }

    /**
     * Foydalanuvchini o‘chirish uchun ruxsat
     */
    public function delete(User $user, User $model)
    {
        return $user->hasRole('admin'); // Admin roli bo‘lgan foydalanuvchi o‘chirishi mumkin
    }
}
