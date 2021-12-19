<?php
/*
 * Copyright (c) 2021.
 * This file is originally created and maintained by Ariful Islam.
 * You are not allowed to modify any parts of this code or copy or even redistribute
 * full or small portion to anywhere. If you have any question
 * fee free to ask me at arif98741@gmail.com.
 * Ariful Islam
 * Software Engineer
 * https://github.com/arif98741
 */

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
