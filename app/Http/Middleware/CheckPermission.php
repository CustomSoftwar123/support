<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use DB;
use Illuminate\Http\Request;
use \App\Http\Controllers\users;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
       
        $moduleName = '';

           
        //Business Profile

       if(request()->is('Business')) {

            $moduleName = 'Business Profile';
            if(users::roleCheck($moduleName,'View')[0]->value == 'No') {

            abort(404);
       
            } 
         }   

        if(request()->is('updateBusinessInfo') || request()->is('updateBusinessAddress')) 

            if(users::roleCheck('Business Profile','Update')[0]->value == 'No') {

            abort(404);
       
            }
       
        //Patients
            
        if(request()->is('Patients')) 

            if(users::roleCheck('Patients','View')[0]->value == 'No') {

            abort(404);
       
        } 

        
        //Panels
        
        if(request()->is('Panels')) {

            $moduleName = 'Panels';
            if(users::roleCheck($moduleName,'View')[0]->value == 'No') {

            abort(404);
       
            } 
          }

        if(request()->is('addPanel')) 

            if(users::roleCheck('Panels','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updatePanel')) 

            if(users::roleCheck('Panels','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deletePanel')) 

            if(users::roleCheck('Panels','Delete')[0]->value == 'No') {

            abort(404);
       
        }


        //Profiles 

        if(request()->is('Profiles')) 

            if(users::roleCheck('Profiles','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addProfile')) 

            if(users::roleCheck('Profiles','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateProfile')) 

            if(users::roleCheck('Profiles','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteProfile')) 

            if(users::roleCheck('Profiles','Delete')[0]->value == 'No') {

            abort(404);
       
        }


        //Mapping Panels with Profiles

        if(request()->is('MappingPanels')) 

            if(users::roleCheck('Panels Mapping','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addMappingPanel')) 

            if(users::roleCheck('Panels Mapping','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteMappingPanel')) 

            if(users::roleCheck('Panels Mapping','Update')[0]->value == 'No') {

            abort(404);
       
        }



        //Tests 

        if(request()->is('MTests')) 

            if(users::roleCheck('Tests','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addTest')) 

            if(users::roleCheck('Tests','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateTest')) 

            if(users::roleCheck('Tests','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteTest')) 

            if(users::roleCheck('Tests','Delete')[0]->value == 'No') {

            abort(404);
       
        }


        
        //Mapping Profiles with Tests

        if(request()->is('Mapping')) 

            if(users::roleCheck('Profile / Test Mapping','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addMapping')) 

            if(users::roleCheck('Profile / Test Mapping','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteMapping')) 

            if(users::roleCheck('Profile / Test Mapping','Update')[0]->value == 'No') {

            abort(404);
       
        }




        //Reflex Testing

        if(request()->is('ReflexTesting')) 

            if(users::roleCheck('Reflex Testing','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addReflexTesting')) 

            if(users::roleCheck('Reflex Testing','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteReflexTesting')) 

            if(users::roleCheck('Reflex Testing','Update')[0]->value == 'No') {

            abort(404);
       
        }




        //Questions 

        if(request()->is('Questions')) 

            if(users::roleCheck('Profile Questions','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addQuestion')) 

            if(users::roleCheck('Profile Questions','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateQuestion')) 

            if(users::roleCheck('Profile Questions','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteQuestion')) 

            if(users::roleCheck('Profile Questions','Delete')[0]->value == 'No') {

            abort(404);
       
        } 


        //Profile Question Answers 

        if(request()->is('Profiles/Profile Question Answers')) 

            if(users::roleCheck('Profile Question Answers','View')[0]->value == 'No') {

            abort(404);
       
        }



        



        //SampleContainers 

        if(request()->is('SampleContainers')) 

            if(users::roleCheck('Sample Containers','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addSampleContainer')) 

            if(users::roleCheck('Sample Containers','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateSampleContainer')) 

            if(users::roleCheck('Sample Containers','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteSampleContainer')) 

            if(users::roleCheck('Sample Containers','Delete')[0]->value == 'No') {

            abort(404);
       
        }



        //Facilities 

        if(request()->is('Facilities')) 

            if(users::roleCheck('Facilities','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addFacility')) 

            if(users::roleCheck('Facilities','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateFacility')) 

            if(users::roleCheck('Facilities','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteFacility')) 

            if(users::roleCheck('Facilities','Delete')[0]->value == 'No') {

            abort(404);
       
        } 




        //Files 

        if(request()->is('Files')) 

            if(users::roleCheck('Documents Uploading','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addFile')) 

            if(users::roleCheck('Documents Uploading','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateFile')) 

            if(users::roleCheck('Documents Uploading','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteFile')) 

            if(users::roleCheck('Documents Uploading','Delete')[0]->value == 'No') {

            abort(404);
       
        } 


        //Activity Logs 

        if(request()->is('activitylogs')) 

            if(users::roleCheck('Activity Logs','View')[0]->value == 'No') {

            abort(404);
       
        }



        //Files 

        if(request()->is('Users')) 

            if(users::roleCheck('Users','View')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('addUser')) 

            if(users::roleCheck('Users','Add')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('updateUser')) 

            if(users::roleCheck('Users','Update')[0]->value == 'No') {

            abort(404);
       
        }

        if(request()->is('deleteUser')) 

            if(users::roleCheck('Users','Delete')[0]->value == 'No') {

            abort(404);
       
        } 


        if(count(users::roleCheck($moduleName,'Add')) > 0) { 
            $Add = users::roleCheck($moduleName,'Add')[0]->value; } else { $Add = '';
        }

         if(count(users::roleCheck($moduleName,'View')) > 0) { 
            $View = users::roleCheck($moduleName,'View')[0]->value; } else { $View = '';
        }

         if(count(users::roleCheck($moduleName,'Update')) > 0) { 
            $Update = users::roleCheck($moduleName,'Update')[0]->value; } else { $Update = '';
        }

         if(count(users::roleCheck($moduleName,'Delete')) > 0) { 
            $Delete = users::roleCheck($moduleName,'Delete')[0]->value; } else { $Delete = '';
        }


         $response = [ 'Add' => $Add, 'View' => $View, 'Update' => $Update, 'Delete' => $Delete]; 
         view()->share('response', $response);




        return $next($request);
    }
}
