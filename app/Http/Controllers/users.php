<?php
  
namespace App\Http\Controllers;

use App;  
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Validator;
use DB;
use Auth;
use csvToArray;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class users extends Controller
{

    public function getUserTheme(Request $request)
    {
            $email = $request->email;
            $userInfo = DB::table('users')->select('colorscheme','font','font_link','font_weight')->where('email', $email)->get();
                
             if(count($userInfo) > 0) {

                 return response()->json(['success'=>'UserInfo.','data' => $userInfo]); 
             }   

           
        return response()->json(['error'=>'']);
    }

    public function getSignupTheme(Request $request)
    {
            $email = $request->email;
            $userInfo = DB::table('users')->select('colorscheme','font','font_link','font_weight')->where('role', 0)->get();
                
             if(count($userInfo) > 0) {

                 return response()->json(['success'=>'UserInfo.','data' => $userInfo]); 
             }   

           
        return response()->json(['error'=>'']);
    }


    public function login()
    {
         $users = DB::table('users')->select('email')->get(); 
         
          return view ('login')->with('data',$users);
          
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //      $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);
     
    //     if ($validator->passes()) {


    //         $users = DB::table('users')->select('new')->where('email',$request->email)->get();

    //         if (Auth::attempt($credentials)) {

    //                 $controller = App::make('\App\Http\Controllers\activitylogs');

    //                 $data = $controller->callAction('addLogs', [0,0,0,0,0,'Login','User logged into the System.']);
                    
    //                 return response()->json(['success'=>'Logging you in.', 'new' => $users[0]->new]);

    //             } else {
    //                 return response()->json(['error'=>'Email or Password is incorrect']);
    //             }

    //    } 
    //    else {

    //     return response()->json(['error'=>$validator->errors()->first()]);
       
    //    }
       
    // }

     public  static function roleCheck()
    {   
    

    $user = auth()->user();
    if($user->role==1||$user->role==4){
        return 'yes';
    }  else{
        return 'no';
    }
  

    }


     public function index(Request $request)
    {
         if(\App\Http\Controllers\users::roleCheck() == 'no')   
                    { return redirect('/home');} 

    if ($request->ajax()) {

        $user=auth()->user();
        $r=$user->role;
        $cl=$user->client;
     if($r==4){
       
        $data = DB::table('users')
        ->select([
            'users.id',
            'users.name',
            'users.email',
            'users.zip',
            'users.phone',
            'lists.Text as roles',
            'users.country',
            'users.status',
            'users.created_at',
            'users.updated_at',
            'users.created_by',
            'users.updated_by',
            'A.name as created_by_name',
            'B.name as updated_by_name'
        ])
        ->where('users.client', $cl)
        ->leftJoin('lists', 'lists.id', '=', 'users.role')
        ->leftJoin('users AS A', 'A.id', '=', 'users.created_by')
        ->leftJoin('users AS B', 'B.id', '=', 'users.updated_by');
     }
     else{

        $data = DB::table('users')->select(
            'users.id', 
            'users.name', 
            'users.email', 
            'users.zip',
            'users.phone', 
            'users.country',
            'users.status',  
            'users.created_at', 
            'users.updated_at',
            'users.created_by', 
            'users.updated_by',
            'A.name as created_by',
            'B.name as updated_by'
            )
            ->where('users.client',$cl)
            ->leftjoin('lists', 'lists.id', '=', 'users.role')
            ->leftjoin('users AS A', 'A.id', '=', 'users.created_by')
            ->leftjoin('users AS B', 'B.id', '=', 'users.updated_by')
            ->whereIn('users.role',[0,1,2,3]);

     }
        return Datatables::of($data)
    
                ->addIndexColumn()
                ->addColumn('action', function($row){
    
                       $btn = '
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="User/'.$row->id.'" title="Edit User" class="btn btn-primary update">
                             <i class="bx bx-edit"></i>
                            </a>
                            <button type="button" class="delete btn btn-dark"><i class="bx bx-x-circle"></i>
                            </button>
                             </div>
                              ';
    
                        return $btn;
                })
                 ->editColumn('created_at', function ($request) {
                   $current = Carbon::now();
                    //return $request->created_at->format('Y-m-d H:i:s') ; // human readable format
                  })
    
                 ->editColumn('updated_at', function($data){ 
                    if($data->updated_at != '') {
    
                        $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d M Y H:i a'); 
                        return $updated_at;
                        
                    }
                 })
    
                ->setRowId('id')
                ->rawColumns(['action'])
                ->make(true);
              
    }


        return view ('users');
        
    }


     public function User(Request $request)
    {
        $user=[];
        if($request->id != '') {

            $user = DB::table('users')->where('id', $request->id)->get();
            $co=count($user);


            $editmode = 'on';
           if($co==0){
    return redirect('home');
}          

              if($user[0]->client!=Auth()->user()->client){

                return redirect('home');
            }
                            
   
          } 
        // else {
   
          
        //               return redirect('/home');
        //   }
        
        // $user = '';
        $editmode = 'off';


        $countries = DB::table('lists')->select('Text')->where('ListType', 'Countries')->where('InUse', 1)->groupBy('Text')->orderBy('Text')->get();
        $counties = DB::table('lists')->select('Text')->where('ListType', 'Counties')->where('InUse', 1)->orderBy('Text')->get();
        $towns = DB::table('lists')->select('Text')->where('ListType', 'Towns')->where('InUse', 1)->orderBy('Text')->get();
        $roles = DB::table('lists')->where('ListType', 'ROL')->where('InUse', 1)->whereNotIn('id',[4,5,6,7])
        ->orderBy('Text')->get();
        
        $roles2 = DB::table('lists')->where('ListType', 'ROL')->where('InUse', 1)
        ->whereIn('id',[4,5,6,7])
        ->orWhere('check',1)
        ->orderBy('Text')->get();
                                                     


            
          $data = [
                    'editmode' => $editmode,
                    'user' => $user,
                    'roles' => $roles,
                    'roles2' => $roles2,
                    'countries' => $countries,
                    'counties' => $counties,
                    'towns' => $towns
          ];  

          return view ('user')->with('data',$data);
    }  
 


     public function add(Request $request)
    {   


        $uid = DB::table('users')->max('id')+1;
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $zip = $request->input('zip');
        $address = $request->input('address');
        $role = $request->input('role');
        $status = $request->input('InUse');
        $supportfordays = '';
        // $supportfordays = implode(",", $supportfordays);

        $user = auth()->user();
        $client=$user->client;
        

        $validator = Validator::make($request->all(), [
            'name' => 'required',      
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'InUse' => 'required'
        ]);
     

     if ($validator->passes()) {

        $dif = DB::table('users')->where('id',1)->get();
        DB::insert('insert into users (id,client, name, phone, email, password, role, status, address, city, state, country, zip, file, created_at, created_by, colorscheme, font, font_link,font_weight, resolution, supportfordays) values (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)', 
            
            [$uid,$client, $name, $phone, $email, Hash::make($password), $role, $status, $address, $city, $state, $country, $zip, 'default.jpg', date('Y-m-d H:i:s'),  $user['id'],

                 $dif[0]->colorscheme,
                 $dif[0]->font,
                 $dif[0]->font_link,
                 $dif[0]->font_weight,
                 $dif[0]->resolution,
                 $supportfordays

            ]);      

        

            return response()->json(['success'=>'User added.']);




        }
        
        return response()->json(['error'=>$validator->errors()->first()]);

    }



     public function update(Request $request)
    {
        $uid = $request->input('uid');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $zip = $request->input('zip');
        $address = $request->input('address');
        $role = $request->input('role');
        $status = $request->input('InUse');
        $supportfordays = $request->input('supportfordays');
        $supportfordays = implode(",", $supportfordays);

        $user = auth()->user();
        

        $validator = Validator::make($request->all(), [
            'name' => 'required',      
            'email'=> 'required|unique:users,email,'.$uid,  
            'password' => 'nullable|min:6',
            'role' => 'required',
            'InUse' => 'required',
        ]);
     

     if ($validator->passes()) {

      
        DB::update("
            update users 
            set 
            name = '$name', email = '$email' , phone = '$phone' , role = '$role',  status = '$status', address = '$address', city = '$city', state = '$state', country = '$country', zip = '$zip', updated_at = '".date('Y-m-d H:i:s')."' , updated_by = '".$user['id']."', supportfordays = '$supportfordays'
            where id =  $uid 
            ");  

            if($password != '') {

              DB::update("update users set password = '".Hash::make($password)."'  where id =  $uid "); 
              
            }

    

            return response()->json(['success'=>'User updated.']);

        }
        
        return response()->json(['error'=>$validator->errors()->first()]);

    }


    public function delete(Request $request)
    {
     $id = $request->input('id');   


     DB::table('users')->where('id', $id)->delete();

    }


    public static function headerrole(){
        
        $role = auth()->user()->role; 
  $role = DB::table('lists')->select('Text as name')->where('id', $role)->get();

        return $role[0]->name;
    }
      public function  profile()
    {   
         $user = auth()->user(); 
         $role = auth()->user()->role; 
         $role = DB::table('lists')->select('Text as name')->where('id', $role)->get();
         $profile = DB::table('users')->select('country','state','city','new')->where('id', $user->id)->get();
         $countries = DB::table('lists')->select('Text')->where('ListType', 'Countries')->where('InUse', 1)->orderBy('Text')->get();
         $counties = DB::table('lists')->select('Text')->where('ListType', 'Counties')->where('InUse', 1)->orderBy('Text')->get();
         $towns = DB::table('lists')->select('Text')->where('ListType', 'Towns')->where('InUse', 1)->orderBy('Text')->get();


          $data = [

                    'role' => $role,
                    'profile' => $profile,
                    'countries' => $countries,
                    'counties' => $counties,
                    'towns' => $towns
          ];



        return view ('profile')->with('data',$data);
    }

      
  public function updateMyProfile(Request $request)
    {  
        //  return $request;
        $id = auth()->user()->id;   
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $destinationPath = public_path('images');
        $file = $request->file('file');
        // $city = $request->input('city');
        $city = $request->input('town');

        $state = $request->input('state');
        $country = $request->input('country');
        $zip = $request->input('zip');

        if($file != '') {

         $extension = $request->file->getClientOriginalExtension();
         
             
        if($request->file('file')->getSize() > 4000000) {

            return response()->json(['error'=> 'Image size should be less than 4mb']);
     
        }
        

       
        $filename = uniqid().'.'.$extension;
        $file->move($destinationPath,$filename);
        $filename = ", file = '$filename'";
        } else {
            $filename = '';
        }  
        


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
           
        ]);
     
        if ($validator->passes()) {
            
        DB::update("
            update users 
            set 
            name = '$name', email = '$email' , phone = '$phone' , address = '$address', city = '$city', state  = '$state', country = '$country', zip = '$zip' $filename 
            where id =  $id 
            ");



            return response()->json(['success'=>'Info updated.']);
            

        }
        
        return response()->json(['error'=>$validator->errors()->first()]);
    }

    public function addRole(Request $request)
    {if($request->ajax()){
        // return $request;

        $code=$request->code;
        $text=$request->name;
        DB::insert("insert into `lists`(`Code`,`Text`,`check`,`InUse`,`ListType`)values('$code','$text',1,1,'ROL')");
       
    }
    return view('addrole');
}

      public function updateUserPassword(Request $request)
    {
        $id = auth()->user()->id;   
        $current_password = $request->input('current_password');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|password',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
     
        if ($validator->passes()) {
        
        $password = Hash::make($password);    
        DB::update("update users 
            set 
            password = '$password',
            new = 0 where id =  $id ");

            // get current user
            $user = Auth::user();

            // logout user
            $userToLogout = User::find($id);
            Auth::setUser($userToLogout);
            Auth::logout();

            // set again current user
            Auth::setUser($user);



            return response()->json(['success'=>'Password updated.']);
            
        }
        
        return response()->json(['error'=>$validator->errors()->first()]);
    }

     public function UploadUsers(Request $request)
    {

        return view ('uploadusers');
    }

      public function syncUsersData(Request $request)
    {

        $user = auth()->user();
        $tempusers = DB::table('tempusers')->get();

        foreach($tempusers as $tempuser) {


           $users = DB::table('users')->where('email',$tempuser->email)->get();

           if(count($users) > 0) {


            DB::update("
            update users 
            set 
            name = '$tempuser->name' , phone = '$tempuser->phone' , address = '$tempuser->address', city = '$tempuser->city', state  = '$tempuser->state', country = '$tempuser->country', zip = '$tempuser->zip' , updated_at = '".date('Y-m-d H:i:s')."' , updated_by = '".$user['id']."' 
            where email =  '".$tempuser->email."' 
            ");

           } else {

             DB::insert('insert into users (name, email, password, role, department, subdepartment, phone, address, city, state, country, zip, file, created_at, created_by) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            
            [$tempuser->name, $tempuser->email, $tempuser->password, $tempuser->role, $tempuser->department, $tempuser->subdepartment, $tempuser->phone, $tempuser->address, $tempuser->city, $tempuser->state, $tempuser->country, $tempuser->zip, 'default.jpg', date('Y-m-d H:i:s'),  $user['id'] ]);   

           }

        }

         return response()->json(['success'=>'Users info updated.' ]);

    }

    function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
}



    public function UploadUsersDataFile(Request $request)
    {

        // DB::table('tempusers')->delete();
    

     $path = $request->file('file');
     $ext=$path->getClientOriginalExtension();

     $uid=uniqid();
     $path2=public_path();

     $path->move($path2, $uid.'.'.$ext);

     $assignpath=$path2.'\\'.$uid.'.'.$ext;
     $data=[];

    $file = public_path($uid.'.'.$ext);

    $customerArr = $this->csvToArray($file);

   foreach($customerArr as $customerArrs){

      // $address= $customerArrs['address'];
      // $api_token= $customerArrs['api_token'];
      // $city= $customerArrs['city'];
      // $colorscheme= $customerArrs['colorscheme'];
      $country= $customerArrs['Country'];
      $created_at= $customerArrs['Created'];
      $created_by= $customerArrs['Created By'];
      // $department= $customerArrs['department'];
      $email= $customerArrs['E-Mail'];
      // $email_verified_at= $customerArrs['email_verified_at'];
      // $file= $customerArrs['file'];
      // $flag= $customerArrs['flag'];
      // $font= $customerArrs['font'];
      // $font_link= $customerArrs['font_link'];
      // $font_weight= $customerArrs['font_weight'];
      $name= $customerArrs['Name'];
      // $new= $customerArrs['new'];
      $password= $customerArrs['Password'];
      // $pexpiry= $customerArrs['pexpiry'];
      $phone= $customerArrs['Phone'];
      // $remember_token= $customerArrs['remember_token'];
      // $resolution= $customerArrs['resolution'];
      // $role= $customerArrs['role'];
      // $state= $customerArrs['state'];
      $status= $customerArrs['Status'];
      // $subdepartment= $customerArrs['subdepartment'];
      $updated_at= $customerArrs['Updated'];
      $updated_by= $customerArrs['Updated By'];
      // $userinfo= $customerArrs['userinfo'];
      // $zip= $customerArrs['zip'];

      $checkdata=DB::table('users')->where('email',$email)->get();

      if(count($checkdata) < 1){

   

// if(strpos("'",$name) !== false){

  $name=str_replace("'","\'",$name);

// }

         // DB::insert("insert into users(name,email,password,role,department,subdepartment,status,phone,address,city,state,country,zip,file,created_at,created_by,updated_by,updated_at,remember_token,api_token,email_verified_at,new,colorscheme,font,font_link,font_weight,resolution,client) values ('$name','$email','$password','5','$department','$subdepartment','$status','$phone','$address','$city','$state','$country','$zip','$file','$created_at','$created_by','$updated_by','$updated_at','$remember_token','$api_token','$email_verified_at','$new','$colorscheme','$font','$font_link','$font_weight','$resolution','CAVAN')");

    
        DB::insert("insert into users(name,email,password,role,status,phone,country,created_at,created_by,updated_by,updated_at,client,colorscheme) values ('$name','$email','$password','5','$status','$phone','$country','$created_at','$created_by','$updated_by','$updated_at','CAVAN','1976D2')");



      }

    


   }



  


    
    return response()->json(['success'=>'File uploaded.']);
    
        // return response()->json(['success'=>'File uploaded.','products'=> $counter, 'tproducts'=> $counter+$new ]);
    }



     
public function signup(){


    $countries = DB::table('lists')->select('Text')->where('ListType', 'Countries')->where('InUse', 1)->groupBy('Text')->orderBy('Text')->get();
    $counties = DB::table('lists')->select('Text')->where('ListType', 'Counties')->where('InUse', 1)->orderBy('Text')->get();
    $towns = DB::table('lists')->select('Text')->where('ListType', 'Towns')->where('InUse', 1)->orderBy('Text')->get();

    $data = [


        'countries' => $countries,
        'counties' => $counties,
        'towns' => $towns
];  

return view ('signup')->with('data',$data);
}
 
public function registerUser(Request $request){
    echo'value Posted';
$role=1;
$status="Pending";


    $request->validate([
'name'=>'required',


'address'=>'required',
'city'=>'required',
'email'=>'required|email|unique:users',
'phone'=>'required',
'state'=>'required',
'country'=>'required',
'zip'=>'required',

'password'=>'required|min:8|max:30',
''
    ]);
    $user=new User();
    $user->name=$request->name;
    $user->address=$request->address;
    $user->city=$request->city;
    $user->email=$request->email;
    $user->phone=$request->phone;
    $user->state=$request->state;
    $user->country=$request->country;
    $user->zip=$request->zip;
    
    $user->password=bcrypt($request->password);
    $user->role=$role;
    $user->status=$status;
    $res = $user->save();
if($res){
    return back()->with('success','Registered');
}
else{
    
    return back()->with('failed','Not Registered');
}

        }



 
    

}