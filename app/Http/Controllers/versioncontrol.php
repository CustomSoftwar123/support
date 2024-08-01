<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use DataTables;

class versioncontrol extends Controller
{
    public function versioncontrol(Request $request){
        $data = DB::table('version_control')->select();
        
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn() 
            ->addColumn('action', function($data){
                                
                $btn = '<div class="btn-group" role="group">
                <button id="'.$data->id.'" title="Edit" class="edit btn btn-primary update ">
                    <i class="bx bx-edit"></i>
                   
                    </div>';
    
               return $btn;
       }) 
            ->setRowId('id')
            ->rawColumns(['action','InUse'])
            ->make(true);

        }
      
        
        return view('versioncontrol');
    }


    public function versioncontrolsubmit(Request $request){
       
        $client = $request->client;
        $currentversion = $request->currentversion;
        $newversion = $request->newversion;
        $sentDate = $request->sentDate;
        $application = $request->application;

        $validated = $request->validate([
            'client' => 'required',
            'currentversion' => 'required',
            'newversion' => 'required',
        ]);

        $insert = DB::insert("INSERT into version_control (`client`, `currentversion`, `newversion`, `sentDate`,`application`) values ('$client', '$currentversion', '$newversion', '$sentDate','$application')");
        if($insert){
            return "Data Inserted Successfully!";
        }else{
            return "Error Inserting Data!";
        }
    }

    public function versioncontrolupdate(Request $request){
       
        $client = $request->client;
        $currentversion = $request->currentversion;
        $newversion = $request->newversion;
        $application = $request->application;
        $id = $request->id;

        $validated = $request->validate([
            'client' => 'required',
            'currentversion' => 'required',
            'newversion' => 'required',
        ]);

        $change = DB::update("UPDATE version_control set client = '$client', currentversion = '$currentversion',newversion = '$newversion', `application`='$application' where id = '$id'");
        if($change){
            return "Data Updated Successfully!";
        }else{
            return "Error Updating Data";
            // return "UPDATE members set membername = '$name', email = '$email',password = '$password', confirmpass='$repeatpass' where id = '$id'";
        }
    }
}


