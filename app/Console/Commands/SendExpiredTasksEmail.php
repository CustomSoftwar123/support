<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpiredTasksEmail;

class SendExpiredTasksEmail extends Command
{
    // The name and signature of the console command.
    protected $signature = 'send:expiredtasks';

    // The console command description.
    protected $description = 'Send an email with all tickets where tasks_id is not null and response_expiry is less than today\'s date';

    // Create a new command instance.
    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command.
    public function handle()
    {
        // Get today's date
        $today = now();

        // Query the database for tickets
        $data = DB::table('tickets')
            ->whereNotNull('tasks_id')
            ->where('response_expiry', '<', $today)
            ->where('status', '!=', 'Completed')
        ->where('status', '!=', 'Closed')
            ->get();

        // If there are any tickets, send the email
        if ($data->isNotEmpty()) {
            $email = 'customsoftware2022@gmail.com';  // Replace with your email
            Mail::send('emails.ticket-expiry', ['tickets'=>$data->toArray()], function ($message)  {
                $message->to(['customsoftware2022@gmail.com']);
                $message->subject('Resolution time for the following tickets has passed: ' );
            });
        }

        $this->info('Expired tasks email sent successfully.');
    }
}
?>