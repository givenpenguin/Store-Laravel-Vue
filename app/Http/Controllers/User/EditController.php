<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class EditController extends Controller
{
    public function __invoke(User $user)
    {
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }
}
