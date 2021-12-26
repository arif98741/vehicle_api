<?php

namespace App\Jobs;

use App\Mail\ConfirmationMail;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $mail;
    /**
     * @var
     */
    private $mailData;
    /**
     * @var
     */
    private $header;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ConfirmationMail();
        Mail::to('hello@gmail.com')->send($email);

        /*$beautyMail = app()->make(Beautymail::class);

        $data = [
            'email_body' => $this->mailData['email_body'],
        ];

        $beautyMail->send('mails.welcome', $data, function ($message) {
            $status = $message->to($this->mailData['mail_address'])
                ->subject($this->mailData['subject']);

            if (array_key_exists('attachment',$this->mailData) && $this->mailData['attachment'] != '') {

                $status->attach(url('/' . $this->mailData['attachment']));
            }
        });*/
    }
}
