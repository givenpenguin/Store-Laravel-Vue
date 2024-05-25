<?php

namespace App\Http\Controllers\Auth\Login;

class ShowController
{
    public function __invoke()
    {
        return view('auth.login');
    }
}
