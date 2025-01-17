<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\Timeline;
use App\Models\User;
use App\Models\ticketattachment;
use App\Models\tickettimeline;
use App\Models\ticketmessages;
use App\Models\projectpermission;
use App\Models\task;
use DB;
use App\Mail\SignUp;
use App\Mail\TicketReplyMail;
use App\Mail\TicketDependencyNotification;
use App\Mail\ProjectAssigned;
use Mail;
use App\Jobs\SendTicketsReport;
// use Illuminate\Support\Facades\Mail;
use App;
use Route;
use Carbon\Carbon;
use DataTables;
use DateTime;
use Artisan;
use Auth;
use App\Jobs\SendProjectAssignedEmail;
class tickets extends Controller
{


    public function uploadFiles(Request $request)
    {
        // return $request ;
// $destinationPath = '/home/ocmsoftware/public_html/support/public/images';
        if ($request->hasfile('files')) {

            // return $request;
            foreach ($request->file('files') as $file) {

                $name = $file->getClientOriginalName();
                $destinationPath = public_path('images/');
                // $destinationPath = '/Applications/XAMPP/xamppfiles/htdocs/ocm/storage/app/images/';
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;
                $file->move($destinationPath, $filename);

                if ($request->mid != '') {


                    DB::insert(
                        'insert into ticketattachments (ticketid, filename,  datetime, mid) values (?, ?, ?, ?)',
                        [$request->tid, $filename, date('Y-m-d H:i:s'), $request->mid]
                    );

                } else {


                    DB::insert(
                        'insert into ticketattachments (ticketid, filename,  datetime) values (?, ?, ?)',
                        [$request->tid, $filename, date('Y-m-d H:i:s')]
                    );

                }


            }

            return response()->json([
                'success' => 'File uploaded.',
                'filename' => $filename

            ]);
        }


    }
    public function deleteattachment(Request $request)
    {
        // return $request;
        DB::table('ticketattachments')->where('ticketid', $request->tid)->where('filename', $request->filename)->delete();

    }

    public function Ticket(Request $request)
    {

        $patients = array();


        if ($request->id != '') {

            $id = $request->id;
            $ticketinfo = ticket::find($id);
            $ticketattachments = ticketattachment::find($id);

            $data = [
                'ticketinfo' => $ticketinfo,
                'ticketattachments' => $ticketattachments,
                'patients' => $patients

            ];

        } else {
            $client = DB::table("users")->select('client')->groupBy('client')->get();
             $dep = DB::table("tickets_departments")->pluck('name');



            $data = [
                'ticketinfo' => '',
                'ticketattachments' => '',
                'patients' => $patients,
                'client' => $client,
                'dep' => $dep


            ];


        }

        return view('ticket')->with('data', $data);


    }




    public function TicketView(Request $request)
    {

        // $ticketinfo=DB::table('tickets')->where('id','<',12410)->delete(); 
        $patients = array();

        $id = $request->id;
        $ticketinfo = DB::table('tickets')->where('id', $id)->get();
        $dep = DB::table("tickets_departments")->pluck('name');
        // $ticketD = DB::table('tickets_departments')->get();


        $userclient = DB::table('users')->where('email', $ticketinfo[0]->username)->get();
        // count($use)

        $var = '';
        $c = Auth()->user()->client;
        if (!empty($userclient) && count($userclient)) {
            if ($c == 'NULL' || $c == '') {
                $c = $userclient[0]->client;
                //   return $c;

                $var = $userclient[0]->client;

            }
        } else {

        }

        //   if($c!=$var){
//      return redirect('home');
//   } else {
// return $request;
$timelineInstance = new Timeline();
$ticketattachments=DB::table('ticketattachments')->where('mid', null)->where('ticketid',$ticketinfo[0]->ticketid)->get(); 
 $ticketTimeline=$timelineInstance->getTimeline($ticketinfo[0]->ticketid)->get();
// return $user=auth()->user();

        $ticketmessages = DB::table('ticketmessages')
            ->select('*')
            ->where('ticketmessages.ticketid', $ticketinfo[0]->ticketid)
            ->orderBy('created_at', 'asc')
            ->get();
        //  $ticketinfo=DB::table('tickets')->where('id',$id)->get(); 

        // $maxid=DB::table('timeline')->where('ticketid','=',$ticketinfo[0]->ticketid)->max('id');

        //  $status=DB::table('timeline')->select('status')->where('id','=',$maxid)->get(); 

        $versions=DB::table('version_control')->pluck('application');

        $ticketinfo[0]->exesentdate = Carbon::parse($ticketinfo[0]->exesentdate)->format('Y-m-d');
        $projects = DB::table('tasks')->select('subject','id')->where('id','>',14)->get();
        $internal = DB::table('tickets')->where('id', $id)->pluck('internal');

        $task_tickets = DB::table('tickets')->select('subject','id')
        ->where('tasks_id','=',$ticketinfo[0]->tasks_id)
        ->where('id','!=',$ticketinfo[0]->id)
        ->where('status','!=','Closed')
        ->where('status','!=','Completed')
        ->get();


        $data22 = [


'ticketinfo' => $ticketinfo,
'ticketattachments' => $ticketattachments,
'ticketmessages' => $ticketmessages,
'patients' => $patients,
'internal'=>$internal,
'ticketTimeline'=>$ticketTimeline,
'projects'=>$projects,
'task_tickets'=>$task_tickets,
'versions'=>$versions,
'departments'=>$dep


        ];

        // return $data22['ticketinfo'][0]->patientname;


        return view('ticketview')->with('data22', $data22);

        // }
    }


    public static function getTicketReplyAttachments($mid)
    {



        $mid = DB::table('ticketattachments')->where('mid', $mid)->get();

        return $mid;


    }

    public static function getTaskTitleByID($tid)
    {



        $mid = DB::table('tasks')->where('id', $tid)->first();

        return $mid->subject;


    }

