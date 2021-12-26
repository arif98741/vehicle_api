<?php

namespace App\Jobs;

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
     * @throws MailExcetion
     */
    public function handle()
    {
        $mailClass = "\App\Mail\\" . $this->mailData['mailclass'];
        if (!class_exists($mailClass))
            throw new MailExcetion('Mailclass ' . $this->mailData['mailclass'] . ' does not exist inside App/Mail directory');

        $email = new $mailClass($this->mailData);
        Mail::to($this->mailData['email'])->send($email);
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

        if (!array_key_exists('mailclass', $this->mailData)) {
            throw new MailExcetion('mailclass argument is absent in configuration');
        }


    }
}
