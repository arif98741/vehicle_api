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

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Models\User;
use App\TakecareException\MailExcetion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     * @throws MailExcetion
     */
    public function dashboard()
    {
        $emailData = [
            'subject' => 'Test Subject ' . rand(1100, 9850),
            'email' => 'arif@gmail.com',
            'body' => 'This is emails body',
            'mailclass' => 'ConfirmationMail',
            //  'attachment' => 'fileName',
        ];

        $this->dispatch(new SendMailJob($emailData));
        $users = User::all();
        return view('backend.dashboard');
    }
}
