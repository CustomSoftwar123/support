<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketNotificationMail;
use DB;

class SendTicketNotifications extends Command
{
    protected $signature = 'send:ticket-notifications';
    protected $description = 'Send ticket notifications';

    public function handle()
    {
        $tickets = DB::table('tickets')
            ->where('created_at', '>=', now()->subDays(90))
            ->whereNotIn('status', ['Completed', 'Closed'])
            ->orderBy('priority', 'asc')
            ->get();

        logger($tickets);

        foreach ($tickets as $ticket) {
            $this->sendNotification($ticket);
        }
    }

    private function sendNotification($ticket)
    {
        // Implement logic to check ticket priority and response/resolution times
        // If criteria met, send email notification to admin
        if ($this->shouldSendNotification($ticket)) {
            $adminEmail = 'admin@example.com'; // Replace with actual admin email
            $emailData = [
                'ticket' => $ticket,
            ];
            // Mail::to($adminEmail)->send(new TicketNotificationMail($emailData));
            $this->info("Email sent for Ticket ID: {$ticket->ticketid}");
        }
    }

    private function shouldSendNotification($ticket)
    {
        $priority = $ticket->priority;

        switch ($priority) {
            case 'Critical':
                logger('in critical case');
                $hasReplyWithinResponseTime = $this->hasReplyWithinTime($ticket, 0); // Immediate response time
                $responseTime = 4; // 4 hours for Critical priority
                $resolutionTime = 12; // 12 hours for Critical priority
                return !$hasReplyWithinResponseTime || $this->isBeyondResponseTime($ticket, $responseTime);

            case 'High':
                logger('in High case');
                $responseTime = 24; // 24 hours for High priority
                $resolutionTime = 7; // 7 days
                return !$this->hasReplyWithinTime($ticket, $responseTime) || $this->isBeyondResponseTime($ticket, $responseTime) || $this->isBeyondResolutionTime($ticket, $resolutionTime);

            case 'Medium':
                logger('in Medium case');
                $responseTime = 48; // 48 hours for Medium priority
                $resolutionTime = 10; // 10 days
                return !$this->hasReplyWithinTime($ticket, $responseTime) || $this->isBeyondResponseTime($ticket, $responseTime) || $this->isBeyondResolutionTime($ticket, $resolutionTime);

            case 'Low':
                logger('in Low case');
                $responseTime = 72; // 72 hours for Low priority
                $resolutionTime = 15; // 15 days
                return !$this->hasReplyWithinTime($ticket, $responseTime) || $this->isBeyondResponseTime($ticket, $responseTime) || $this->isBeyondResolutionTime($ticket, $resolutionTime);

            default:
                return false;
        }
    }

    private function hasReplyWithinTime($ticket, $responseTime)
    {
        $lastReply = DB::table('ticketmessages')
            ->where('ticketid', $ticket->ticketid)
            ->where('username', '<>', $ticket->username)
            ->where('created_at', '>=', now()->subHours($responseTime))
            ->count();

        return $lastReply > 0;
    }

    private function isBeyondResponseTime($ticket, $responseTime)
    {
        logger('inside isBeyondResponseTime function ' . $ticket->ticketid . ' ' . $responseTime . ' priority ' . $ticket->priority);
        $ticketCreatedAt = now()->parse($ticket->created_at);
        $ticketCreatedAtPlusResponseTime = $ticketCreatedAt->addHours($responseTime);

        return now()->gt($ticketCreatedAtPlusResponseTime);
    }

    private function isBeyondResolutionTime($ticket, $resolutionTime)
    {
        return now()->diffInDays($ticket->created_at) > $resolutionTime;
    }
}