    public function save(Request $request)
    {

$patientname = $request->patientname;
$contact = $request->contact ;
$sampleid = $request->sampleid;
$subject = $request->subject;
$department = $request->department;
$priority = $request->priority;
$message = $request->message;
$tid = $request->tid;
$client=$request->client;
$crReason=$request->criticalriskreason;
// if(!$client){
//     $client=auth()->user()->client;
// // return $client.'sad';

// }

$ticket_client=auth()->user()->client;
if(!$ticket_client){
    $ticket_client=$client;
}
// return $client.'asd';

$taskid=$request->taskId;


        $id = auth()->user()->role;
        $email = auth()->user()->email;
        $date = Carbon::now();


        $validator = $request->validate([
            'subject' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required',
            'contact' => 'required'

        ]);
        // if ($validator->fails())
// {
//     return response()->json(['status'=>0,'errors'=>$validator->errors()[0]]);
// }
// if($priority=='Critical'){
//     $futureDateTime = Carbon::now()->addDay(3);
// }
// else if($priority=='High'){
//     $futureDateTime = Carbon::now()->addDay(7);
// }
// elseif($priority=='Medium'){
//     $futureDateTime = Carbon::now()->addDay(10);
// }
// elseif($priority=='Low'){
//     $futureDateTime = Carbon::now()->addDay(15);
// }

if($taskid){
DB::insert('insert into tickets (patientname, username, contact,sampleid,subject,department,priority,message,created_at,created_by,ticketid,status,mailed,created_for,tasks_id,ticket_client,critical_risk_reason) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$patientname,$email,$contact,$sampleid,$subject,$department,$priority,$message,$date,$id,$tid,'Opened',0,$client,$taskid,$ticket_client,$crReason]);
}else{
	
DB::insert('insert into tickets (patientname, username, contact,sampleid,subject,department,priority,message,created_at,created_by,ticketid,status,mailed,created_for,ticket_client,critical_risk_reason) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$patientname,$email,$contact,$sampleid,$subject,$department,$priority,$message,$date,$id,$tid,'Opened',0,$client,$ticket_client,$crReason]);
}
return response()->json(['status','true',$tid]);

    }
    public function commands()
    {
        /* php artisan config:clear */
        // Artisan::call(cache:clear);
        shell_exec("composer dump-autoload");

        dd('Configuration cache cleared!');
    }

    public function updateTicketInfo(Request $request)
    {


        // return $request;
        $patientname = $request->patientname;
        $contact = $request->contact;
        $sampleid = $request->sampleid;
        $subject = $request->subject;
        $department = $request->department;
        $priority = $request->priority;
        $message = $request->message;
        $tid = $request->tid;
        $mid = $request->mid;
         $resExpiry = $request->resExpiry;

        $user = auth()->user()->id;
        $email = auth()->user()->email;
        $date = Carbon::now();

// $resExpiry =$resExpiry??null;
$resExpiry = !empty($resExpiry) ? $resExpiry : null;
        $validator = $request->validate([
            'tid' => 'required',
            'mid' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required'


        ]);
        // if ($validator->passes())
// {
//     return response()->json(['status'=>0,'errors'=>$validator->errors()->first()]);
// }

        $timelineCheck = DB::table('tickets')->where('ticketid', $request->tid)->get();
        // return $timelineCheck[0]->response_expiry .' ss'. $resExpiry;

        DB::insert(
            'insert into ticketmessages (ticketid, mid, username, message, user, created_at, created_by) values (?, ?, ?, ?, ?, ?, ?)',
            [$request->tid, $request->mid, $email, $message, 'client', date('Y-m-d H:i:s'), $user]
        );
        if($resExpiry){
        DB::update("update tickets  set priority = '$priority',response_expiry='$resExpiry'  where ticketid = '" . $tid . "'");
        }
        else{
            DB::update("update tickets  set priority = '$priority'  where ticketid = '" . $tid . "'");  
        }
        // DB::table('tickets')
// ->where('ticketid', $request->tid)
// ->update(['priority' => $priority]);

        $status = DB::table('tickets')->select('status')->where('ticketid', $request->tid)->first();
        if ($status->status == "Completed") {
            DB::update("update tickets  set status = 'Processing' where ticketid = '" . $request->tid . "'");
            
            self::tickettimeline($request->tid,"Ticket Opened back by $email ",$email,"","","","Processing");

            // self::tickettimeline($tid,"Ticket Completed",$useremail,$assignedto,"",$name,"Completed");


        }
        $loggedInUser=auth()->user()->name;

        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        $existingTimeline=$timelineCheck[0]->response_expiry;

        if($tid[0]->tasks_id){
        if(!$timelineCheck[0]->response_expiry && $resExpiry){

            DB::insert( 'insert into timeline_audit (ticketid, activity, tasks_id) values (?, ?, ?)',
            [$tid[0]->ticketid, "Ticket timeline set to $resExpiry by $loggedInUser",$tid[0]?->tasks_id ]
        );
        }else{
            $dateTime = new DateTime($existingTimeline);

// Format to only show the date (YYYY-MM-DD)
$formattedDate = $dateTime->format('Y-m-d');
            // return 1;
            if($existingTimeline!=$resExpiry){
            DB::insert( 'insert into timeline_audit (ticketid, activity, tasks_id) values (?, ?, ?)',
            [$tid[0]->ticketid, "Ticket timeline changed from $formattedDate to $resExpiry by $loggedInUser",$tid[0]?->tasks_id ]
        );
    }
        }
    }
        return $tid[0]->id;




    }
    public function sendTicketToNET(Request $request)
    {

        // return $request;

        $patientname = $request->patientname;
        $requestid = $request->requestid;
        $sampleid = $request->sampleid;
        $subject = $request->subject;
        $department = $request->department;
        $priority = $request->priority;
        $message = $request->message;
        $tid = $request->tid;
        $mid = $request->mid;

        $user = auth()->user()->id;
        $email = auth()->user()->email;
        $date = Carbon::now();


        $validated = $request->validate([
            'tid' => 'required',
            'mid' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required'


        ]);
        $loggedin = auth()->user()->role;

        DB::insert(
            'insert into ticketmessages (ticketid, mid, username, message, user, created_at, created_by) values (?, ?, ?, ?, ?, ?, ?)',
            [$request->tid, $request->mid, $email, $message, 'client', date('Y-m-d H:i:s'), $user]
        );
        DB::update("update tickets  set priority = '$priority'  where ticketid = '" . $tid . "'");

        if ($loggedin >= 4) {

            DB::update("update tickets  set status = 'Opened', internal = 2  where ticketid = '" . $request->tid . "'");

        } else {

            DB::update("update tickets  set status = 'Processing', internal = 2  where ticketid = '" . $request->tid . "'");

        }


        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        return $tid[0]->id;
    }
    public function searches()
    {
        $search_text = $_POST['tid'];
        if ($search_text != "") {
            $products = ticket::whereticketid($search_text)->get();
            return view('searche', compact('products'));
        } else {
            return ("Not found");
        }
        //     public function data(){
//         $search_text = $_GET['search'];
//        if($search_text!=""){
//         $products = Apps::where('name','LIKE','%'.$search_text.'%')->get();
//         return view('data',compact('products'));
//     }

        // }
    }

    public function sendTicketToOCM(Request $request)
    {



        $patientname = $request->patientname;
        $requestid = $request->requestid;
        $sampleid = $request->sampleid;
        $subject = $request->subject;
        $department = $request->department;
        $priority = $request->priority;
        $message = $request->message;
        $tid = $request->tid;
        $mid = $request->mid;

        $user = auth()->user()->id;
        $email = auth()->user()->email;
        $date = Carbon::now();


        $validated = $request->validate([
            'tid' => 'required',
            'mid' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required'


        ]);

        DB::insert(
            'insert into ticketmessages (ticketid, mid, username, message, user, created_at, created_by) values (?, ?, ?, ?, ?, ?, ?)',
            [$request->tid, $request->mid, $email, $message, 'client', date('Y-m-d H:i:s'), $user]
        );
        DB::update("update tickets  set priority = '$priority'  where ticketid = '" . $tid . "'");
        if (auth()->user()->role >= 4) {

            DB::update("update tickets  set status = 'Opened', internal = 1  where ticketid = '" . $request->tid . "'");

        } else {

            DB::update("update tickets  set status = 'Processing', internal = 1  where ticketid = '" . $request->tid . "'");

        }


        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        return $tid[0]->id;




    }

    public function StartTicket(Request $request)
    {
        // return $request->tid;

        DB::insert(
            'insert into timeline (ticketid, time1) values (?, ?)',
            [$request->tid, date('Y-m-d H:i:s')]
        );

        DB::update("Update tickets set status2='Start' where ticketid= '" . $request->tid . "' ");

        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        return $tid[0]->id;


    }
    public function PauseTicket(Request $request)
    {
        $time = date('Y-m-d H:i:s');
        $id = DB::table('timeline')->where('ticketid', '=', $request->tid)->max('id');
        DB::update("update  timeline set time2 ='$time' where ticketid = '" . $request->tid . "' AND  id= '$id'");
        DB::update("Update tickets set status2='Pause' where ticketid= '" . $request->tid . "' ");

        $s = DB::table('timeline')->select('time1')->where('id', '=', $id)->get();

        $t = $s[0]->time1;
        $timeFirst = strtotime($t);
        $timeSecond = strtotime($time);
        $diff = ($timeSecond - $timeFirst);

        // return $diff;
        DB::update("update  timeline set totaltime ='$diff' where ticketid = '" . $request->tid . "' AND  id= '$id'");

        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        return $tid[0]->id;



    }

    public function CompleteTicket(Request $request)
    {
        


        $patientname = $request->patientname;
        $requestid = $request->requestid;
        $sampleid = $request->sampleid;
        $subject = $request->subject;
        $department = $request->department;
        $priority = $request->priority;
        $message = $request->message;
        $tid = $request->tid;
        $mid = $request->mid;
        $changes = $request->changes;
        $esdate = $request->esdate;
        $ver = $request->ver;
        $proj=$request->project;

        $user = auth()->user()->id;
        $email = auth()->user()->email;
        $date = Carbon::now()->format('Y-m-d H:i:s');


        $validated = $request->validate([
            'tid' => 'required',
            'mid' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required'


        ]);
        
        $useremail = Auth::user()->email;
        $name = Auth::user()->name;

        $getticketinfo = DB::table('tickets')->where('ticketid',$tid)->first();
        $assignedto = $getticketinfo->assignedto;
        $status = $getticketinfo->status;
        

         self::tickettimeline($tid,"Ticket Completed",$useremail,$assignedto,"",$name,"Completed");

        $status = DB::table('tickets')->where('ticketid', $request->tid)->first();
        if ($status->status2 == 'Start') {

            $tim = date('Y-m-d H:i:s');
            $id = DB::table('timeline')->where('ticketid', '=', $request->tid)->max('id');
            DB::update("update  timeline set time2 ='$tim' where ticketid = '" . $request->tid . "' AND  id= '$id'");
            DB::update("Update tickets set status2='Pause' where ticketid= '" . $request->tid . "' ");

            $s = DB::table('timeline')->select('time1')->where('id', '=', $id)->get();

            $t = $s[0]->time1;
            $timeFirst = strtotime($t);
            $timeSecond = strtotime($tim);
            $diff = ($timeSecond - $timeFirst);

            // return $diff;
            DB::update("update  timeline set totaltime ='$diff' where ticketid = '" . $request->tid . "' AND  id= '$id'");
        }
        $time = DB::table('timeline')->select('totaltime')->where('ticketid', $request->tid)->sum('totaltime');


        function secondsToTime($seconds)
        {
            $dtF = new \DateTime('@0');
            $dtT = new \DateTime("@$seconds");
            return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
        }
        $ab = secondsToTime($time);
        if ($ab[0] == '0') {

            $ab = str_replace('0 days, ', '', $ab);

        }

        if ($ab[0] == '0') {

            $ab = str_replace('0 hours, ', '', $ab);

        }
        if ($ab[0] == '0') {

            $ab = str_replace('0 minutes and ', '', $ab);

        }

        DB::insert(
            'insert into ticketmessages (ticketid, username, mid, message, user, created_at, created_by,changes) values (?, ?, ?, ?, ?, ?, ?,?)',
            [$request->tid, $email, $request->mid, $message, 'client', date('Y-m-d H:i:s'), $user,$changes]
        );


        // DB::update("update tickets  set status = 'Completed',  timetaken='" . $ab . "',changes='".$changes."' ,version='".$ver."',exesentdate='".$esdate."' where ticketid = '" . $request->tid . "'");
        DB::update(
            "UPDATE tickets 
             SET status = ?, timetaken = ?, changes = ?, version = ?, exesentdate = ? ,project=?
             WHERE ticketid = ?", 
            [
                'Completed',
                $ab,
                $changes,
                $ver,
                $esdate,
                $proj,
                $request->tid
            ]
        );
        DB::update("update tickets  set priority = '$priority'  where ticketid = '" . $tid . "'");
        DB::update("update tickets  set completedat ='$date' where ticketid = '" . $request->tid . "'");
        if($proj&&$ver){
            $curver = DB::table('version_control')->where('application', $proj)->pluck('currentversion');
            $verrr=$curver[0];
        DB::update("update version_control  set newversion ='$ver' where application = '" . $proj . "'");
        DB::update("update tickets  set current_version = '$verrr' where ticketid = '" . $request->tid . "'");

        }    
        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        if($tid[0]?->agenda==1 && $tid[0]?->agenda_done!=1){
            DB::update("update tickets  set agenda_done=1 where ticketid = '" . $request->tid . "'");
        }
        return $tid[0]->id;




    }

    public function reporte(Request $request)
    {

        if ($request->ajax()) {

            $user = auth()->user()->email;
            $role = auth()->user()->role;
            $client = auth()->user()->client;
            if ($role > 5) {
                // return $user;
//    return $request;


                if ($request->tilldate == "") {
                    $request->tilldate = date('Y-m-d');

                }


                $project = DB::table('tickets')->select(
                    'tickets.*',
                    'users.client as client',
                )

                    ->leftjoin('users', 'tickets.username', "=", 'users.email')
                    ->where('users.client', $client)
                    ->where('tickets.username', '=', $user)
                    ->when($request->todate, function ($query) use ($request) {
                        $todate = $request->todate . " 00:00:00";

                        $tilldate = $request->tilldate . " 23:59:59";

if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                        $query->whereBetween(
                            'tickets.created_at',
                            [$todate, $tilldate]
                        );
                    }
                    else if ($request->status == 'Completed'){
                        // return 1;'sa';
                        $query->whereBetween(
                            'tickets.completedat',
                            [$todate, $tilldate]
                        );
                    }
                    else if ($request->status == 'Closed'){
                        // return 1;'sa';
                        $query->whereBetween(
                            'tickets.closedat',
                            [$todate, $tilldate]
                        );
                    }
                    })


                    ->when($request->status, function ($query) use ($request) {
                        $query->where('tickets.status', '=', $request->status);
                    })
                    ->when($request->assignedby, function ($query) use ($request) {
                        $query->where('tickets.assignedby', '=', $request->assignedby);
                    })
                    ->when($request->client, function ($query) use ($request) {
                        $query->where('tickets.ticket_client', '=', $request->client);
                    })


                    ->when($request->assignedto, function ($query) use ($request) {
                        $query->where('tickets.sassignedto', '=', $request->assignedto);
                    })





                    ->get();
                return Datatables::of($project)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
                ;

            } 
            else if($role==4){
                $cl=auth()->user()->client;
                $project = DB::table('tickets')->select(
                    'tickets.*',
                    'users.client as client',
                )
                    // ->where('client', $client)
                    ->where('users.client',$cl)
                ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                    ->when($request->todate, function ($query) use ($request) {
                        $todate = $request->todate . " 00:00:00";

                        $tilldate = $request->tilldate . " 23:59:59";
                        if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                            $query->whereBetween(
                                'tickets.created_at',
                                [$todate, $tilldate]
                            );
                        }
                        else if ($request->status == 'Completed'){
                            // return 1;'sa';
                            $query->whereBetween(
                                'tickets.completedat',
                                [$todate, $tilldate]
                            );
                        }
                        else if ($request->status == 'Closed'){
                            // return 1;'sa';
                            $query->whereBetween(
                                'tickets.closedat',
                                [$todate, $tilldate]
                            );
                        }

                    })


                    ->when($request->status, function ($query) use ($request) {
                        $query->where('tickets.status', '=', $request->status);
                    })
                    ->when($request->assignedby, function ($query) use ($request) {
                        $query->where('tickets.assignedby', '=', $request->assignedby);
                    })


                    ->when($request->assignedto, function ($query) use ($request) {
                        $query->where('tickets.assignedto', '=', $request->assignedto);
                    })
                    ->when($request->client, function ($query) use ($request) {
                        $query->where('tickets.ticket_client', '=', $request->client);
                    })


                    ->get();
                return Datatables::of($project)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
                ;
            }
            else {
if($role<=3){
    $project = DB::table('tickets')->select(
        'tickets.*',
        DB::raw("CASE WHEN tickets.created_for IS NOT NULL THEN tickets.created_for ELSE users.client END as client")
    )
    ->leftJoin('users', function ($join) {
        $join->on('tickets.username', '=', 'users.email')
            ->whereNull('tickets.created_for');
    })
    ->when($request->todate, function ($query) use ($request) {
        $todate = $request->todate . " 00:00:00";
        $tilldate = $request->tilldate . " 23:59:59";
        
        if(!$request->status || $request->status == 'Opened' || $request->status == 'Processing'){
            $query->whereBetween('tickets.created_at', [$todate, $tilldate]);
        } else if ($request->status == 'Completed') {
            $query->whereBetween('tickets.completedat', [$todate, $tilldate]);
        } else if ($request->status == 'Closed') {
            $query->whereBetween('tickets.closedat', [$todate, $tilldate]);
        }
    })
    ->when($request->status, function ($query) use ($request) {
        $query->where('tickets.status', '=', $request->status);
    })
    ->when($request->assignedby, function ($query) use ($request) {
        $query->where('tickets.assignedby', '=', $request->assignedby);
    })
    ->when($request->assignedto, function ($query) use ($request) {
        $query->where('tickets.assignedto', '=', $request->assignedto);
    })
    ->when($request->client, function ($query) use ($request) {
        $query->where('tickets.ticket_client', '=', $request->client);
    })
    ->where(function ($query) {
        $query->whereIn('internal', [1, 2])
            ->orWhere(function ($query) {
                $query->whereNull('internal')
                    ->whereNotNull('created_for');
            });
    })
    ->get();

}else{

                $project = DB::table('tickets')->select(
                    'tickets.*',
                    'users.client as client',
                )
                    // ->where('client', $client)
                    ->leftjoin('users', 'tickets.username', "=", 'users.email')
                    ->when($request->todate, function ($query) use ($request) {
                        $todate = $request->todate . " 00:00:00";

                        $tilldate = $request->tilldate . " 23:59:59";
                        if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                            $query->whereBetween(
                                'tickets.created_at',
                                [$todate, $tilldate]
                            );
                        }
                        else if ($request->status == 'Completed'){
                            // return 1;'sa';
                            $query->whereBetween(
                                'tickets.completedat',
                                [$todate, $tilldate]
                            );
                        }
                        else if ($request->status == 'Closed'){
                            // return 1;'sa';
                            $query->whereBetween(
                                'tickets.closedat',
                                [$todate, $tilldate]
                            );
                        }

                    })


                    ->when($request->status, function ($query) use ($request) {
                        $query->where('tickets.status', '=', $request->status);
                    })
                    ->when($request->assignedby, function ($query) use ($request) {
                        $query->where('tickets.assignedby', '=', $request->assignedby);
                    })


                    ->when($request->assignedto, function ($query) use ($request) {
                        $query->where('tickets.assignedto', '=', $request->assignedto);
                    })
                    ->when($request->client, function ($query) use ($request) {
                        $query->where('tickets.ticket_client', '=', $request->client);
                    })

                
                    ->get();
                }
                return Datatables::of($project)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
                ;
            }
        }

