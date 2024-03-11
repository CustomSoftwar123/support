<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectAssigned extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
{
    $this->emailData = $emailData;
    // $this->esubject = $esubject;
}


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->emailData;
        return $this->view('projectmail')->with($this->emailData)->subject($this->emailData['esubject']);
    }
    
    
}
