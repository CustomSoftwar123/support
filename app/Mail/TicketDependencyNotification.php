<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketDependencyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $dependencies;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $dependencies)
    {
        $this->ticket = $ticket;
        $this->dependencies = $dependencies;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ticket Dependency Notification')
                    ->view('emails.ticket_dependency_notification');
    }
}
