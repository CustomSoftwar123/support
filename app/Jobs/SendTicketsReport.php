<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TicketReportMail;
use Mail;
use DB;

class SendTicketsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requestData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($requestData)
    {
        //
        $this->requestData = $requestData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger('Job started processing.');
        $toDate = $this->requestData['toDate'];
        $tillDate = $this->requestData['tillDate'];
        $emailSubject = $this->requestData['emailSubject'];
        $messageText = $this->requestData['messageText'];
        $distinctClients = DB::table('tickets')
            ->select('created_for')
            ->whereBetween('created_at', [$toDate, $tillDate])
            ->distinct()
            ->pluck('created_for');
        logger('distinct clients' . $distinctClients);

        $adminEmails = DB::table('users')->select('email', 'client')
            ->whereIn('client', $distinctClients)
            ->where('role', 4)
            ->get();
        logger('client admins email' . $adminEmails);

        $ticketCounts = DB::table('tickets')
            ->select('created_for', 'status', DB::raw('COUNT(*) as count'))
            ->whereIn('created_for', $distinctClients)
            ->whereBetween('created_at', [$toDate, $tillDate])
            ->groupBy('created_for', 'status')
            ->get();
        foreach ($adminEmails as $admin) {
            $client = $admin->client;
            $email = $admin->email;

            // Filter the counts for the current client
            $countsForClient = $ticketCounts->where('created_for', $client);
            //Todo send emails
            // Perform your email sending logic here using $email, $countsForClient, $emailSubject, $messageText, etc.
            // You may use a mailer or any other email sending method of your choice
            $emailData = [
                'client' => $client,
                'countsForClient' => $countsForClient,
                'emailSubject' => $emailSubject,
                'toDate' => $toDate,
                'tillDate' => $tillDate,
                'messageText' => $messageText,
            ];
            logger('Email should send to .' . $email);
//todo comment below line
            $email = 'customsoftware2022@gmail.com';
            Mail::to($email)->send(new TicketReportMail($emailData));

            logger('Email sent to .' . $email);

        }


        logger('Tickets Count' . $ticketCounts);

        logger('Job completed successfully.');
        //todo: Retrieve data and send email logic here
    }
}
