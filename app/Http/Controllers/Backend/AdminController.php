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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {

        $emailData = [
            'subject' => 'Test Subject',
            'mail_address' => 'arif@gmail.com',
            'email_body' => 'This is emails body',
            //  'attachment' => 'fileName',
        ];

        $header = '';
        ///  $this->dispatch(new SendMailJob($header, $emailData));
        //$this->dispatch(new ConfirmationMail($emailData));
        //Mail::to('your_receiver_email@gmail.com')->send(new ConfirmationMail($emailData));
        $this->dispatch(new SendMailJob($emailData));


        $users = User::all();
        return view('backend.dashboard');
    }
}