        $data = DB::table('users')->where('role', '>=', '1')->get();

        // array_unique($data2);
        return view('reports', [

            'data' => $data,

        ]);
    }


    public function sendMail(Request $request)
    {

        if ($request->ajax()) {
            $tid = $request->tid;
            // $raisedby=auth()->user()->name;
// $email=auth()->user()->email;
//  $message=$request->message;
            $completedby = auth()->user()->name;
             $completedmail = auth()->user()->email;

            $status = DB::table('tickets')->where('ticketid', $tid)->pluck('status');
            $email = DB::table('tickets')->where('ticketid', $tid)->pluck('username');
            $raisedby = DB::table('users')->where('email', $email[0])->pluck('name');

            $rclient = DB::table('users')->where('email', $email[0])->pluck('client');


            $q = DB::table('users')->where('role', '4')->where('client', $rclient)
                ->orWhere('client', null)
                ->pluck('email')->toArray();

            $id = DB::table('tickets')->where('ticketid', $tid)->pluck('id');
            if ($status[0] == 'Opened') {


                $esubject = 'New Ticket #' . $tid . ' Opened by ' . $raisedby[0] . ' ( ' . $email[0] . ')';
            } else if ($status[0] == 'Completed' || $status[0] == 'Processing') {
                $esubject = 'Ticket #' . $tid . ' Completed by ' . $completedby . '( ' . $completedmail . ')';


            }
            $messages = DB::table('tickets')->where('ticketid', $tid)->pluck('message');
            $subject = DB::table('tickets')->where('ticketid', $tid)->pluck('subject');


            $data = ['data' => $subject[0], 'name' => $raisedby[0], 'email' => $email[0], 'tid' => $tid, 'esubject' => $esubject, 'messages' => $messages[0], 'status' => $status[0], 'id' => $id[0]];
            if (!empty($request->completionmessage)) {
                $data['resolmsg'] = $request->completionmessage;
            }
            foreach ($q as $admin) {
                $user['to'] = $admin;

                Mail::send('mail', $data, function ($messages) use ($user, $esubject) {
                    $messages->to($user['to']);
                    $messages->subject($esubject);
                });
            }
            DB::update("update tickets  set mailed = 1 where ticketid = '" . $request->tid . "'");
            return 1;

        }


    }

    public static function userRate(Request $request)
    {

        $user = $request->email;
        // DB::

        $allrating = DB::table('tickets')->where('assignedto', $user)->pluck('rating')->toArray();

        $name = DB::table('users')->where('email', $user)->pluck('name');
        $allrating = DB::table('tickets')->where('assignedto', $user)->pluck('rating')->toArray();

        $time = DB::table('tickets')->where('assignedto', $user)->pluck('timetaken')->toArray();
        $role = DB::table('users')->where('email', $user)->pluck('role');
        $text = DB::table('lists')->where('id', $role)->pluck('Text');
        // $name=DB::table('users')->where('email',$user)->pluck('name');
//    return $name;

        $count = count($allrating);
        if ($count == 0) {
            $sum = "N/A";
        } else {
            $sum = array_sum($allrating) / $count;
            $sum = number_format($sum, 2);
        }
        $data = [
            'sum' => $sum,
            'name' => $name,
            'text' => $text,
            'user' => $user
        ];
        return view('rating')->with('data', $data);

    }

    public static function rating()
    {
        $user = auth()->user()->email;
        $allrating = DB::table('tickets')->where('assignedto', $user)->pluck('rating')->toArray();
        $count = count($allrating);
        if ($count == 0) {
            $sum = " N/A";
        } else {
            $sum = array_sum($allrating) / $count;
            $sum = number_format($sum, 2);
        }
        return $sum;
    }
    public function rep(Request $request)
    {

        return view('reports');
    }
    public function CloseTicket(Request $request)
    {
        // return $request;
        $patientname = $request->patientname;
        $requestid = $request->requestid;
        $sampleid = $request->sampleid;
        $subject = $request->subject;
        $department = $request->department;
        $priority = $request->priority;
        $message = $request->message;
        $tid = $request->tid;
        $mid = $request->mid;
        $rating = $request->check;
        $time = $request->time;
        $satisfy = $request->satisfy;
        $comment = $request->comment;
        $user = auth()->user()->id;
        $email = auth()->user()->email;
        $date = Carbon::now()->format('Y-m-d H:i:s');
        //    return $date;

        $validated = $request->validate([
            'tid' => 'required',
            'mid' => 'required',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required'


        ]);

        DB::insert(
            'insert into ticketmessages (ticketid, username, mid, message, user, created_at, created_by) values (?, ?, ?, ?, ?, ?, ?)',
            [$request->tid, $email, $request->mid, $message, 'client', date('Y-m-d H:i:s'), $user]
        );
        DB::update("update tickets  set status = 'Closed' where ticketid = '" . $request->tid . "'");

        DB::update("update tickets  set closedat ='$date' where ticketid = '" . $request->tid . "'");

        $tid = DB::table('tickets')->where('ticketid', $request->tid)->get();
        return $tid[0]->id;




    }


    public function update(Request $req)
    {

        $data = ticket::find($req->id);
        $file = ticket::find($req->id);
        $data->patientname = $req->patientname;
        $data->requestid = $req->requestid;
        $data->sampleid = $req->sampleid;
        $data->subject = $req->subject;
        $data->department = $req->department;
        $data->priority = $req->priority;
        $data->file = $req->file;
        $data->message = $req->message;
        $data->save();

    }
    public function deleteTicket(Request $request)
    {


        DB::table('tickets')->where('ticketid', $request->id)->delete();
        DB::table('ticketattachments')->where('ticketid', $request->id)->delete();


    }

    public function assignTicketNow(Request $request)
    {

        $user = auth()->user()->email;
        $role = auth()->user()->role;

        if ($role >= 4)
            return DB::update("
update tickets  set status = 'Processing',
assignedby='" . $user . "',

assignedto = '" . $request->user . "',
assignedat = '" . date('Y-m-d H:i:s') . "'
where id = '" . $request->tid . "'"
            );
        else if ($role <= 3) {
            return DB::update("
update tickets  set status = 'Processing',
assignedbyocm='" . $user . "',

assignedto = '" . $request->user . "',
assignedat = '" . date('Y-m-d H:i:s') . "'
where id = '" . $request->tid . "'"
            );
        }

    }
    public function Tickettype(Request $request)
    {

    }

    public function tickets(Request $request)
    {

        //     $type=$request->type;
// return $type;
        if ($request->ajax()) {
            $cr = 0;

            $user = auth()->user();
         $r = $user->role;
            $cl = $user->client;


// return type($request->task);

            if ($user->role <= 3) {
                $loggedin = auth()->user()->email;

                $data = DB::table('tickets')
                    ->select(
                        'tickets.*',
                        DB::raw("CASE WHEN created_for IS NOT NULL THEN created_for ELSE users.client END as client")
                    )
                    ->leftJoin('users', function ($join) {
                        $join->on('tickets.username', '=', 'users.email')
                            ->whereNull('tickets.created_for');
                    })
                   
                    ->when(!empty($request->status), function ($query) use ($request) {
                        return $query->where('tickets.status', $request->status);
                    })
                    ->when(!empty($request->ticketid), function ($query) use ($request) {
                        return $query->where('tickets.ticketid', $request->ticketid);
                    })
                    ->when(!empty($request->ticketid), function ($query) use ($request) {

                        return $query->where('tickets.ticketid', $request->ticketid);
                    })
                    ->when(!empty($request->priority), function ($query) use ($request) {
                        if ($request->priority != 'All') {
                            return $query->where('tickets.priority', $request->priority);
                        }
                    })
                    ->when(!empty($request->subject), function ($query) use ($request) {
                        return $query->where('tickets.subject', 'like', '%' . $request->subject . '%');
                    })
                    ->when(!empty($request->fromdate), function ($query) use ($request) {
                        $todate = $request->fromdate . " 00:00:00";

                        $tilldate = $request->todate . " 23:59:59";


                        if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                            $query->whereBetween(
                                'tickets.created_at',
                                [$todate, $tilldate]
                            );
                        }
                        else if ($request->status == 'Completed'){
                            // return 1;'sa';
                            $query->whereBetween(
                                'tickets.completedat',
                                [$todate, $tilldate]
                            );
                        }
                        else if ($request->status == 'Closed'){
                            // return 1;'sa';
                            $query->whereBetween(
                                'tickets.closedat',
                                [$todate, $tilldate]
                            );
                        }

                    })
                    ->when(!empty($request->client), function ($query) use ($request) {
                        return $query->where('ticket_client',  $request->client );
                    })
                    ->when(!empty($request->raisedby), function ($query) use ($request) {
                        return $query->where('username', 'like', '%' . $request->raisedby . '%');
                    })

                    ->when(!empty($request->task), function ($query) use ($request) {

                        return $query->where('tickets.tasks_id', $request->task);

                    });
                    if (empty($request->task)) {
                        $data = $data->where(function ($query) {
                            $query->whereIn('internal', [1, 2])
                                ->orWhere(function ($query) {
                                    $query->whereNull('internal')
                                        ->whereNotNull('created_for');
                                });
                        })->whereNull('tasks_id');
                        
                    }
            } else {

                if($user->role==1387){
                    // return 2;
                    $data = DB::table('tickets')
                        ->select(
                            'tickets.*',
                            'users.client as client'
                        )
                        ->leftjoin('users', 'tickets.username', "=", 'users.email')
                       
                        ->when(!empty($request->status), function ($query) use ($request) {

                            return $query->where('tickets.status', $request->status);

                        })
						->when(!empty($request->task), function ($query) use ($request) {

                            return $query->where('tickets.tasks_id', $request->task);

                        })
                        ->when(!empty($request->ticketid), function ($query) use ($request) {

                            return $query->where('tickets.ticketid', $request->ticketid);
                        })
                        ->when(!empty($request->fromdate), function ($query) use ($request) {
                            $todate = $request->fromdate . " 00:00:00";
    
                            $tilldate = $request->todate . " 23:59:59";
    
                            if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                                $query->whereBetween(
                                    'tickets.created_at',
                                    [$todate, $tilldate]
                                );
                            }
                            else if ($request->status == 'Completed'){
                                // return 1;'sa';
                                $query->whereBetween(
                                    'tickets.completedat',
                                    [$todate, $tilldate]
                                );
                            }
                            else if ($request->status == 'Closed'){
                                // return 1;'sa';
                                $query->whereBetween(
                                    'tickets.closedat',
                                    [$todate, $tilldate]
                                );
                            }
    
                        })
                        ->when(!empty($request->client), function ($query) use ($request) {
                            return $query->where('ticket_client',  $request->client );
                        })
                        ->when(!empty($request->priority), function ($query) use ($request) {
                            if ($request->priority != 'All') {
                                return $query->where('tickets.priority', $request->priority);
                            }
                        })

                        ->when(!empty($request->subject), function ($query) use ($request) {

                            return $query->where('tickets.subject', 'like', '%' . $request->subject . '%');

                        })
                        ->when(!empty($request->raisedby), function ($query) use ($request) {

                            return $query->where('username', 'like', '%' . $request->raisedby . '%');
                        });
                        if (empty($request->task)) {
                            // $data->where('users.client', $cl)
                        $data->where('tickets.tasks_id',NULL)
                        ;
                        }
                }
                // return $user->role;
               else if ($user->role >= 6) {
                    //nurse
                    // return 1;
                    $loggedin = auth()->user()->email;
                    $data = DB::table('tickets')
                        ->select(
                            'tickets.*',
                            'users.client as client'
                        )
                        ->leftjoin('users', 'tickets.username', "=", 'users.email')
                        // ->where('users.client', $cl)
                        ->when(!empty($request->status), function ($query) use ($request) {

                            return $query->where('tickets.status', $request->status);

                        })
                        ->when(!empty($request->ticketid), function ($query) use ($request) {

                            return $query->where('tickets.ticketid', $request->ticketid);
                        })
                        ->when(!empty($request->task), function ($query) use ($request) {

                            return $query->where('tickets.tasks_id', $request->task);

                        })
                        ->when(!empty($request->formdate), function ($query) use ($request) {
                            $todate = $request->formdate . " 00:00:00";
    
                            $tilldate = $request->todate . " 23:59:59";
    
    
                            if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                                $query->whereBetween(
                                    'tickets.created_at',
                                    [$todate, $tilldate]
                                );
                            }
                            else if ($request->status == 'Completed'){
                                // return 1;'sa';
                                $query->whereBetween(
                                    'tickets.completedat',
                                    [$todate, $tilldate]
                                );
                            }
                            else if ($request->status == 'Closed'){
                                // return 1;'sa';
                                $query->whereBetween(
                                    'tickets.closedat',
                                    [$todate, $tilldate]
                                );
                            }
    
                        })
                        ->when(!empty($request->client), function ($query) use ($request) {
                            return $query->where('ticket_client',  $request->client );
                        })
                        ->when(!empty($request->priority), function ($query) use ($request) {
                            if ($request->priority != 'All') {
                                return $query->where('tickets.priority', $request->priority);
                            }
                        })

                        ->when(!empty($request->subject), function ($query) use ($request) {

                            return $query->where('tickets.subject', 'like', '%' . $request->subject . '%');

                        })

                        ->when(!empty($request->raisedby), function ($query) use ($request) {

                            return $query->where('username', 'like', '%' . $request->raisedby . '%');
                        });

                        if (empty($request->task)) {
                            // return 1;
                        $data->where('users.client', $cl)
                        ->where('tickets.tasks_id',$request->task)
                      ->where('tickets.username', $loggedin);


                        }
                } else {
                    
                    // return 'sdf';
                    
                    $data = DB::table('tickets')
                        ->select(
                            'tickets.*',
                            'users.client as client'
                        )
                        ->leftjoin('users', 'tickets.username', "=", 'users.email')
                       
                        ->when(!empty($request->status), function ($query) use ($request) {

                            return $query->where('tickets.status', $request->status);

                        })
						->when(!empty($request->task), function ($query) use ($request) {

                            return $query->where('tickets.tasks_id', $request->task);

                        })
                        ->when(!empty($request->ticketid), function ($query) use ($request) {

                            return $query->where('tickets.ticketid', $request->ticketid);
                        })

                        ->when(!empty($request->priority), function ($query) use ($request) {
                            if ($request->priority != 'All') {
                                return $query->where('tickets.priority', $request->priority);
                            }
                        })
                        ->when(!empty($request->fromdate), function ($query) use ($request) {
                            $todate = $request->fromdate . " 00:00:00";
    
                            $tilldate = $request->todate . " 23:59:59";
    
    
                            if(!$request->status||$request->status=='Opened'||$request->status=='Processing'){
                                $query->whereBetween(
                                    'tickets.created_at',
                                    [$todate, $tilldate]
                                );
                            }
                            else if ($request->status == 'Completed'){
                                // return 1;'sa';
                                $query->whereBetween(
                                    'tickets.completedat',
                                    [$todate, $tilldate]
                                );
                            }
                            else if ($request->status == 'Closed'){
                                // return 1;'sa';
                                $query->whereBetween(
                                    'tickets.closedat',
                                    [$todate, $tilldate]
                                );
                            }
    
                        })
                        ->when(!empty($request->client), function ($query) use ($request) {
                            return $query->where('ticket_client',  $request->client );
                        })

                        ->when(!empty($request->subject), function ($query) use ($request) {

                            return $query->where('tickets.subject', 'like', '%' . $request->subject . '%');

                        })
                        ->when(!empty($request->raisedby), function ($query) use ($request) {

                            return $query->where('username', 'like', '%' . $request->raisedby . '%');
                        });
                        if (empty($request->task)) {
                            $data->where('users.client', $cl)
                        ->where('tickets.tasks_id',NULL)
                        ;
                        }

                }

            }



           

            return Datatables::of($data)


                ->addIndexColumn()


                ->editColumn('priority', function ($row) {

                    if ($row->priority == 'Low') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-info">' . $row->priority . '</span>';


                    } elseif ($row->priority == 'Medium') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-primary">' . $row->priority . '</span>';

                    } elseif ($row->priority == 'High') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-warning">' . $row->priority . '</span>';

                    } elseif ($row->priority == 'Critical') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-danger">' . $row->priority . '</span>';

                    }



                })


                ->editColumn('internal', function ($row) {

                    if ($row->internal == null) {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-primary">Internal</span>';


                    } else if ($row->internal == 1) {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-success">OCM Support</span>';

                    } else if ($row->internal == 2) {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-info">NA Support</span>';

                    }
                })


                ->editColumn('status', function ($row) {

                    if ($row->status == 'Opened') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-primary">' . $row->status . '</span>';


                    } elseif ($row->status == 'Processing') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-warning">' . $row->status . '</span>';

                    } elseif ($row->status == 'Closed') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-success">' . $row->status . '</span>';

                    } elseif ($row->status == 'Completed') {

                        return '<span class="state p-1 btn-sm px-0 btn-block text-center bg-info">' . $row->status . '</span>';

                    }



                })

                ->addColumn('action', function ($row) {

                    // $k=DB::table('ticketattachments')->select('filename','ticketid')->having('ticketid',"=",$row->ticketid)
// ->where('filename',"LIKE",'%.mov')
// ->orWhere('filename',"LIKE",'%.mp4')
// ->orWhere('filename',"LIKE",'%.mpg')
// ->orWhere('filename',"LIKE",'%.webj')
// ->orWhere('filename',"LIKE",'%.flv')
// ->first();
    
                    // $ls=DB::table('ticketattachments')->select('filename','ticketid')->having('ticketid',"=",$row->ticketid)
// ->where('filename',"LIKE",'%.jpg')
// ->orWhere('filename',"LIKE",'%.png')
// ->orWhere('filename',"LIKE",'%.docx')
// ->orWhere('filename',"LIKE",'%.xls')
// ->orWhere('filename',"LIKE",'%.pdf')
// ->orWhere('filename',"LIKE",'%.gif')
// ->orWhere('filename',"LIKE",'%.jpeg')
    
                    // ->orWhere('filename',"LIKE",'%.zip')
// ->first();
    
                    $btn = '
<div class="btn-group" role="group" aria-label="Basic example">
';

                    if ($row->status != 'Closed' && $row->status != 'Completed') {

                        $user = auth()->user();

                        if ($user->role == 4 || $user->role == 1 || $user->role == 5) {


                            $btn .= ' <button type="button" id="' . $row->id . '" title="Assign to User" class="btn btn-primary assign">
<i class="fas fa-user-plus"></i>
</button>';
                        }

                    }
                    if ($row->status == 'Closed' && $row->rating != '') {

                        $user = auth()->user();

                        if ($user->email == $row->username) {
                            if ($row->rating <= 2 && $row->rating >= 1) {
                                $btn .= ' <button type="button" id="' . $row->ticketid . '" class="btn btn-danger ">
<i class="fas fa-star"></i>
</button>';
                            }


                            if ($row->rating > 2 && $row->rating <= 4) {
                                $btn .= ' <button type="button" id="' . $row->ticketid . '" class="btn btn-warning " >
<i class="fas fa-star"></i>
</button>';
                            }

                            if ($row->rating > 4) {
                                $btn .= ' <button type="button" id="' . $row->ticketid . '" class="btn btn-success ">
<i class="fas fa-star"></i>
</button>';
                            }

                        }
                    }
                    if ($row->status == 'Closed' && $row->rating == '') {
                        $user = auth()->user();

                        if ($user->email == $row->username) {
                            $btn .= ' <button type="button" id="' . $row->ticketid . '" class="btn btn-primary rates">
<i class="far fa-star"></i>
</button>';
                        }
                    }


                    // if($k){
// $btn .=  '<a class=" btn btn-warning">
// <i class="fas fa-video"></i>
// </a>
// '; 
// }
// if($ls){
// $btn .=  '<a class=" btn btn-dark">
// <i class="fas fa-paperclip"></i>
// </a>
// '; 
// }
    

                    $btn .= '<a href="' . route("TicketView", ["id" => $row->id]) . '" title="View Ticket" class="btn btn-info update">
<i class="fas fa-eye"></i>
</a>

';
if(auth()->user()->role<=3&&$row->agenda!=1){
$btn .= '<button type="button" id="' . $row->ticketid . '" class="btn btn-primary agenda">
<i class="fas fa-clipboard"></i>
</button>
</div>';
}


                    return $btn;

                })



                ->setRowId('id')
                ->rawColumns(['action', 'priority', 'internal', 'status'])
                ->make(true);



        }

        // $users=DB::table('users')->get(); 
