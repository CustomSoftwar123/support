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
            if(count($data)>0){
                $this->line('No expired tickets without processed messages found.');
            }else{
                $this->line('xpired tickets without processed messages found.');
            }

        // If there are any tickets, send the email
        $emails=['customsoftware2022@gmail.com','zain@ocmsoftware.ie'];
        $users=['Custom','zain'];
        $i=0;
        if ($data->isNotEmpty()) { // Replace with your email
            foreach($emails as $email){
                $this->line('No expired tickets without processed messages found.');
            Mail::send('emails.ticket-expiry', ['tickets'=>$data->toArray(),'users'=>$users[$i]], function ($message) use($email)  {
                $message->to($email);
                $message->subject('Resolution time for the following tickets has passed: ' );
            });
            $i++;
        }
        }

        $this->info('Expired tasks email sent successfully.');
    }
}
?>