<?php

namespace App\Jobs;

use App\TakecareException\MailException;
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
     * @throws MailException
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
     * @throws MailException
     */
    public function handle()
    {
        $mailClass = "\App\Mail\\" . $this->mailData['mailclass'];
        if (!class_exists($mailClass))
            throw new MailException('Mailclass ' . $this->mailData['mailclass'] .
                ' does not exist inside App/Mail directory');

        $email = new $mailClass($this->mailData);
        Mail::to($this->mailData['email'])->send($email);
    }

    /**
     * @return void
     * @throws MailException
     */
    private function generateException()
    {
        if (!is_array($this->mailData)) {
            throw new MailException(self::class . ' expects array as argument but given ' . gettype($this->mailData));
        }

        if (!array_key_exists('subject', $this->mailData)) {
            throw new MailException('subject argument is absent in configuration');
        }
        if (!array_key_exists('email', $this->mailData)) {
            throw new MailException('email argument is absent in configuration');
        }
        if (!array_key_exists('body', $this->mailData)) {
            throw new MailException('body argument is absent in configuration');
        }
        if (!array_key_exists('mailclass', $this->mailData)) {
            throw new MailException('mailclass argument is absent in configuration');
        }
    }
}
