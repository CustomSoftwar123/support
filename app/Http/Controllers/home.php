<?php
     
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\ticketattachment;
use Validator;
use DB;
Use Carbon\Carbon;
use DateTime;
use Datatables;

class home extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

     public function updateThemeInfo(Request $request)
    {

          if($request->limit == 'all') {

            $sql = DB::update("update users  set 

                            colorscheme = '".substr($request->colorscheme, 1)."',
                            font = '".$request->font."',
                            font_link = '".$request->font_link."',
                            font_weight = '".$request->font_weight."',
                            resolution = '".$request->resolution."' ");   

             return response()->json(['success'=>'Changes applied to all users.']);


          } else {

            $user = auth()->user();
            $sql = DB::update("update users  set 

                            colorscheme = '".substr($request->colorscheme, 1)."',
                            font = '".$request->font."',
                            font_link = '".$request->font_link."',
                            font_weight = '".$request->font_weight."',
                            resolution = '".$request->resolution."'

                            where id = '".$user->id."' "); 

              return response()->json(['success'=>'Changes applied successfully.']);                                  

          }
          

           

    }


    public function getTicketsComparison(Request $request){
      $duration=$request->duration;
      if($duration=='This Week'||$duration=='Last Week'){
      $ticketsThisWeek = DB::table('tickets')
 
      ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
      ->count();
      $ticketsOpenedThisWeek = DB::table('tickets')
      ->where('status','Opened')
      ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
      ->count();
      $ticketsProcessingThisWeek = DB::table('tickets')
      ->where('status','Processing')
      ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
      ->count();
      $ticketsCompletedThisWeek = DB::table('tickets')
      ->where('status','Completed')
      ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
      ->count();
      $ticketsClosedThisWeek = DB::table('tickets')
      ->where('status','Closed')
      ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
      ->count();

      $ticketsLastWeek = DB::table('tickets')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->startOfWeek()->subSecond()])
    ->count();

    $ticketsClosedLastWeek = DB::table('tickets')
    ->where('status','Closed')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->startOfWeek()->subSecond()])
    ->count();
    $ticketsOpenedLastWeek = DB::table('tickets')
    ->where('status','Opened')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->startOfWeek()->subSecond()])
    ->count();
    $ticketsProcessingLastWeek = DB::table('tickets')
    ->where('status','Processing')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->startOfWeek()->subSecond()])
    ->count();
    $ticketsCompletedLastWeek = DB::table('tickets')
    ->where('status','Completed')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->startOfWeek()->subSecond()])
    ->count();
    $ticketsLastWeek = DB::table('tickets')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->startOfWeek()->subSecond()])
    ->count();

    return  $data = [

      'ticketsThis' => $ticketsThisWeek,
      'ticketsClosedThis' => $ticketsClosedThisWeek,
      'ticketsOpenedThis' => $ticketsOpenedThisWeek,
      'ticketsProcessingThis' => $ticketsProcessingThisWeek,
      'ticketsCompletedThis' => $ticketsCompletedThisWeek,
      'ticketsLast'=>$ticketsLastWeek,
      'ticketsClosedLast'=>$ticketsClosedLastWeek,
      'ticketsOpenedLast'=>$ticketsOpenedLastWeek,
      'ticketsProcessingLast'=>$ticketsProcessingLastWeek,
      'ticketsCompletedLast'=>$ticketsCompletedLastWeek,
    
];
      }
      else if($duration=='This Month'||$duration=='Last Month'){
        $firstDayOfMonth = Carbon::now()->startOfMonth();
     $lastDayOfMonth = Carbon::now()->endOfMonth();
     
       $ticketsThisMonth = DB::table('tickets')
         ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
         ->count();

         $ticketsOpenedThisMonth = DB::table('tickets')
         ->where('status','Opened')
         ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
         ->count();
         $ticketsProcessingThisMonth = DB::table('tickets')
         ->where('status','Processing')
         ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
         ->count();
         
         $ticketsClosedThisMonth = DB::table('tickets')
         ->where('status','Closed')
         ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
         ->count();
         $ticketsCompletedThisMonth = DB::table('tickets')
         ->where('status','Completed')
         ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
         ->count();

         $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
         $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
         
         $ticketsLastMonth = DB::table('tickets')
             ->whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth])
             ->count();
         $ticketsOpenedLastMonth = DB::table('tickets')
         ->where('status','Opened')
         ->whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth])
         ->count();
         $ticketsProcessingLastMonth = DB::table('tickets')
         ->where('status','Processing')
         ->whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth])
         ->count();
         
         $ticketsClosedLastMonth = DB::table('tickets')
         ->where('status','Closed')
         ->whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth])
         ->count();
         $ticketsCompletedLastMonth = DB::table('tickets')
         ->where('status','Completed')
         ->whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth])
         ->count();
             return $data = [
              'ticketsThis' => $ticketsThisMonth,
              'ticketsClosedThis' => $ticketsClosedThisMonth,
              'ticketsOpenedThis' => $ticketsOpenedThisMonth,
              'ticketsProcessingThis' => $ticketsProcessingThisMonth,
              'ticketsCompletedThis' => $ticketsCompletedThisMonth,
              'ticketsLast'=>$ticketsLastMonth,
              'ticketsClosedLast'=>$ticketsClosedLastMonth,
              'ticketsOpenedLast'=>$ticketsOpenedLastMonth,
              'ticketsProcessingLast'=>$ticketsProcessingLastMonth,
              'ticketsCompletedLast'=>$ticketsCompletedLastMonth,
];
      }

    }
    public function index()
    {
        $role=Auth()->user()->role;
        $cl=Auth()->user()->client;
        if($role<=3){
// echo $sql="select * from tickets where status='Closed' and internal IN(1,2) and closed_at between(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()) or created_by<=3 ";
// return 1;
//  $ticketsThisWeek =DB::select($sql);
           $ticketsThisWeek =  DB::table('tickets')
                                    ->having('tickets.status','=','Opened')
                                    ->whereIn('tickets.internal',[1,2]) 
                                    // ->orWhere('tickets.created_by','<=',3)

                                      ->count();

          $ticketsProcessing =  DB::table('tickets')
                                       
                                        ->having('tickets.status','Processing')
                                        ->whereIn('tickets.internal',[1,2])
                                        // ->orWhere('tickets.created_by','<=',3)
                                        ->count();
// return 
$d= Carbon::now()->startOfWeek()->format('Ymd');
       $query="SELECT * FROM `tickets` WHERE closedat >'".$d."' having status ='closed' and internal in(1,2) or created_by <=3"; 
     $close=DB::select($query);
     
      $ticketsClosedThisWeek=count($close);
     
      
      DB::table('tickets')
                                   ->where('tickets.closedat','>', 
                                             Carbon::now()->startOfWeek()->format('Ymd')
                                        ) 
                                       
                                        ->whereIn('tickets.internal',[1,2])  
                                        ->orWhere('tickets.created_by','<=',3)
                                        ->count();

        $ticketsCompletedThisWeek =  DB::table('tickets')
                                        ->whereBetween('tickets.completedat', 
                                             [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                                         ) 
                                         ->having('tickets.status','Completed') 
                                         ->whereIn('tickets.internal',[1,2])  
                                         ->where(function ($query) {
                                          $query->whereIn('internal', [1, 2])
                                              ->orWhere(function ($query) {
                                                  $query->whereNull('internal')
                                                      ->whereNotNull('created_for');
                                              });
                                      })
                                        //  ->orWhere('tickets.created_by','<=',3)
                                         ->count();
 

        }elseif($role==4 ||$role==5){
            $ticketsThisWeek =  DB::table('tickets')
            ->where('tickets.status','Opened')
            ->where('users.client',$cl)
                ->leftjoin('users', 'tickets.username' ,"=",'users.email')
            
              ->count();

$ticketsProcessing =  DB::table('tickets')
               
                ->where('tickets.status','Processing')
                ->where('users.client',$cl)
                ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                ->count();

$ticketsClosedThisWeek =  DB::table('tickets')
               ->whereBetween('tickets.closedat', 
                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                )   ->where('users.client',$cl)
                ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                ->where('tickets.status','Closed') 
                
                ->count();

$ticketsCompletedThisWeek =  DB::table('tickets')
                ->whereBetween('tickets.completedat', 
                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                 ) 
                 ->where('users.client',$cl)
                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                 ->where('tickets.status','Completed') 
                
                 ->count();

        }else{
             $email=Auth()->user()->email;
            $ticketsThisWeek =  DB::table('tickets')
            ->where('tickets.status','Opened')
            ->where('username',$email)
            ->where('users.client',$cl)
            ->leftjoin('users', 'tickets.username' ,"=",'users.email')
              ->count();

$ticketsProcessing =  DB::table('tickets')
               
                ->where('tickets.status','Processing')
                ->where('username',$email)
                ->where('users.client',$cl)
                ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                ->count();

$ticketsClosedThisWeek =  DB::table('tickets')
               ->whereBetween('closedat', 
                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                ) 
                ->where('tickets.status','Closed') 
                ->where('tickets.username',$email)
                ->where('users.client',$cl)
                ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                ->count();

$ticketsCompletedThisWeek =  DB::table('tickets')
                ->whereBetween('tickets.completedat', 
                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                 ) 
                 ->where('tickets.status','Completed') 
                 ->where('tickets.username',$email)
                 ->where('users.client',$cl)
                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                 ->count();
        }
    

         
         $data = [

                'ticketsThisWeek' => $ticketsThisWeek,
                'ticketsProcessing' => $ticketsProcessing,
                'ticketsClosedThisWeek' => $ticketsClosedThisWeek,
                'ticketsCompletedThisWeek'=>$ticketsCompletedThisWeek
         ];



         return view ('home')->with('data',$data);
    }

//     public function index()
//     {
//         $role=Auth()->user()->role;
//         $cl=Auth()->user()->client;
//         if($role<=3){
// // echo $sql="select * from tickets where status='Closed' and internal IN(1,2) and closed_at between(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()) or created_by<=3 ";
// // return 1;
// //  $ticketsThisWeek =DB::select($sql);
//            $ticketsThisWeek =  DB::table('tickets')
//                                     ->having('tickets.status','=','Opened')
//                                     ->whereIn('tickets.internal',[1,2]) 
//                                     ->orWhere('tickets.created_by','<=',3)

//                                       ->count();

//           $ticketsProcessing =  DB::table('tickets')
                                       
//                                         ->having('tickets.status','Processing')
//                                         ->whereIn('tickets.internal',[1,2])
//                                         ->orWhere('tickets.created_by','<=',3)
//                                         ->count();
// // return 
// $d= Carbon::now()->startOfWeek()->format('Ymd');
//        $query="SELECT * FROM `tickets` WHERE closedat >'".$d."' having status ='closed' and internal in(1,2) or created_by <=3"; 
//      $close=DB::select($query);
     
//       $ticketsClosedThisWeek=count($close);
     
      
//       DB::table('tickets')
//                                    ->where('tickets.closedat','>', 
//                                              Carbon::now()->startOfWeek()->format('Ymd')
//                                         ) 
                                       
//                                         ->whereIn('tickets.internal',[1,2])  
//                                         ->orWhere('tickets.created_by','<=',3)
//                                         ->count();

//         $ticketsCompletedThisWeek =  DB::table('tickets')
//                                         ->whereBetween('tickets.completedat', 
//                                              [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
//                                          ) 
//                                          ->having('tickets.status','Completed') 
//                                          ->whereIn('tickets.internal',[1,2])  
//                                          ->orWhere('tickets.created_by','<=',3)
//                                          ->count();
 

//         }elseif($role==4 ||$role==5){
//             $ticketsThisWeek =  DB::table('tickets')
//             ->where('tickets.status','Opened')
//             ->where('users.client',$cl)
//                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
            
//               ->count();

// $ticketsProcessing =  DB::table('tickets')
               
//                 ->where('tickets.status','Processing')
//                 ->where('users.client',$cl)
//                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//                 ->count();

// $ticketsClosedThisWeek =  DB::table('tickets')
//                ->whereBetween('tickets.closedat', 
//                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
//                 )   ->where('users.client',$cl)
//                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//                 ->where('tickets.status','Closed') 
                
//                 ->count();

// $ticketsCompletedThisWeek =  DB::table('tickets')
//                 ->whereBetween('tickets.completedat', 
//                      [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
//                  ) 
//                  ->where('users.client',$cl)
//                  ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//                  ->where('tickets.status','Completed') 
                
//                  ->count();

//         }else{
//              $email=Auth()->user()->email;
//             $ticketsThisWeek =  DB::table('tickets')
//             ->where('tickets.status','Opened')
//             ->where('username',$email)
//             ->where('users.client',$cl)
//             ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//               ->count();

// $ticketsProcessing =  DB::table('tickets')
               
//                 ->where('tickets.status','Processing')
//                 ->where('username',$email)
//                 ->where('users.client',$cl)
//                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//                 ->count();

// $ticketsClosedThisWeek =  DB::table('tickets')
//                ->whereBetween('closedat', 
//                     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
//                 ) 
//                 ->where('tickets.status','Closed') 
//                 ->where('tickets.username',$email)
//                 ->where('users.client',$cl)
//                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//                 ->count();

// $ticketsCompletedThisWeek =  DB::table('tickets')
//                 ->whereBetween('tickets.completedat', 
//                      [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
//                  ) 
//                  ->where('tickets.status','Completed') 
//                  ->where('tickets.username',$email)
//                  ->where('users.client',$cl)
//                  ->leftjoin('users', 'tickets.username' ,"=",'users.email')
//                  ->count();
//         }
    

         
//          $data = [

//                 'ticketsThisWeek' => $ticketsThisWeek,
//                 'ticketsProcessing' => $ticketsProcessing,
//                 'ticketsClosedThisWeek' => $ticketsClosedThisWeek,
//                 'ticketsCompletedThisWeek'=>$ticketsCompletedThisWeek
//          ];



//          return view ('home')->with('data',$data);
//     }

  public function getTicketsReport(Request $request)
    {
        $cl=Auth()->user()->client;

             $duration =  $request->duration;  

                $now = Carbon::now();
                


                if($duration == 'This Week') {


                    $start = $now->startOfWeek()->format('d-m-Y');
                    $end = $now->endOfWeek()->format('d-m-Y'); 
                    $labels = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');    
                

                } elseif($duration == 'Last Week') {

                    $start = $now->startOfWeek()->subWeek()->format('d-m-Y');
                    $end = $now->endOfWeek()->format('d-m-Y');
                    $labels = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                    
                }


                elseif($duration == 'This Month') {

                    $start = $now->format('Y-m-1');
                    $end = $now->format('Y-m-t');
                    $labels = array();
                    
                }

                elseif($duration == 'Last Month') {

                    $start = $now->subMonth()->format('Y-m-1');
                    $end = $now->format('Y-m-t');
                    $labels = array();
                    
                }

                


                $start = new DateTime( $start );
                $end   = new DateTime( $end );    


                $sr = 0;
                $sr2 = 0;



                for($i = $start; $i <= $end; $i->modify('+1 day')) {


                       $date = $i->format("Y-m-d"); 

                        if($duration == 'This Month') {

                            $labels[] = $date;

                        }
                        elseif($duration == 'Last Month') {

                            $labels[] = $date;

                        }
                         $role=auth()->user()->role;
                          if($role==4||$role==5){
                   
                      $values[]= DB::table('tickets')->select('ticketid')
                        ->where([
                            ['tickets.created_at','like',$date.'%'],
                          ['tickets.status','Opened'] 
                          
                          ]) ->where('users.client',$cl)
                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                                              ->count();

                        $values2[] =  DB::table('tickets')
                                              ->whereDate('tickets.created_at','like',$date.'%')
                                              ->where('users.client',$cl)
                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                                              ->where('tickets.status','Processing') 
                                              ->count();


                        $values3[] =  DB::table('tickets')
                        ->where([
                            ['tickets.closedat','like',$date.'%'],
                          ['tickets.status','Closed'] 
                          
                          ])
                          ->where('users.client',$cl)
                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                                              ->count();                                                                            
                       
                        $values4[] =  DB::table('tickets')
                                              ->where([
                                                ['tickets.completedat','like',$date.'%'],
                                              ['tickets.status','Completed'] 
                                              
                                              ])
                                              ->where('users.client',$cl)
                 ->leftjoin('users', 'tickets.username' ,"=",'users.email')
                                              ->count();                                                                            
                       
                            
                                              }else if($role<=3){
                                                $values[]= DB::table('tickets')->select('ticketid')
                                                ->where([
                                                    ['created_at','like',$date.'%'],
                                                  ['status','Opened'] 
                                                  
                                                  ]) 
                                                  ->whereIn('internal',[1,2])
                                                                      ->count();
                        
                                                $values2[] =  DB::table('tickets')
                                                                      ->whereDate('created_at','like',$date.'%')
                                                                      ->where('status','Processing') 
                                                                      ->count();
                        
                                                $values3[] =  DB::table('tickets')
                                                ->where([
                                                    ['closedat','like',$date.'%'],
                                                  ['status','Closed'] 
                                                  
                                                  ])
                                                  ->whereIn('internal',[1,2])
                                                                      ->count();                                                                            
                                               
                                                $values4[] =  DB::table('tickets')
                                                                      ->where([
                                                                        ['completedat','like',$date.'%'],
                                                                      ['status','Completed'] 
                                                                      
                                                                      ])
                                                                      ->whereIn('internal',[1,2])
                                                                      ->count();                                                                            
                                               
                                              }
                                              else{
                                                $email=Auth()->user()->email;
                                                $values[]= DB::table('tickets')->select('ticketid')
                                                ->where([
                                                    ['created_at','like',$date.'%'],
                                                  ['status','Opened'] 
                                                  
                                                  ]) 
                                                  ->where('username',$email)
                                                                      ->count();
                        
                                                $values2[] =  DB::table('tickets')
                                                                      ->whereDate('created_at','like',$date.'%')
                                                                      ->where('status','Processing') 
                                                                      ->where('username',$email)
                                                                      ->count();
                        
                                                $values3[] =  DB::table('tickets')
                                                ->where([
                                                    ['closedat','like',$date.'%'],
                                                  ['status','Closed'] 
                                                  
                                                  ])
                                                  ->where('username',$email)
                                                                      ->count();                                                                            
                                               
                                                $values4[] =  DB::table('tickets')
                                                                      ->where([
                                                                        ['completedat','like',$date.'%'],
                                                                      ['status','Completed'] 
                                                                      
                                                                      ])
                                                                      ->where('username',$email)
                                                                      ->count();                                                                            
                                               

                                              }
                        
                } 
                
             $data = [

                'labels' => $labels,
                'values' => $values,
                'values2' => $values2,
                'values3' => $values3,
                'values4' => $values4
         ];



             return \Response::json($data);  
             


    }    
  

   


}