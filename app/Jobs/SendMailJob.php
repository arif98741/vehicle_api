<?php

namespace App\Jobs;

use App\Mail\ConfirmationMail;
use App\TakecareException\MailExcetion;
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
     * @throws MailExcetion
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        $this->generateException();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ConfirmationMail($this->mailData);
        $status = Mail::to($this->mailData['email'])->send($email);
    }

    /**
     * @return void
     * @throws MailExcetion
     */
    private function generateException()
    {
        if (!array_key_exists('subject', $this->mailData)) {
            throw new MailExcetion('subject argument is absent in configuration');
        }
        if (!array_key_exists('email', $this->mailData)) {
            throw new MailExcetion('email argument is absent in configuration');
        }
        if (!array_key_exists('body', $this->mailData)) {
            throw new MailExcetion('body argument is absent in configuration');
        }

    }
}
