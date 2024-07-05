<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClubApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.clubApproval')
                    ->with([
                        'body' => $this->body,
                    ]);
    }
}
