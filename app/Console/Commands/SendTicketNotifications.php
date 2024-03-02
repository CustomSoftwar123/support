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
        $ticketsGrouped = []; 

        $tickets = DB::table('tickets')
            ->where('created_at', '>=', now()->subDays(190))
            ->whereIn('internal', [1, 2])
            ->whereNotIn('status', ['Completed', 'Closed'])
            ->orderBy('priority', 'asc')
            ->get();

        logger($tickets);

        foreach ($tickets as $ticket) {
            if ($this->shouldSendNotification($ticket)) {
                // Calculate response time and resolution time for each ticket
                $responseTime = $this->calculateResponseTime($ticket);
                $resolutionTime = $this->calculateResolutionTime($ticket);
                
                // Group tickets by priority and embed response time and resolution time
                $ticketsGrouped[$ticket->priority][] = [
                    'ticket' => $ticket,
                    'responseTime' => $responseTime,
                    'resolutionTime' => $resolutionTime,
                ];
            }
        }

        if (!empty($ticketsGrouped)) {
            $adminEmail = ['customsoftware2022@gmail.com','aqeel@ocmsoftware.ie'];
            $emailData = [
                'ticketsGrouped' => $ticketsGrouped,
            ];
            // Send a single email including all tickets grouped by priority
            Mail::to($adminEmail)->send(new TicketNotificationMail($emailData));
            $this->info("Email sent for ticket notifications");
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
    private function calculateResponseTime($ticket)
    {
        switch ($ticket->priority) {
            case 'Critical':
                return 4; // 4 hours for Critical priority
            case 'High':
                return 24; // 24 hours for High priority
            case 'Medium':
                return 48; // 48 hours for Medium priority
            case 'Low':
                return 72; // 72 hours for Low priority
            default:
                return 0;
        }
    }

    private function calculateResolutionTime($ticket)
    {
        switch ($ticket->priority) {
            case 'Critical':
                return 12; // 12 hours for Critical priority
            case 'High':
                return 7 * 24; // 7 days for High priority
            case 'Medium':
                return 10 * 24; // 10 days for Medium priority
            case 'Low':
                return 15 * 24; // 15 days for Low priority
            default:
                return 0;
        }
    }
}