// $use=DB::table('users')->whererole(0)->get(); 


        // $data = [

        //          'users' => $users,
//          'use' => $use

        // ];           

        // return view('tickets')->with('data', $data);  


        $data69 = DB::table('users')->where('role', '<>', '1')->get();
        $data4 = DB::table('users')->select('users.client')->leftjoin('tickets', 'tickets.username', "=", 'users.email')


            ->get();
        $cl = Auth()->user()->client;
        $data2 = DB::table('users')->whereIn('role', [1, 2, 3])->get();
        $data3 = DB::table('users')
            ->whereIn('role', [4, 5])
            // ->Where('role','=','4')
            ->where('client', $cl)

            // ->where('role','=','4')
            ->get();


        // return view('tickets')->with('data', $data);  
// return $request;

        return view('tickets', [

            'data' => $data69,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4

        ]);




    }

    public function rateNow(Request $request)
    {
        if ($request->ajax()) {
            $tid = $request->tid;
            // $mid = $request->mid;
            $rating = $request->check;
            $time = $request->time;
            $satisfy = $request->satisfy;
            $comment = $request->comment;
            return DB::update("update tickets  set  rating='" . $rating . "',time='" . $time . "',satisfy='" . $satisfy . "',comments='" . $comment . "' where ticketid = '" . $request->tid . "'");

            // return $request;
        }

    }
    public function Error()
    {
        return view('error');
    }
  
