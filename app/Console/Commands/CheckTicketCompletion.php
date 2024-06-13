<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckTicketCompletion extends Command
{
    protected $signature = 'tickets:check-completion';
    protected $description = 'Check tickets older than 3 days and send notification emails if not closed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);

        // Fetch tickets older than 3 days that are not closed
        $tickets = DB::table('tickets')
            ->where('created_at', '<', $threeDaysAgo)
            ->where('status', '!=', 'Completed')
            ->where('status', '!=', 'Closed')
            ->get();

        if ($tickets->isEmpty()) {
            $this->info('No tickets found that are older than 3 days and not closed.');
            return;
        }

        $ticketIds = $tickets->pluck('ticketid')->toArray();

        // Log the ticket IDs for debugging purposes
        $this->line('Found tickets: ' . implode(', ', $ticketIds));

        // Send email notification
        $data = ['tickets' => $tickets];
        Mail::send('emails.ticket-completion', $data, function ($message) {
            $message->to('customsoftware2022@gmail.com');
            $message->subject('Tickets Not Closed');
        });

        $this->info('Notification emails sent for tickets: ' . implode(', ', $ticketIds));
    }
}
