<?php

// app/Mail/OrganizationNotifyMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganizationNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $messageBody;

    public function __construct($subjectLine, $messageBody)
    {
        $this->subjectLine = $subjectLine;
        $this->messageBody = $messageBody;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.organization.simple_notify');
    }
}
