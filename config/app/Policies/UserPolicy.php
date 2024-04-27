<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function __construct()
    {
        //
    }

    public function viewMenuItems(User $user)
    {
        // Aquí puedes definir tus lógicas de autorización
        // por ejemplo, si el usuario tiene un rol específico
        return $user->hasRole('admin');
    }
}
