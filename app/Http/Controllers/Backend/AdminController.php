<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;

class AdminController
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function dashboard()
    {
        $users = User::all();
        return view('backend.dashboard');
    }
}
