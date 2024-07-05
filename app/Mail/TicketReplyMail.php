<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reply,$ticketNumber,$repliedBy,$subject)
    {
        $this->reply = $reply;
        $this->ticketNumber = $ticketNumber;
        $this->repliedBy = $repliedBy;
        $this->ticketSubject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Critical Ticket')
                    ->view('emails.ticket_reply')
                    ->with([
                        'ticketNumber' => $this->ticketNumber,
                        'reply' => $this->reply,
                        'repliedBy' => $this->repliedBy,
                        'subject' => $this->ticketSubject,
                    ]);
                    ;
    }
}
?>