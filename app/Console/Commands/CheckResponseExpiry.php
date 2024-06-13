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

        // Step 3: Collect ticket IDs of unprocessed tickets
        $unprocessedTicketIds = $unprocessedTickets->pluck('ticketid')->toArray();

        // Log the full array of unprocessed ticket IDs
        $this->line('Found ' . count($unprocessedTicketIds) . ' expired tickets without processed messages: ' . implode(', ', $unprocessedTicketIds));

        // Send email with ticket IDs
        if (!empty($unprocessedTicketIds)) {
            $data = ['ticketIds' => $unprocessedTicketIds];
            Mail::send('emails.ticket-expiry', $data, function ($message) use ($unprocessedTicketIds) {
                $message->to(['customsoftware2022@gmail.com']);
                $message->subject('Response Time Expired for Tickets: ' . implode(', ', $unprocessedTicketIds));
            });
        } else {
            $this->line('No expired tickets without processed messages found.');
        }
    }
}