public function ticketstimeline(Request $req){

	if($req->ajax()){

     $data = DB::table('tickettimelines');


return Datatables::of($data)

->setRowId('id')
->rawColumns(['action'])
->make(true);
    }
return view('tickettimeline');
}


public function addToAgenda(Request $request){
    // return $request;
   $ticket= Ticket::where('ticketid',$request->ticketId)->first();
//    return $request->agendaDate;

   if($ticket){
  return $ticket->update([
    'agenda'=>1,
    'agenda_dev'=>auth()->user()->name,
    'agenda_created_at'=>$request->agendaDate
   ]);
}
}
public function tasks(Request $request)
{
    if ($request->ajax()) {

        $loggedInUser = auth()->user()->id;
        $userRole = auth()->user()->role;
        $role = DB::table('lists')->where('id', $userRole)->pluck('Text')->toArray();
        $permissions = DB::table('projectpermissions')
            ->where('userid', $loggedInUser)
            ->pluck('projectid')
            ->toArray();

        if ($role[0] !== 'Super Admin') {
            $data = DB::table('tasks')
                ->whereIn('id', $permissions);
        } else {
            $data = DB::table('tasks');
        }

        return Datatables::of($data)
            ->addColumn('action', function($row) {
                $btn = '
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-info edit" id="' . $row->id . '" >Edit</button>
                    <button class="btn btn-success viewTickets" id="' . $row->id . '"> View </button>
                    <button class="btn btn-dark viewLogs" id="' . $row->id . '"> Timeline </button>
                </div>';
                return $btn;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);
    }

    // Fetch all users and departments
    $users = User::all();
    $departments = DB::table('user_departments')->pluck('department_name');

    return view('tasks')->with([
        'users' => $users,
        'departments' => $departments
    ]);
}


// public function addtask(Request $request){

	
   
// 	$validator=$request->validate([
// 	'subject' => 'required',
// 	'department' => 'required',
// 	'description'=> 'required',
// 	'status' => 'required',
// 	'assignto' => 'required',
// 	'timeline' => 'required',


// 	]);

   

// 	$subject = $request->subject;
// 	$department = $request->department;
// 	$description = $request->description;
// 	$status = $request->status;
// 	$timeline = $request->timeline;


//     $assignto = $request->assignto;
//      $assignedToEmails = json_decode($request->assignedToEmails);

//      $user = Auth::user();


//     // Get the ID of the authenticated user
//     $loggedInUserID = $user->id;

//     // Append the ID of the logged-in user to the $assignto array
//     $assignto[] = $loggedInUserID;

//     // print_r($assignto);
//     // return count($assignto);
//         // return $assignedToEmails[0];

// 	// $id=Str::uuid(); 
// 	$task = Task::create([
        
//         'subject' => $subject,
//         'department' => $department,
//         'description' => $description,
//         'status' => $status,
//         'timeline' => $timeline,

//     ]);


// 	if($task){

//         $i=0;
//         foreach($assignto as $userid){
//             Projectpermission::create([
//                 "userid"=>$userid,
//                 "projectid" => $task->id,
//             ]);
//             if($i<count($assignto)-1){
//              $user['to'] = $assignedToEmails[$i];
         
//             $esubject="New Project";

//             $emailData=[
//                 'to' => $assignedToEmails[$i],
//                 'esubject'=>'New Project',
//                 'messages'=>'You have been added to a new project.'
//             ];
//             // Mail::to($assignedToEmails[$i])->send(new ProjectAssigned($emailData));
//             SendProjectAssignedEmail::dispatch($emailData);
//             $i++;
//         }
            
//         }

// 		return response()->json(["success"=>"Task Added Successfully"]);
// 	}else{
// 		return response()->json(["error"=>"Error Adding Task"]);

// 	}
	
// }

public function addtask(Request $request){

	
    // return $request;
	$validator=$request->validate([
	'subject' => 'required',
	'department' => 'required',
	'description'=> 'required',
	'status' => 'required',
	'assignto' => 'required',

	]);

   

	$subject = $request->subject;
	$department = $request->department;
	$description = $request->description;
	$status = $request->status;

    $assignto = $request->assignto;
     $assignedToEmails = json_decode($request->assignedToEmails);
        // return $assignedToEmails[0];

	// $id=Str::uuid(); 
	$task = Task::create([
        'subject' => $subject,
        'department' => $department,  // This will now be the department name, not the ID
        'description' => $description,
        'status' => $status,
    ]);

	if($task){

        $i=0;
        foreach($assignto as $userid){
            Projectpermission::create([
                "userid"=>$userid,
                "projectid" => $task->id,
            ]);
             $user['to'] = $assignedToEmails[$i];
         
            $esubject="New Project";
            // Mail::send('projectmail', ['messages' => 'You have been assigned to a new project','esubject'=>"New Project"], function ($message) use ($user,$esubject) {
            //     return $esubject;
            //     $message->to($user['to']); // Use $user['to'] instead of $assignedToEmails[$i]
            //     $message->subject($esubject);
            // });
            
            // Mail::to($assignedToEmails[$i])->send(new \App\Mail\ProjectAssigned($assignedToEmails[$i], ['messages' => 'You have been assigned to a new project', 'esubject' => 'New Project']));

            $emailData=[
                'to' => $assignedToEmails[$i],
                'esubject'=>'New Project',
                'messages'=>'You have been added to a new project.'
            ];
            // Mail::to($assignedToEmails[$i])->send(new ProjectAssigned($emailData));
            SendProjectAssignedEmail::dispatch($emailData);
            $i++;
            
            
        }

		return response()->json(["success"=>"Task Added Successfully"]);
	}else{
		return response()->json(["error"=>"Error Adding Task"]);

	}
	
}


public function edittask(Request $request){
		
		$id = $request->id;
		 $row = DB::table('tasks')->where('id',$id)->first();
        //  $row->timeline=Carbon::parse($row->timeline)->format('dd/mm/YYYY');
        //  $row->projected_timeline=Carbon::parse($row->projected_timeline)->format('d/m/Y');
        
         $projectUsers = DB::table('projectpermissions')
         ->where('projectid', $id)
         ->join('users', 'projectpermissions.userid', '=', 'users.id')
         ->select('users.id', 'users.email') // Select both user ID and email
         ->get(); // Get the query results as a collection
     
     // Convert the collection to an array
     $projectUsersArray = $projectUsers->toArray();
//    return $row[0]['emails'] = $projectUsers;
    
		return response()->json(["row"=>$row,"users"=>$projectUsersArray]);

}



public function updatetask(Request $request){

	 
	// $validator=$request->validate([
	// 'subject' => 'required',
	// 'department' => 'required',
	// 'description'=> 'required',
	// 'status' => 'required',
	// 'timeline' => 'required',
	// 'ptimeline' => 'required',

	// ]);
 $request;    
	$id = $request->id;
	$subject = $request->subject;
	$department = $request->department;
	$description = $request->description;
	$status = $request->status;
    $assignTo=$request->assignto;
    $timeline = $request->timeline;
    $ptimeline = $request->ptimeline;

	$test = DB::update("UPDATE tasks set subject = ?, status = ?, department = ?, description = ?,timeline = ?,projected_timeline=? where id = ?",[$subject, $status, $department, $description,$timeline,$ptimeline, $id]);

    foreach($assignTo as $assign){
    $exists= DB::table('projectpermissions')->where('userid',$assign)->where('projectid',$id)->count();
   if($exists==0){
    Projectpermission::create([
        "userid"=>$assign,
        "projectid" => $id,
    ]);
    $emailData=[
        'esubject'=>'New Project',
        'messages'=>'You have been added to a new project.'
    ];
    // Mail::to($assignedToEmails[$i])->send(new ProjectAssigned($emailData));
   }
    }
	// if($test){
		return response()->json(["success"=>"Task Updated Successfully"]);
	// }else{
	// 	return response()->json(["error"=>"Error Updating Task"]);

	// }
	
}


public function deletetask(Request $request){

	$id = $request->id;

	$test = DB::table('tasks')->where('id', '=', $id)->delete();
	if($test){
		return response()->json(["success"=>"Task Deleted"]);
	}else{
		return response()->json(["success"=>"Error Deleting Task"]);
	}
}

public function SendReportEmail(Request $request)
{
	try {
		$requestData = [
			'toDate' => $request->toDate,
			'tillDate' => $request->tillDate,
			'emailSubject' => $request->emailSubject,
			'messageText' => $request->messageText,
		];


            dispatch(new SendTicketsReport($requestData));

            return response()->json([
                'success' => 'Email will be sent shortly.',
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that suits your application
            // return redirect()->back()->with('error', 'An error occurred while processing the request.');

            return response()->json([
                'error' => 'An error occurred while processing the request.',
            ]);
        }
    }


    public static function tickettimeline($ticketid,$text,$useremail,$assignedto,$openedby,$completedby,$status){

        $ticketTimeline = tickettimeline::create([
            'ticketid' => $ticketid,
            'text' => $text,
            'useremail' => $useremail,
            'assignedto' => $assignedto,
            'openedby' => $openedby,
            'completedby' => $completedby,
            'status' => $status,
        ]);
        return $ticketid;
    }

    public static function DateTime($value)
    {
        return date('d-m-Y H:i', strtotime($value)) ;
    }

    public function dailyreports(Request $req){
        // return 2;
        return view('dailyreports');
    }

    public function dailyreportsdata(Request $request)
    {
        $tickets = DB::table('daily_reports')
        ->select(['id', 'ticketid', 'subject', 'created_At', 'assignedto','last_reply', 'createdby', 'completedat', 'ticket_created_at','ticket_view_id','client']);
    // return $request;
        if ($request->has('date') && !empty($request->date)) {
            // return 1;
            $searchValue = $request->date;
    
            // Apply custom search on created_at column
            $tickets->where('created_at', 'like', '%' . $searchValue . '%');
        }
        return Datatables::of($tickets)->make(true);
    }

    public function sendReply(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            // 'reply' => 'required|string',
        ]);


        $email = $request->input('email');
        $reply = $request->input('messages');
        $ticketNumber = $request->input('ticketNumber');
        $subject = $request->input('subject');
        $repliedBy=auth()->user()->email;
if($email!=$repliedBy){

        Mail::to($email)->send(new TicketReplyMail($reply,$ticketNumber,$repliedBy,$subject));
}
        return response()->json(['message' => 'Reply sent successfully'], 200);


    }

    public function assignToProject(Request $request){

     return  DB::table('tickets')
        ->where('id', $request->ticketid)
        ->update(['tasks_id' => $request->projectid]);

    
    }
    public function agendaDone(Request $request){
        $ticket= Ticket::where('id',$request->tid)->first();
        if($ticket){
       return $ticket->update([
         'agenda_done'=>1,
        ]);
     }
    }
    public function saveAgendaNotes(Request $request){
        $ticket= Ticket::where('id',$request->id)->first();
        if($ticket){
       return $ticket->update([
         'agenda_notes'=>$request->notes,
        ]);
     }
    }
     public function getAgendabyDate(Request $request){
        // $data = DB::table('tickets')->where('agenda','=','1')->where('agenda_created_at',$request->date)->get();
        $data = DB::table('tickets')
    ->where('agenda', '=', '1')
    ->where(function($query) use ($request) {
        $query->where('agenda_created_at', $request->date) // Today's tickets
              ->orWhere(function($query) {
                  $query->where('agenda_created_at', '<', now()->toDateString()) // Tickets before today
                        ->whereNull('agenda_done'); // agenda_done is null
              });
    })
    ->orderBy('agenda_created_at')
    ->get();

          return view('layouts.agendatable')->with('agenda',$data);
     }
    public function agenda(Request $request){

        // if($request->ajax()){
           
            
       
    //    return Datatables::of($data)
       
    //    ->setRowId('id')
    //    ->rawColumns(['action'])
    //    ->make(true);
    //        }

        return view('agenda');
    }

    public function dependencyEmail(Request $request){

        // return $request;
         $dependencyTicketSubjects = $request->dependencyTicketSubjects;
        
        $thisTicketId = $request->thisTicketId;
        $thisTicketSubject = $request->thisTicketSubject;
        $taskId = $request->taskId;

        if($dependencyTicketSubjects){
     $dependencyTicketSubjects = implode(',', $dependencyTicketSubjects);
        }else{
            $dependencyTicketSubjects=null;
        }

        // $ticket = [
        //     'id' => $thisTicketId,
        //     'subject' => $thisTicketSubject
        // ];

           
            
            $update = DB::table('tickets')
            ->where('id', $thisTicketId)
            ->update(['dependencytickets' => $dependencyTicketSubjects]);

            if($update){
                return response()->json(["success"=>"Dependency Updated"]);
            }else{
                return response()->json(["Error"=>"Error Updating Dependency"]);
            }
        
    
        // $recipients = ['zaintahir0012@gmail.com','aqeel@ocmsoftware.ie'];
    
        // Mail::to($recipients)->send(new TicketDependencyNotification($ticket, $dependencies));
    
        // return "Notification sent!";

    }

    public function timeline_audit(Request $request,$tasks_id = null){
        // return true;
        
        if($request->ajax()){
            // return $request->tasks_id;
     $data = DB::table('timeline_audit')->select('ticketid', 'activity', 'id')->where('tasks_id',$tasks_id);

            return Datatables::of($data)
            ->addIndexColumn() 
    //         ->addColumn('action', function($data){
                                
    //             $btn = '<div class="btn-group" role="group">
    //             <button id="'.$data->id.'" title="Edit" class="edit btn btn-primary update ">
    //                 <i class="bx bx-edit"></i>
                   
    //                 </div>';
    
    //            return $btn;
    //    }) 
            ->setRowId('id')
            ->rawColumns(['action','InUse'])
            ->make(true);

        }
      
        
        return view('timeline_audit');
    }

}



