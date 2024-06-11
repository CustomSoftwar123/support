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

        // Fetch expired tickets
        $expiredTickets = DB::table('tickets')
                            ->where('response_expiry', '<', $now)
                            ->get();

        // Collect ticket IDs
        $ticketIds = $expiredTickets->pluck('ticketid')->toArray();

        // Send email with ticket IDs
        if (!empty($ticketIds)) {
            $this->line('Found ' . count($ticketIds) . ' expired tickets: ' . implode(', ', $ticketIds));

            $data = ['ticketIds' => $ticketIds];
            Mail::send('emails.ticket-expiry', $data, function ($message) use ($ticketIds) {
                $message->to('customsoftware2022@gmail.com');
                $message->subject('Response Time Expired for Tickets: ' . implode(', ', $ticketIds));
            });
        } else {
            $this->line('No expired tickets found.');
        }
    }
}
