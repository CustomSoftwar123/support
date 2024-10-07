<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;

class CheckTickets extends Command
{
    protected $signature = 'tickets:check';
    protected $description = 'Check completed tickets and send emails or update status based on completion date';

    public function handle()
    {
        $now = Carbon::now();

        // Get tickets that are 'Completed' and 15, 30, or 45 days old
        $ticketsToNotify = DB::table('tickets')
        ->where('status', 'Completed')
         ->whereIn(DB::raw("DATEDIFF(CURDATE(), DATE(completedat))"), [15, 30, 45])
        ->get();

        foreach ($ticketsToNotify as $ticket) {

            $this->sendNotificationEmail($ticket);
            $this->info("Processing ticket for notification:");
    $this->info("Ticket ID: {$ticket->id}");
    $this->info("Subject: {$ticket->subject}");
    $this->info("User: {$ticket->username}");
    $this->info("Completed At: {$ticket->completedat}");

        }

        // Get tickets that are 'Completed' and 60 days old and update status to 'Closed'
        // $ticketsToClose = Ticket::where('status', 'Completed')
        //                         ->where(DB::raw("DATEDIFF(?, completedat)"), '=', 60)
        //                         ->update(['status' => 'Closed']);

        $this->info('Completed tickets have been processed.');
    }

    private function sendNotificationEmail($ticket)
    {
        $username= DB ::table ('users')->where('email',$ticket->username)->first();
        $data = [
            'ticket_id' => $ticket->ticketid,
            'subject' => $ticket->subject,
            'username'=>$username->name
        ];

        Mail::send('emails.ticket_notification', $data, function ($message) use ($ticket) {
            $message->to($ticket->username);
            $message->subject('Reminder: Please close your ticket');
        });

        $this->info('Notification sent to ' . $ticket->username);
    }
}
