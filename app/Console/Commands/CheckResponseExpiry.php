<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckResponseExpiry extends Command
{
    protected $signature = 'tickets:check-response-expiry';
    protected $description = 'Check for expired response times and send notification emails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Step 1: Retrieve expired tickets
        $expiredTickets = DB::table('tickets')
                            ->where('response_expiry', '<', $now)
                            ->get();

        // Step 2: Filter tickets that do not have corresponding entries in ticketmessages table
        $unprocessedTickets = $expiredTickets->filter(function($ticket) {
            $exists = DB::table('ticketmessages')
                        ->where('ticketid', $ticket->ticketid)
                        ->where('username','!=',$ticket->username)
                        ->exists();
            return !$exists;
        });

        foreach($unprocessedTickets as $unprocessedTicket){
           

// Insert query with column names and values
DB::table('daily_reports')->insert([
    'ticket_view_id'=>$unprocessedTicket->id,
    'ticketid' => $unprocessedTicket->ticketid,
    'subject' => $unprocessedTicket->subject,
   
    'assignedto' => $unprocessedTicket->assignedto,
    'createdby' => $unprocessedTicket->username,
    'ticket_created_at' => $unprocessedTicket->created_at,
    'client'=>$unprocessedTicket->ticket_client,
]);


        }
        $threeDaysAgo = Carbon::now()->subDays(3);
        $tickets = DB::table('tickets')
        ->where('created_at', '<', $threeDaysAgo)
        ->where('status', '!=', 'Completed')
        ->where('status', '!=', 'Closed')
        ->get();
        foreach ($tickets as $unprocessedTicket) {
            // Check if the ticket ID already exists in daily_reports table
            $exists = DB::table('daily_reports')
                ->where('ticketid', $unprocessedTicket->ticketid)
                ->exists();
        
            // If the ticket ID does not exist, insert it
            if (!$exists) {
                DB::table('daily_reports')->insert([
                    'ticket_view_id'=>$unprocessedTicket->id,
                    'ticketid' => $unprocessedTicket->ticketid,
                    'subject' => $unprocessedTicket->subject,
                    'assignedto' => $unprocessedTicket->assignedto,
                    'createdby' => $unprocessedTicket->username,
                    'ticket_created_at' => $unprocessedTicket->created_at,
                    'client'=>$unprocessedTicket->ticket_client,
                ]);
            }
        }
        // Step 3: Collect ticket IDs of unprocessed tickets
        $unprocessedTicketIds = $unprocessedTickets->pluck('ticketid')->toArray();

        // Log the full array of unprocessed ticket IDs
        $this->line('Found ' . count($unprocessedTicketIds) . ' expired tickets without processed messages: ' . implode(', ', $unprocessedTicketIds));

        // Send email with ticket IDs
        if (!empty($unprocessedTicketIds)) {
            $data = ['tickets' => $unprocessedTickets];
            Mail::send('emails.ticket-expiry', $data, function ($message) use ($unprocessedTicketIds) {
                $message->to(['customsoftware2022@gmail.com','aqeel@ocmsoftware.ie']);
                $message->subject('Response Time Expired for Tickets: ' . implode(', ', $unprocessedTicketIds));
            });
        } else {
            $this->line('No expired tickets without processed messages found.');
        }
    }
}
