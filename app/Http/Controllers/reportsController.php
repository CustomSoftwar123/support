<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportsController extends Controller
{
    //
    public function generateReport(Request $request){
        // return $request;
        if($request->duration=='This Week'){
        $startOfWeek = now()->startOfWeek();
$endOfWeek = now()->endOfWeek();

// Retrieve the number of tickets created this week using the Query Builder
     $numberOfTicketsOpenedThisWeek = DB::table('tickets')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->where('status','=','Opened')
    ->count();
    $numberOfTicketsProcessingThisWeek = DB::table('tickets')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->where('status','=','Processing')
    ->count();
    $numberOfTicketsCompletedThisWeek = DB::table('tickets')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->where('status','=','Completed')
    ->count();
    $numberOfTicketsClosedThisWeek = DB::table('tickets')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->where('status','=','Closed')
    ->count();

    return response()->json([
        'Tickets Opened' => $numberOfTicketsOpenedThisWeek,
        'Tickets in Processing' => $numberOfTicketsProcessingThisWeek,
        'Tickets Completed' => $numberOfTicketsCompletedThisWeek,
        'Tickets Closed' => $numberOfTicketsClosedThisWeek,
    ]);

        // return $request;
        }
        else if($request->duration=='Last Week'){
            $startOfLastWeek = now()->startOfWeek()->subWeek();
$endOfLastWeek = now()->endOfWeek()->subWeek();

// Retrieve the number of tickets created last week using the Query Builder
$numberOfTicketsLastWeek = DB::table('tickets')
    ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
    ->count();
    $numberOfTicketsProcessingLastsWeek = DB::table('tickets')
    ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
    ->where('status','=','Processing')
    ->count();
    $numberOfTicketsCompletedLastWeek = DB::table('tickets')
    ->whereBetween('created_at', [$endOfLastWeek, $endOfLastWeek])
    ->where('status','=','Completed')
    ->count();
    $numberOfTicketsClosedLastWeek = DB::table('tickets')
    ->whereBetween('created_at', [$endOfLastWeek, $endOfLastWeek])
    ->where('status','=','Closed')
    ->count();

    return response()->json([
        'Tickets Opened' => $numberOfTicketsLastWeek,
        'Tickets in Processing' => $numberOfTicketsProcessingLastsWeek,
        'Tickets Completed' => $numberOfTicketsCompletedLastWeek,
        'Tickets Closed' => $numberOfTicketsClosedLastWeek,
    ]);
  
        }
    }
}
