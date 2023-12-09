@include('layouts.header')


<style type="text/css">
    .Demographics p {
        line-height: 1.5;
        margin: 0;
    }
</style>
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Request # {{$data['OCMRequest'][0]->ReqestID}}
 <a class="btn btn-info btn-sm" href="{{route('Requests')}}/All"><i class="fas fa-arrow-left"></i> GO BACK </a>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Business Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


        <div class="row">


                    <div class="col-md-12">   
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile" style="min-height:90vh;">

                            
                                <div class="row">
                                        <div class="col-md-6">
                                        <h3>
                                        Patient Demographics</h3>
                                        <div class="well Demographics">
                                                
                                                <p>Patient : {{$data['OCMRequest'][0]->PatName}} ({{$data['OCMRequest'][0]->Sex}}) </p>
                                                <p>MRN #  {{$data['OCMRequest'][0]->Chart}} </p>
                                                <p>Date of Birth : 
                                                    <?php 
                                                    if($data['OCMRequest'][0]->DoB != '') {

                                                echo \App\Http\Controllers\Controller::Date(
                                                            $data['OCMRequest'][0]->DoB
                                                        );
                                                    }
                                                    ?>
                                                     </p>
                                                <p>Address : {{$data['OCMRequest'][0]->Address0}} </p>
                                                <p>Clinician : {{$data['OCMRequest'][0]->Clinician}} </p>

                                                  <p>Location : 
                                                <?php 

                                         if($data['OCMRequest'][0]->Ward != null) { 

                                                                if($data['OCMRequest'][0]->bed != null) {
                                                                
                                                                echo $data['OCMRequest'][0]->Ward.' - Bed '. $data['OCMRequest'][0]->bed;

                                                                } else {
                                                                
                                                                 echo $data['OCMRequest'][0]->Ward;

                                                                }

                                                                } else {

                                                                if(response.OCMRequest[0].bed != null) {
                                                                
                                                                 echo $data['OCMRequest'][0]->clinic.' - Bed '. $data['OCMRequest'][0]->bed;

                                                                } else {
                                                                
                                                                 echo $data['OCMRequest'][0]->clinic;

                                                                }
                                                                }

                                                                ?>
                                                     </p>  



                                        </div>
                                        </div>


                                        <?php  if(request()->segment(1) == 'viewBTRequest') { ?> 



                                            <div class="col-md-6">
                                        <h3>Requested Profiles 

                                <button data2='bt' data='0' id="{{$data['results'][0]->PhlebotomySampleID}}" class="btn btn-success btn-xs float-right viewResult ml-1">View Report </button>


                                    <button class="btn btn-primary btn-xs float-right" id="requestDetails">Request Details</button>

                                        </h3>
                                         <table id="table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="p-2">Profile</th>
                                                    <th class="p-2 text-left">Date Time</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($data['ocmrequestdetailsBT'] as $ocmrequestdetailBT)
                                            <tr>
                                                <td class="text-left">
                                                    {{$ocmrequestdetailBT->name}}
                                                    <?php 
                                                    if($ocmrequestdetailBT->TestDescription != '') {

                                                        echo '<br/><small><b>'.$ocmrequestdetailBT->TestDescription.'<b></small>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-left">
                                                <?php

                                               echo \App\Http\Controllers\Controller::DateTime(
                                                            $ocmrequestdetailBT->ExecutionDateTime
                                                        );
                                
                                                ?>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>

                                         </table>
                                        </div>

                                        <?php } ?>


                                          <?php  if(request()->segment(1) == 'viewRequest') { ?> 


                                        <div class="col-md-2 offset-md-4">
                                            <button class="btn btn-primary btn-xs btn-block" id="requestDetails">Request Details</button>

                                             <button class="btn btn-warning btn-xs btn-block" id="requestComments">Comments</button>


                                             <a href="../../requestEpisode/{{$data['OCMRequest'][0]->ReqestID}}/{{$data['OCMRequest'][0]->RequestEpisodeID}}" class="btn btn-info  btn-xs btn-block">Add New Request</a>
                                              <a href="../../Request/{{$data['OCMRequest'][0]->ReqestID}}/{{$data['OCMRequest'][0]->RequestEpisodeID}}" class="btn btn-success btn-xs  btn-block">Request Addon</a>
                                               <button class="btn btn-danger btn-xs  btn-block notSignedBtn">View Not Signed</button>
                                        </div>



                                       

                                          <div class="col-md-12">
                                            <hr>  
                                            <ul class="nav nav-tabs">
                                          <li class="nav-item">
                                            <button id="viewAll" class="nav-link active" aria-current="page" >Departments (All)</button>
                                          </li>

                                          <?php if(count($data['departments']) > 0) { ?>
                                          @foreach ($data['departments'] as $department)
                                          <li class="nav-item">
                                            <a class="nav-link filterDepartment" href="#" id="{{$department}}">{{$department}}</a>
                                          </li>
                                          @endforeach
                                         <?php  } elseif(count($data['requestedDepartments']) > 0) { ?> 
                                        @foreach ($data['requestedDepartments'] as $requestedDepartment)
                                          <li class="nav-item">
                                            <a class="nav-link filterDepartment" href="#" id="{{$requestedDepartment}}">{{$requestedDepartment}}</a>
                                          </li>
                                        @endforeach
                                           <?php } ?>
                                         
                                        </ul>

                                        <div id="agreement"> 
                                        <form id="form">
                                        <table id="table" class="table table-striped">
                                           
                                             <?php if(count($data['results']) > 0) { ?>

                                            <thead>
                                                <tr>
                                                    <th class="p-2"></th>
                                                    <th class="p-2">Dept</th>
                                                    <th class="p-2">Sample #</th>
                                                    <th class="p-2">Date/time</th>
                                                    <th class="p-2">Profile</th>
                                                    <th class="p-2">Test</th>
                                                    <th class="p-2">Results </th>
                                                    <th class="p-2">Units</th>
                                                    <th class="p-2">Norm Range</th>
                                                    <th class="p-2">Flags</th>
                                                    <th class="p-2">Comments</th>
                                                    <th class="p-2">Signed By</th>
                                                    <th class="p-2">Date time Signed</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                
                                                @foreach ($data['results'] as $key => $BioResult)
                                                 
                                                   

                                                    <?php 


                                                    $result = $BioResult->result;

                                                    $result = str_replace(' ','',$result);


                                               if($BioResult->test == 'Full Blood Count' && $data['fbcresults'] > 0)  { ?>


                                                        <tr class="rowHide">


                                                   <?php    } else {
                                             
                                                       if($BioResult->SignOffBy == '') { ?>

                                                            <tr class="<?php if($BioResult->department == 'Haematology' && $result == '' && $BioResult->test != 'Full Blood Count') { echo 'rowHide'; } ?> notSigned <?=$BioResult->department;?>">
                                                       
                                                         <?php  } else { ?>

                                                             <tr class="<?php if($BioResult->department == 'Haematology' && $result == '' && $BioResult->test != 'Full Blood Count') { echo 'rowHide'; } ?>  Signed <?=$BioResult->department;?>">
                                                         <?php  }

                                                                }
                                                        ?>   

                                                        <td  class="p-2">
                                                     
                                                            <input type="checkbox" 

                                                            <?php 

                                                                if($BioResult->SignOffDateTime != '') {

                                                                    echo 'disabled';
                                                                } 
                                                                if($BioResult->result == '' || $BioResult->result == null) {

                                                                    echo 'disabled';
                                                                } 
                                                            ?>

                                                            <?php 

                                                                if($BioResult->SignOffDateTime == '') {

                                                                    
                                                                   if($BioResult->result == '' || $BioResult->result == null) {

                                                                             echo '';
                                                                    }else {

                                                                        echo 'checked';
                                                                    } 

                                                                }
                                                          
                                                            ?>

                                                             class="signoff" name="signoff[]" id="{{$BioResult->Code}}" value="1">
                                                            
                                                        </td>
                                                        <td  class="p-2">{{$BioResult->department}}</td>
                                                        <td  class="p-2" id="{{$BioResult->PhlebotomySampleID}}" data="{{$BioResult->department}}">
                                                                
                                                                <?php 

                                                                if($BioResult->department == 'Microbiology') {


                                                                     echo '<b data="'.$BioResult->external.'" style="cursor:pointer;" class="text-success viewResult" id="'.$BioResult->PhlebotomySampleID.'">'.$BioResult->PhlebotomySampleID.'</b>';


                                                                } else {

                                                                if($BioResult->SignOff > 1) {

                                                                    echo '<b data="'.$BioResult->external.'" style="cursor:pointer;"  class="text-red viewResult" id="'.$BioResult->PhlebotomySampleID.'">'.$BioResult->PhlebotomySampleID.'</b>';
                                                                } 
                                                                else {

                                                   

                                                                     echo '<b data="'.$BioResult->external.'" style="cursor:pointer;"  class="text-dark viewResult" id="'.$BioResult->PhlebotomySampleID.'">'.$BioResult->PhlebotomySampleID.'</b>';
                                                                }
                                                                }
                                                                ?>

                                                        </td>
                                                        <td  class="p-2">
                                                               
                                                               <?php 
                                                                if($BioResult->RunTime != '' || $BioResult->RunTime != null) {

                                                                     echo \App\Http\Controllers\Controller::DateTime(
                                                                            $BioResult->RunTime
                                                                        );

                                                                }
                                                                ?>


                                                            
                                                              </td>
                                                        <td  class="p-2">
                                                            {{$data['testsInfo'][$key]}}
                                                        </td>
                                                        <td  class="p-2">{{$BioResult->test}}</td>
                                                        <td  class="p-2"><?php 
                                                           

                                                                if($BioResult->RunTime == '' || $BioResult->RunTime == null) {

                                                                if($BioResult->test == 'Full Blood Count' && $BioResult->RunTime == '' || $BioResult->RunTime == null) {

                                                                    echo '<span class="text-danger"></span>';

                                                                } else {

                                                                    echo '<span class="text-danger"></span>';

                                                                }
                                                            
                                                            }
                                                            
                                                            else {

                                                                echo $BioResult->result;
                                                            }

                                                            if($BioResult->department == 'Microbiology') {
                                                             if(\App\Http\Controllers\requests::checkResult($BioResult->PhlebotomySampleID) == 1) {


                                                                    echo '<b  id="'.$BioResult->PhlebotomySampleID.'" class="btn btn-success text-white viewResult">View Results</b>';
                                                             }
                                                         }
                                                        ?>
                                                         
                                                         
                                                        


                                                        </td>
                                                        
                                                        <td  class="p-2">

                                                            <?php 
                                                           
                                                            if($BioResult->Units == '') {

                                                                echo '-';
                                                            }
                                                            else {

                                                                echo $BioResult->Units;
                                                            }

                                                            ?>
                                                            
                                                        </td>

                                                        <td  class="p-2">{{$BioResult->NormalLow}}-{{$BioResult->NormalHigh}}</td>

                                                        <td  class="p-2"><?php 
                                                            if($BioResult->Flags == '') {

                                                                echo '-';

                                                             }else {

                                                                
                                                                if($BioResult->result != '' || $BioResult->result != null) {

                                                                if($BioResult->Flags == 'H') {

                                                                        echo '<b class="btn btn-danger btn-block btn-xs">'.$BioResult->Flags.'</b>';
                                                                } 
                                                                elseif($BioResult->Flags == 'L') { 

                                                                    echo '<b class="btn btn-info btn-block btn-xs">'.$BioResult->Flags.'</b>';
                                                                }
                                                                else {

                                                                    echo 'xxxx';
                                                                } 

                                                                 }
                                                                else {

                                                                    echo 'xxxx';
                                                                }
                                                            }
                                                        ?></td>

                                                        <td  class="p-2"><?php 
                                                         

                                                                if($BioResult->netComments == '') {

                                                                    ?>
                                                                    <button disabled class="btn btn-secondary btn-sm"><i class="fas fa-notes-medical"></i></button>
                                                                    <?php
                                                                } 
                                                                else {

                                                                    ?>
                                                                    <button type="button" data="{{$BioResult->netComments;}}" class="btn btn-info btn-sm btnComments"><i class="fas fa-notes-medical"></i></button>
                                                                    <?php
                                                                    
                                                                }
                                                            
                                                        ?></td>
                                                        
                                                        <td  class="p-2">
                                                            <?php 
                                                                if($BioResult->SignOffBy == '') {

                                                                    echo '-';

                                                                 } else {

                                                                    echo $BioResult->SignOffBy;

                                                                 }
                                                                ?></td>
                                                        <td  class="p-2">

                                                            <?php 
                                                                if($BioResult->SignOffDateTime != '' || $BioResult->SignOffDateTime != null) {

                                                                      echo \App\Http\Controllers\Controller::DateTime(
                                                                            $BioResult->SignOffDateTime
                                                                        );

                                                                }
                                                                ?>


                                                            </td>


                                                
                                                    </tr>
                                                    
                                      
                                                @endforeach

                                            <?php } else {  ?> 


                                                <thead>
                                                <tr>
                              
                                                    <th class="p-2">Dept</th>
                                                    <th class="p-2">Sample #</th>
                                                    <th class="p-2">Date/time</th>
                                                    <th class="p-2">Profile</th>
                                                    <th class="p-2">Test</th>
                                                    <th class="p-2">Results </th>
                                                    <th class="p-2">Units</th>
                                                    <th class="p-2">Norm Range</th>
                                                    <th class="p-2">Flags</th>
                                                    <th class="p-2">Comments</th>
                                                    <th class="p-2">Signed By</th>
                                                    <th class="p-2">Date time Signed</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                
                                                @foreach ($data['requested'] as $key => $BioResult)
                                                <tr class="{{$BioResult->department}}">
                                                    <td>{{$BioResult->department}}</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-left">{{$BioResult->profile}}</td>
                                                    <td class="text-left">{{$BioResult->test}}</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>

                                                </tr>
                                                @endforeach
                                                 
                                                   

                                            


                                            <?php  } ?>


                                            </tbody>



                         

                                        </table>
                                        </form>   
                                        </div>

                                        </div>


                                         <div class="col-md-12 mt-3">
                                             
                                             <a href="../../downloadReuqest/{{$data['OCMRequest'][0]->ReqestID}}/{{$data['OCMRequest'][0]->RequestEpisodeID}}" class="btn btn-success btn-xs ">
                                             Download Report</a>
                                             <button class="btn btn-danger btn-xs message">Message </button>
                                             
                                              @if((\App\Http\Controllers\users::roleCheck('SignOff','Add',0)) == 'Yes')  
                                             <button class="btn btn-dark btn-xs  signAll">Sign Results</button>
                                             @else
                                             <button class="btn btn-dark btn-xs" disabled>Sign Results</button>
                                             @endif
                                                
                                             
                                         </div>

                                           <?php } else { ?> 

                                                    <div class="col-md-6">
                                                        <hr/>
                                                         <h4 class="mt-3"><b>Transfusion Details</b></h4>

                                                         
                                                        <?php  if(count($data['patientdetails']) == 0) { ?>

                                                             <h5 class="mt-3">Pending Transfusion Details</h5>

                                                         <?php } else { ?>

                                                             <table class="table mt-3">
                                                                <tbody>
                                                                    
                                                                    <tr>
                                                                        <td>Sample #</td>
                                                                        <td>
                                                                            <input class="form-control text-center"  type="text" readonly value="{{$data['results'][0]->PhlebotomySampleID}}">
                                                                        </td>

                                                                        <td>Sample Date</td>
                                                                        <td>
                                                                            <input class="form-control text-center"  type="text" readonly value="<?php 
                                                                            if($data['patientdetails'][0]->SampleDate != '' || $data['patientdetails'][0]->SampleDate != null) {

                                                                                 echo \App\Http\Controllers\Controller::DateTime(
                                                                                        $data['patientdetails'][0]->SampleDate
                                                                                    );

                                                                            }
                                                                            ?>">
                                                                        </td>

                                                                    </tr>





                                                                    <tr>
                                                                        <td>Antibody Screen</td>
                                                                        <td colspan="3">
                                                                            <input class="form-control text-left" s type="text" readonly value="{{$data['patientdetails'][0]->AIDR}}">
                                                                        </td>
                                                                        </td>

                                                                    </tr>


                                                                     <tr>
                                                                        <td>Group</td>
                                                                        <td>
                                                                            <input class="form-control text-center" s type="text" readonly value="{{$data['patientdetails'][0]->fgroup}}">
                                                                        </td>

                                                                        <td>Kell</td>
                                                                        <td>
                                                                            <input class="form-control text-center"  type="text" readonly value="{{$data['patientdetails'][0]->Kell}}">
                                                                        </td>

                                                                    </tr>

                                                                    @if(count($data['kleihauer']) > 0)    
                                                                     <tr>
                                                                        <td>Kleihauer</td>
                                                                        
                                                                        <td>Number of Fetal Cells</td>
                                                                        <td colspan="2">
                                                                            
                                                                            <input class=" form-control text-center"  type="text" readonly value="{{$data['kleihauer'][0]->FetalCells}}">
                                                                        </td>

                                                                    </tr>


                                                                     <tr>
                                                                        <td style="border-top: 0px solid #dee2e6;"></td>
                                                                        
                                                                        <td style="border-top: 0px solid #dee2e6;">Patient RH Status</td>
                                                                        <td style="border-top: 0px solid #dee2e6;" colspan="2">
                                                                            
                                                                            <input class=" form-control text-center"  type="text" readonly value="{{$data['kleihauer'][0]->RH}}">
                                                                        </td>

                                                                    </tr>


                                                                      <tr>
                                                                        <td style="border-top: 0px solid #dee2e6;"></td>
                                                                        
                                                                        <td style="border-top: 0px solid #dee2e6;">Report</td>
                                                                        <td style="border-top: 0px solid #dee2e6;" colspan="2">
                                                                            
                                                                            <input class=" form-control text-center"  type="text" readonly value="{{$data['kleihauer'][0]->Report}}">
                                                                        </td>

                                                                    </tr>
                                                                    @endif
                                                                      


                                                                    <!-- <tr>
                                                                        <td>Comments</td>
                                                                        <td colspan="5">
                                                                            <textarea class="form-control" rows="4" readonly>{{$data['patientdetails'][0]->Comment}}</textarea>
                                                                        </td>
                                                                        </td>

                                                                    </tr> -->


                                                                     <tr>
                                                                        <td>Sample Comments</td>
                                                                        <td colspan="5">
                                                                            <textarea class="form-control" rows="4" readonly>{{$data['patientdetails'][0]->SampleComment}}</textarea>
                                                                        </td>
                                                                        </td>

                                                                    </tr>


                                                                     <tr>
                                                                        <td>Clinical Conditions</td>
                                                                        <td colspan="3">
                                                                             <textarea class="form-control" rows="4" readonly>{{$data['patientdetails'][0]->conditions}}</textarea>
                                                                        </td>

                                                                    </tr>

                                                                     <?php  if(count($data['externalnotes']) > 0) { ?>
                                                                    <tr>
                                                                        <td>Patient Notes</td>
                                                                        <td colspan="3">
                                                                             <textarea class="form-control" rows="4" readonly>{{$data['externalnotes'][0]->Notes}}</textarea>
                                                                        </td>
                                                                        </td>

                                                                    </tr>
                                                                            <?php } ?>


                                                                     <tr>
                                                                        <td>DCT</td>
                                                                        
                                                                        <td>AHG Poly Specific</td>
                                                                        <td colspan="2">
                                                                            <?php 

                                                                             $dat01 = '';  

                                                                             if($data['patientdetails'][0]->dat0 == 1) {

                                                                                 $dat01 = 'Pos+';   
                                                                                   
                                                                            }
                                                                            if($data['patientdetails'][0]->dat1 == 1) {

                                                                                  $dat01 = 'Neg-';    
                                                                            } 
                                                                            
                                                                            $class01 = '';

                                                                            if($dat01 == 'Neg-') {

                                                                                $class01 = 'bg-danger';

                                                                            } elseif($dat01 == 'Pos+') { 

                                                                                $class01 = 'bg-success';
                                                                            }

                                                                            ?>
                                                                            <input class="<?=$class01;?> form-control text-center"  type="text" readonly value="<?=$dat01;?>">
                                                                        </td>

                                                                    </tr>

                                                                      <tr>
                                                                        <td style="border-top: 0px solid #dee2e6;"></td>
                                                                        
                                                                        <td style="border-top: 0px solid #dee2e6;">Anti lgG</td>
                                                                         <td colspan="2" style="border-top: 0px solid #dee2e6;">
                                                                            <?php 

                                                                             $dat23 = '';  

                                                                            if($data['patientdetails'][0]->dat2 == 1) {

                                                                                 $dat23 = 'Pos+';   
                                                                                   
                                                                            }

                                                                            if($data['patientdetails'][0]->dat3 == 1) {

                                                                                  $dat23 = 'Neg-';    
                                                                            }

                                                                            
                                                                            $class23 = '';

                                                                            if($dat23 == 'Neg-') {

                                                                                $class23 = 'bg-danger';

                                                                            } elseif($dat23 == 'Pos+') { 

                                                                                $class23 = 'bg-success';
                                                                            }

                                                                            ?>
                                                                            <input class="<?=$class23;?> form-control text-center"  type="text" readonly value="<?=$dat23;?>">
                                                                        </td>

                                                                    </tr>


                                                                    <tr>
                                                                        <td style="border-top: 0px solid #dee2e6;"></td>
                                                                        
                                                                        <td style="border-top: 0px solid #dee2e6;">Anti lgA</td>
                                                                         
                                                                          <td colspan="2" style="border-top: 0px solid #dee2e6;">
                                                                            <?php 

                                                                             $dat45 = '';  

                                                                            if($data['patientdetails'][0]->dat4 == 1) {

                                                                                 $dat45 = 'Pos+';   
                                                                                   
                                                                            }

                                                                            if($data['patientdetails'][0]->dat5 == 1) {

                                                                                  $dat45 = 'Neg-';    
                                                                            }

                                                                            $class45 = '';

                                                                            if($dat45 == 'Neg-') {

                                                                                $class45 = 'bg-danger';

                                                                            } elseif($dat45 == 'Pos+')  {

                                                                                $class45 = 'bg-success';
                                                                            }

                                                                            ?>
                                                                            <input class="<?=$class45;?> form-control text-center"  type="text" readonly value="<?=$dat45;?>">
                                                                        </td>


                                                                    </tr>



                                                                    <tr>
                                                                        <td style="border-top: 0px solid #dee2e6;"></td>
                                                                        
                                                                        <td style="border-top: 0px solid #dee2e6;">Anti lgM</td>
                                                                        
                                                                         <td colspan="2" style="border-top: 0px solid #dee2e6;">
                                                                            <?php 

                                                                            $dat67 = ''; 

                                                                            if($data['patientdetails'][0]->dat6 == 1) {

                                                                                 $dat67 = 'Pos+';   
                                                                                   
                                                                            }
                                                                           
                                                                            if($data['patientdetails'][0]->dat7 == 1) {

                                                                                  $dat67 = 'Neg-';    
                                                                            }

                                                                            $class67 = '';

                                                                            if($dat67 == 'Neg-') {

                                                                                $class67 = 'bg-danger';

                                                                            } elseif($dat67 == 'Pos+') { 

                                                                                $class67 = 'bg-success';
                                                                            }

                                                                            ?>
                                                                            <input class="<?=$class67;?> form-control text-center"  type="text" readonly value="<?=$dat67;?>">
                                                                        </td>

                                                                    </tr>


                                                                    <tr>
                                                                        <td style="border-top: 0px solid #dee2e6;"></td>
                                                                        
                                                                        <td style="border-top: 0px solid #dee2e6;">Anti C3b,C3d</td>
                                                                         
                                                                          <td colspan="2" style="border-top: 0px solid #dee2e6;">
                                                                            <?php 

                                                                               $dat89 = '';  

                                                                            if($data['patientdetails'][0]->dat8 == 1) {

                                                                                 $dat89 = 'Pos+';   
                                                                                   
                                                                            }

                                                                            if($data['patientdetails'][0]->dat9 == 1) {

                                                                                  $dat89 = 'Neg-';    
                                                                            }
                                                                           
                                                                           $class89 = '';

                                                                            if($dat89 == 'Neg-') {

                                                                                $class89 = 'bg-danger';

                                                                            } elseif($dat89 == 'Pos+') { 

                                                                                $class89 = 'bg-success';
                                                                            }

                                                                            ?>
                                                                            <input class="<?=$class89;?> form-control text-center"  type="text" readonly value="<?=$dat89;?>">
                                                                        </td>

                                                                    </tr>










                                                            </tbody>
                                                             </table>

                                                         <?php } ?>  

                                                       


                                                    </div>
                                                    





                                    <div class="col-md-6">
                                        <hr/>
                                         <h4 class="mt-3"><b>Products Details</b>
                                             <?php  if(count($data['patientdetails']) > 0) { ?>
                                            <a href="{{ route('viewBTRequest') }}/{{$data['OCMRequest'][0]->ReqestID}}/{{$data['OCMRequest'][0]->RequestEpisodeID}}/RequestProducts" class="mb-2 btn float-right btn-primary btn-xs"><i class="fas fa-plus"></i> Request Products</a>
                                             <?php }  ?>  
                                         </h4>


                                          <?php  if(count($data['btproducts']) == 0) { ?>

                                                             <h5 class="mt-3">No Product Requested</h5>

                                         <?php } else {  ?>  



                                         <table class="table mt-3">
                                        
                                            <tbody>
                                                    
                                                <tr>
                                                   
                                                    <td>Product</td>
                                                    <td>Requested</td>
                                                    <td>Required</td>
                                                    <td>SampleID</td>
                                                    <td>Status</td>

                                                </tr>

                                                 @foreach ($data['btproducts'] as $btproduct)
                                                 
                                                 <tr>
                                                       
                                                        <td>{{$btproduct->Product}} * {{$btproduct->qty}}</td>
                                                        <td>
                                                            <?php 
                                                                if($btproduct->created_at != '' || $btproduct->created_at != null) {


                                                                     echo \App\Http\Controllers\Controller::DateTime(
                                                                                        $btproduct->created_at
                                                                                    );

                                                                }
                                                                ?></td>


                                                                <td>
                                                            <?php 
                                                                if($btproduct->requiredat != '' || $btproduct->requiredat != null) {


                                                                     echo \App\Http\Controllers\Controller::DateTime(
                                                                                        $btproduct->requiredat
                                                                                    );

                                                                }
                                                                ?></td>
                                                       
                                                        <td>{{$btproduct->sampleid}}</td>                                                                
                                                        <td>
                                                            @if($btproduct->status == 'p') 
                                                            Pending
                                                            @elseif($btproduct->status == 'Process') 
                                                            Processing
                                                            @elseif($btproduct->status == 'Issued') 
                                                            Issued
                                                            @endif
                                                        </td>

                                                 </tr>

                                                  @endforeach

                                                     

                                                     



                                            </tbody>

                                    </table>

                                        <?php } ?>


                                    </div>
                                                    


                                                    

                                         
                                         <?php  }  ?>   

                                        
                                         <div id="target" class="d-none"></div>

                                         


                                </div>



                                       


                            </div>  
                        </div>
                    </div>
       
                 </div>



                 <!-- Modal -->
                <div class="modal fade" id="request" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Request # <span id="requestText">{{$data['OCMRequest'][0]->ReqestID}}</span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">


                                    <div class="row">

                                    <div class="col-md-12">
                                        <span class="float-right">
                                     <button class="btn btn-primary" id="status">{{$data['OCMRequest'][0]->RequestState}}</button>
                                    </span>

                                    <h3 class="profile-username text-left mb-1">Patient Info</h3>
                                    <p class="text-dark text-left m-0">
                                    <b id="patname">{{$data['OCMRequest'][0]->PatName}}</b>
                                    </p>
                                    <p class="text-dark text-left m-0">
                                    <span id="patSex">

                                    <?php 

                                    if($data['OCMRequest'][0]->Sex == 'F') {

                                        echo 'Female';

                                    } elseif($data['OCMRequest'][0]->Sex == 'M') {

                                        echo 'Male';

                                    } else {

                                        echo 'Other';
                                    }

                                    ?>
                                    </span> / 
                                    <span id="patage">{{$data['DoB']}}</span> yrs
                                    </p>
                                    <p class="text-dark text-left m-0 mb-2" id="pataddress">{{$data['OCMRequest'][0]->Address0}}</p>

                                    </div>

                                    <div class="col-md-5">
                                    
                                     <label>Patient MRN : </label> <span id="patmrn">{{$data['OCMRequest'][0]->Chart}}</span>
                                    <br>
                                     <label>Clinician : </label> <span id="clinician">{{$data['OCMRequest'][0]->Clinician}}</span>
                                     <br>
                                     <label>Location : </label> <span id="ward">
                                         <?php 

                                         if($data['OCMRequest'][0]->Ward != null) { 

                                                                if($data['OCMRequest'][0]->bed != null) {
                                                                
                                                                echo $data['OCMRequest'][0]->Ward.' - Bed '. $data['OCMRequest'][0]->bed;

                                                                } else {
                                                                
                                                                 echo $data['OCMRequest'][0]->Ward;

                                                                }

                                                                } else {

                                                               if($data['OCMRequest'][0]->bed != null) {
                                                                
                                                                 echo $data['OCMRequest'][0]->clinic.' - Bed '. $data['OCMRequest'][0]->bed;

                                                                } else {
                                                                
                                                                 echo $data['OCMRequest'][0]->clinic;

                                                                }
                                                                }

                                                                ?>
                                     </span>
                                    </div>



                                    <div class="col-md-4">
                                    <label>Date Time : </label> <span id="datetime">
                              
                                        <?php 

                                         echo \App\Http\Controllers\Controller::DateTime(
                                                    $data['OCMRequest'][0]->ExecutionDateTime
                                                );
                                        
                                         ?>
                                      </span>
                                    <br>
                                    <label>Request #  </label> <span id="requestid">{{$data['OCMRequest'][0]->ReqestID}}</span>
                                    <br>
                                    <label>Request Episode : </label> <span id="episode">{{$data['OCMRequest'][0]->RequestEpisodeID}}</span>
                                    </div>


                                    <div class="col-md-3">
                                    <label>Fasting : </label> <span id="fasting">{{$data['OCMRequest'][0]->RequestFasting}}</span>
                                    <br>
                                    <label>Out of Hours :  </label> <span id="outofhours">{{$data['OCMRequest'][0]->outofhours}}</span>
                                    <br>
                                    <label>Priority : </label> <span id="priority">{{$data['OCMRequest'][0]->RequestPriority}}</span>
                                    </div>


                                    <div class="col-md-12">
                               

    

                                        <table class="table">
                                                
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th>Sample #</th>
                                                        <th>Requested at</th>
                                                        <th>Taken at</th>
                                                        <th>Received in lab at</th>
                                                        <th>Reported at</th>
                                                     
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                        
                                                        <?php 

                                                        foreach($data['requestInformation'] as $requestInfo) {

                                                                ?>
                                                                <tr>
                                                                    <td>{{$requestInfo->PhlebotomySampleID}}</td>
                                                                    <td>
                                                                        <?php 
                                                                            if($requestInfo->PhlebotomyCreatedDateTime != '' || $requestInfo->PhlebotomyCreatedDateTime != null) {

                                                                        

                                                                         echo \App\Http\Controllers\Controller::DateTime(
                                                                                    $requestInfo->PhlebotomyCreatedDateTime
                                                                                );
                                                                                

                                                                            }
                                                                            ?>
                                                                    </td>

                                                                    <td>
                                                                       <?php 
                                                                            if($requestInfo->PhlebotomySampleDateTime != '' || $requestInfo->PhlebotomySampleDateTime != null) {

                                                                                 echo \App\Http\Controllers\Controller::DateTime(
                                                                                    $requestInfo->PhlebotomySampleDateTime
                                                                                );

                                                                            }
                                                                            ?>
                                                                    </td>

                                                                    <td>
                                                                         <?php 
                                                                            if($requestInfo->PhlebotomySampleReceivedInLabDateTime != '' || $requestInfo->PhlebotomySampleReceivedInLabDateTime != null) {

                                                                                  echo \App\Http\Controllers\Controller::DateTime(
                                                                                    $requestInfo->PhlebotomySampleReceivedInLabDateTime
                                                                                );

                                                                            }
                                                                            ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php 
                                                                            if($requestInfo->RunTime != '' || $requestInfo->RunTime != null) {

                                                                                  echo \App\Http\Controllers\Controller::DateTime(
                                                                                    $requestInfo->RunTime
                                                                                );

                                                                            }
                                                                            ?>
                                                                    </td>


                                                                </tr>
                                                                <?php
                                                        }

                                                        ?>

                                                </tbody>

                                        </table>



                                   

                                        <table class="table">
                                                
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th colspan="2">Clinician Details</th>
                                                     
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                        
                                                       
                                                <tr>
                                                    <td colspan="2">{{$data['OCMRequest'][0]->RequestClinicalDetail}}</td>
                                                </tr>
                                                      

                                                </tbody>




                                        </table>



                                         <table class="table">
                                                
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th colspan="2">Questions Asked</th>
                                                     
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                        
                                                        <?php 

                                                        foreach($data['ocmrequestquestionsdetails'] as $ocmrequestquestionsdetail) {

                                                                ?>
                                                                <tr>
                                                                    <td>{{$ocmrequestquestionsdetail->question}}</td>
                                                                    <td>{{$ocmrequestquestionsdetail->answer}}</td>

                                                                </tr>
                                                                <?php
                                                        }

                                                        ?>

                                                         <?php 

                                                        foreach($data['btrequestquestions'] as $btrequestquestion) {

                                                                ?>
                                                                <tr>
                                                                    <td>{{$btrequestquestion->question}}</td>
                                                                    <td>{{$btrequestquestion->answer}}</td>
                                                                </tr>
                                                                <?php
                                                        }

                                                        ?>



                                                </tbody>




                                        </table>


                                         <table class="table AntibioticsTable">
                                                
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th colspan="2">Currently used Antibiotics</th>
                                                     
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                        
                                                       <tr>
                                                           <td colspan="2">
                                                                {{$data['OCMRequest'][0]->Antibiotics}}
                                                           </td>
                                                       </tr>
                                                       

                                                </tbody>




                                        </table>


                                          <table class="table IAntibioticsTable">
                                                
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th colspan="2">Intended Antibiotics</th>
                                                     
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                        
                                                       <tr>
                                                           <td colspan="2">
                                                                {{$data['OCMRequest'][0]->IntendedAntibiotics}}
                                                           </td>
                                                       </tr>
                                                       

                                                </tbody>




                                        </table>

                                    </div>

                                    </div>


                            </div>
                        </div>
                    </div>
                </div> 




                <!-- Modal -->
                <div class="modal fade" id="comments" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Comments - Request # <span id="requestText">{{$data['OCMRequest'][0]->ReqestID}}</span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">


                                    <div class="row">

                                    


                                    <div class="col-md-12">
                               

    

                                        <table class="table table-striped">
                                                
                                                <thead class="bg-white">
                                                    <tr>
                                                        <th>Sample #</th>
                                                        <th>Department</th>
                                                        <th>Test</th>
                                                        <th style="width:50%">Comments</th>
                                                        <th>Added</th>
                                                     
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                     


                                                          <?php 

                                                        foreach($data['testcomments'] as $testcomments) {

                                                                if($testcomments->Comment != '') {


                                                             ?>
                                                                <tr>
                                                                    <td>{{$testcomments->sampleid}}</td>
                                                                    <td>{{$testcomments->department}}</td>
                                                                    <td>{{$testcomments->Code}}</td>
                                                                    <td>{{$testcomments->Comment}}</td>
                                                                    <td>
                                                                        <?php 
                                                                            if($testcomments->RunTime != '' || $testcomments->RunTime != null) {

                                                                                  echo \App\Http\Controllers\Controller::DateTime(
                                                                                    $testcomments->RunTime
                                                                                );


                                                                            }
                                                                            ?>


                                                                    </td>
                                                                </tr>
                                                                <?php

                                                                }
                                                               
                                                        }

                                                        ?>



                                                        <?php 

                                                        foreach($data['observations'] as $observation) {

                                                                ?>
                                                                <tr>
                                                                    <td>{{$observation->sampleid}}</td>
                                                                    <td>{{$observation->department}}</td>
                                                                    <td></td>
                                                                    <td>{{$observation->message}}</td>
                                                                    <td>

                                                                          <?php 
                                                                            if($observation->added != '' || $observation->added != null) {

                                                                                   echo \App\Http\Controllers\Controller::DateTime(
                                                                                    $observation->added
                                                                                );

                                                                            }
                                                                            ?>
                                                                         
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                        }

                                                        ?>


  
                                                </tbody>

                                        </table>



                                    </div>

                                    </div>


                            </div>
                        </div>
                    </div>
                </div> 






                 <!-- Modal -->
                <div class="modal fade" id="viewResultModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Printed Report</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body"  style="min-height: 600px;">


                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                                
                                             <iframe id="reportiframe" style="border: 0;width:100%;height:100%" src=""></iframe>

                                         </div>



                                    </div>


                            </div>
                        </div>
                    </div>
                </div>    







                <!-- Modal -->
                <div class="modal fade" id="messagebox" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Messages</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">


                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                                
                                                <input type="hidden" id="requestid_" value="{{$data['OCMRequest'][0]->ReqestID}}">  
                                                <input type="hidden" id="episodeid" value="{{$data['OCMRequest'][0]->RequestEpisodeID}}">    
                       
                                                <div class="mb-3">
                                                <select class="form-control" name="user" id="user">
                                                <option value="" disabled selected>Select a user *</option>
                                                @foreach ($data['users'] as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>    
                                                 @endforeach
                                                </select>
                                                </div>
                                                
                                                <div class="mb-3">
                                                <select class="form-control" name="sampleid" id="sampleid">
                                                <option value="" disabled selected>Select a sample id *</option>
                                                @foreach ($data['requestInformation'] as $sample)
                                                <option>{{$sample->PhlebotomySampleID}}</option>    
                                                 @endforeach
                                                </select>
                                                </div>

                                                <div class="mb-3">
                                                <input placeholder="Subject *" type="text" class="form-control" name="subject" id="subject" value=""/>
                                                </div>


                                                <div class="mb-3">
                                                    <textarea placeholder="Message / Comments *" class="form-control" rows="10" name="message" id="message"></textarea>
                                                </div> 

                                                <button class="mt-2 btn btn-block btn-primary assign">Assign Now</button>

                                        </div>
                                         <div class="col-md-8">
                                             
                                             <label>Messages</label>
                                             
                                             <div class="messages"></div>
                                               

                                         </div>



                                    </div>


                            </div>
                        </div>
                    </div>
                </div>    

 

                <?php  if(request()->segment(1) == 'viewBTRequest') { ?>   
              <!-- Modal -->
                <div class="modal fade" id="requestProductsModal"  aria-hidden="true">
                    <div class="modal-dialog modal-lg  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Request Products - Request # <span id="requestText4"></span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" style="min-height: 500px;">
                                
                      <form id="form">  
                                  
                                 
                                  {{ csrf_field() }}

                                  <input type="hidden" id="ridRPs" name="rid">  
                                  <input type="hidden" id="eidRPs" name="eid"> 
                                  <input type="hidden" name="sampleid" value="{{@$data['results'][0]->PhlebotomySampleID}}">        
                      
                              <div class="row">

                   



                                  <div class="col-md-6">
                                  
                                      <label class="w-100">Select a Product    
                                        <button type="button" class=" btn btn-warning btn-xs addProduct float-right" title="Add Product"><i class="fas fa-plus"></i></button> 
                                    </label>
                                      
                                  </div>

                                  <div class="col-md-4">

                                     <label class="d-block">Required</label>

                                 </div>

                                  <div class="col-md-2">

                                     <label class="d-block">Qty</label>

                                 </div>
                                  
                              
                              <div class="col-md-12">
                                  

                                <div class="currentProducts">

                                  <div class="row mb-2" id="1">

                                  <div class="col-md-6">
                                  
                                      <select class="form-control products"  name="products[]">
                                          <option selected value=""></option>
                                          @foreach ($data['products'] as $product)
                                          <option value="{{$product->id}}">{{$product->name}}</option>
                                          @endforeach
                                      </select>

                                  </div>


                                  <div class="col-md-4">
                                  
                                      <input class="form-control dates" type="datetime-local" name="date[]" placeholder="Qty" value="1">

                                  </div>

                                  <div class="col-md-2">

                                      <div class="btn-group">
                                          <input class="form-control qtys" type="text" name="qty[]" placeholder="Qty" value="1">
                                           <button type="button" class="btn btn-dark btn-xs removeProduct" title="Remove Product"><i class="fas fa-times"></i></button> 

                                      </div>
                                  </div>
                                  
                              </div>

                            </div> 


                              </div>

                            

                             </div>      



                               


                               <div class="row">
                                   
         <div class="col-md-12 mt-5">
         
           <div id="questionsLength">

             <p><strong>Request Questions</strong></p>

             <div class="questionsDiv row" id="questionsList"> <div class="col-md-12"></div> </div>
          </div>
    
      </div>


              <div class="col-md-12 mt-3">
                  <button type="button" class="btn btn-primary submitProducts float-right">Submit Products</button>
              </div> 


                               </div>       
                                        
                                                </form>      

                                    </div>     

                           
                           
                        </div>
                    </div>
                </div> 
            <?php } ?>




      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

            


@extends('layouts.footer')

@push('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
<script type="text/javascript">
  




    if(localStorage.getItem("viewRequest") == null) { 

            window.location = "{{route('Requests')}}/All"; 
     
     } 

     else {

            var requestid = $('#requestid_').val();
                if(requestid != localStorage.getItem("viewRequest"))  {

                   window.location = "{{route('Requests')}}/All"; 
                }   

     }
        
    $(document).on('click', '#requestDetails', function () {  
       
       $('#request').modal('show');

    })





      $(document).on('click', '#requestComments', function () {  
       
       $('#comments').modal('show');

    })




        $(document).on('click', '.btnComments', function () {  
                    

         // var Comment = $(this).attr('data'); 
        
         //        swal(
         //          'Comments',
         //          Comment,
         //          'info'
         //        )

         $('#comments').modal('show');

      
            })


    // $('#agreement').scroll(function () {
    // var target = $("#target").offset().top;
    // if ($(this).scrollTop() >= target) {
    //     $('.signAll').removeAttr('disabled');
    // } 
    // });

    $('#user').select2();
    $('#sampleid').select2();
    

    

      $(document).on('click', '.viewResult', function () {  
       
                $('#viewResultModal').modal('show');
                 var sampleid = $(this).attr('id');
                 var external = $(this).attr('data');
                  var type = $(this).attr('data2');

                 if(external == 1) {

                    $('#reportiframe').attr('src','http://10.150.0.72/ocmreports/image.php?view='+sampleid);

                 } else {

                    if(type == 'bt') {

                        $('#reportiframe').attr('src','http://10.150.0.72/ocmreports/indexbt.php?view='+sampleid);

                    } else {

                        $('#reportiframe').attr('src','http://10.150.0.72/ocmreports/index.php?view='+sampleid); 
                    }

                   

                 }
                



         })


       $(document).on('click', '.message', function () {  
       
                $('#messagebox').modal('show');


                     var requestid = $('#requestid_').val();
                     var episodeid = $('#episodeid').val();
                     var readonly = '';

                showMessages(requestid,episodeid);




    })

  
    var userinfo = @json($data);
                 
      function showMessages(requestid,episodeid) {

          $.ajax({
                    type: "get",
                    url:"{{ route( 'showMessages') }}",
                    data: {'requestid' :  requestid, 'episodeid' :  episodeid},
                    timeout: 600000,
                    success: function(data) {
                        $('.messages').html(''); 
                        var  button = '';


                        if(data.length == 0) {

                            $('.messages').html('No Messages Found!');
                 
                      
                        } else {


                            $( data ).each(function( index ) {  

                          

                            if(data[index].datetimeread == null) {

                                readonly = ''; 


                                if(userinfo.user == data[index].userID) {

                                        button = '<button id="'+data[index].id+'" class="btn btn-xs btn-success markasread">Mark as Read</button>';
                                    } else {

                                         button = '';
                                    }

                            } 
                            else {

                                    readonly = 'style="background:white;"';
                            }
                        


                           $('.messages').append(' <textarea rows="4" readonly '+readonly+' class="form-control">Sample ID : '+data[index].sampleid+'\n'+"Subject : "+data[index].subject+'\n'+"Message : "+data[index].message+'</textarea> <div class="row mt-2"><div class="col-md-6 pl-3"><label>By : '+data[index].assignedfrom+'</label></div><div class="col-md-6 pl-3"><label>To : '+data[index].assignedto+'</label></div><div class="col-md-12 text-right pr-3">'+button+'</div></div><br/>')
                          })    
                        }

                        
                          
                        }

                     });


      }

     $(document).on('click', '.notSignedBtn', function () {  
       
      $(".table tbody tr:not(.notSigned)").hide();


    })

      $(document).on('click', '#viewAll', function () {  
       
      $(".table tbody tr").show();


    })

       $(document).on('click', '.filterDepartment', function () {  
       
        
        $(".table tbody tr").hide();
        //$(".table tbody tr:not(."+this.id+")").hide();
        $('.'+$(this).attr('id')).show();


    })





      

       $(document).on('click', '.assign', function () {  
       
                    
                    var user = $('#user').val();
                    var message = $('#message').val();
                    var subject = $('#subject').val();
                    var requestid = $('#requestid_').val();
                     var episodeid = $('#episodeid').val();
                     var sampleid = $('#sampleid').val();


                      if(user == null || user == '') {


                         Lobibox.notify('warning', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        msg: 'Please select a user first.',
                                        icon: 'bx bx-info-circle'
                                    });
                                   return false;   
                         } 


                         if(message == null || message == '') {

                         Lobibox.notify('warning', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        msg: 'Please write a message.',
                                        icon: 'bx bx-info-circle'
                                    });
                                   return false;   
                         } 


                    $.ajax({
                    type: "get",
                    url:"{{ route( 'assignUser') }}",
                    data: {'user' :  user, 'subject' :  subject, 'message' :  message, 'requestid' :  requestid, 'episodeid' :  episodeid, 'sampleid' :  sampleid},
                    timeout: 600000,
                    success: function(data) {
                       
                         showMessages(requestid,episodeid);
                          $('#user').val('').trigger('change');
                          $('#message').val('');

                          
                        }

                     });


    })





      $(document).on('click', '.markasread', function () {  
       
                    
                     var requestid = $('#requestid_').val();
                     var episodeid = $('#episodeid').val(); 

                    $.ajax({
                    type: "get",
                    url:"{{ route( 'markAsRead') }}",
                    data: {'id' : $(this).attr('id') },
                    timeout: 600000,
                    success: function(data) {
                       
                            showMessages(requestid,episodeid);
                          
                        }

                     });


    })

      



       $(document).on('click', '.signAll', function () {  
       
                    
                    var someObj={};
                    someObj.testGranted=[];

                    $(".signoff").each(function(){
                        var $this = $(this);

                        if($this.is(":checked")){
                            someObj.testGranted.push($this.attr("id"));
                        }
                    });

                    if(someObj.testGranted.length == 0) {

                        Lobibox.notify('warning', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        msg: 'Please select tests.',
                                        icon: 'bx bx-info-circle'
                                    });
                         return false;
                    }
                    

                    $.ajax({
                    type: "get",
                    url:"{{ route( 'signAll') }}",
                    data: {'id' : "{{$data['OCMRequest'][0]->ReqestID}}",
                            'tests':someObj.testGranted
                             },
                    timeout: 600000,
                    success: function(data) {
                       
                             location.reload();
                          
                        }

                     });

                })





        $(document).on('click', '.sampleidTD', function () {  


                var id = $(this).attr('id');
                var dpt = $(this).attr('data');
                     
                     $("#sampleidText").text(id)   
                     $(".departmentText").text(dpt+' Laboratory').css('text-transform','uppercase');   
                     $('#viewSampleID').modal('show');


                      $.ajax({
                    type: "get",
                    url:"{{ route( 'showFinalReport') }}",
                    data: {'id' :  id},
                    timeout: 600000,
                    success: function(response) {
                        
                        //console.log(response.results) 
                        $('.sampleidreport').html(''); 
                        $('.SpecimenComments').html(''); 
                        
                        var  button = '';


                        if(response.results.length == 0) {

                            $('.sampleidreport').html('No Report Found!');
                 
                      
                        } else {


                            $( response.results ).each(function( i ) {  

                            

                               if(response.results[i].Flags == null) { Flags = '-'; } else { 
                                 Flags = response.results[i].Flags;
                                 if(Flags == 'H') {
                                    Flags = '<b class="btn btn-danger btn-xs">'+Flags+'</b>'
                                 }
                                  else if(Flags == 'L') {
                                    Flags = '<b class="btn btn-info btn-xs">'+Flags+'</b>'
                                 }
                                 else if(Flags == 'X') {
                                    Flags = 'xxxx'
                                 } 
                                }  

                                if(response.results[i].result == null) { result = '-'; } else { result = response.results[i].result; }
                                if(response.results[i].Units == null) { Units = '-'; } else { Units = response.results[i].Units; }

                                if(response.results[i].NormalLow == null) { Range = '-'; } else { Range = response.results[i].NormalLow+'-'+response.results[i].NormalHigh; }

                                
                                 if(response.results[i].Comment == null || response.results[i].Comment == '') { Comment = ''; } else { 

                                       Comment = '<div class="col-md-12">Comment ('+response.results[i].Code+') : '+response.results[i].Comment+'</div>'; 
                                 }


                           $('.sampleidreport').append('<div class="col-md-3 text-left">'+response.results[i].Code+'</div><div class="col-md-2  text-center">'+result+'</div><div class="col-md-2  text-center">'+Units+'</div><div class="col-md-2  text-center">'+Range+'</div><div class="col-md-3">'+Flags+'</div>'+Comment)




                          })    
                        }



                             if(response.observations.length == 0) {

                             $('.SpecimenComments').html('');
                 
                      
                             } else {

                              $( response.observations ).each(function( i ) {  
                                  
                                    if(response.observations[i].message == null) { message = ''; } else { 

                                       message = '<div class="col-md-12">'+response.observations[i].message+'</div>'; 

                                         $('.SpecimenComments').append(message)
                                 }

                                 }) 
                        
                          
                        }

                        
                          
                        }

                     });



                  })


             var table22 = $('#table').DataTable({

                dom: '', //"Bfrtip",
                "ordering": false,  
                "pageLength": 100, 

                });
                new $.fn.dataTable.FixedHeader( table22, {
                        // options
                    } );


                $(".rowHide").hide();




        $('#user').select2();
        $('#sampleid').select2();
        



      
        var userinfo = @json($data);

            var requestedProducts = '{{request()->segment(4)}}';
            var rid = '{{request()->segment(2)}}';
            var eid = '{{request()->segment(3)}}';
            var type = '{{request()->segment(1)}}';

            if(type == 'viewBTRequest') {

                 $('.IAntibioticsTable').html('');
                  $('.AntibioticsTable').html('');
            }
           

            if(requestedProducts == 'RequestProducts') {



                   
                    if(userinfo.patientdetails.length > 0) {

                    $('#ridRPs').val(rid)
                    $('#eidRPs').val(eid)
                    $('#requestText3').text(eid)
                    $('#requestText4').text(rid)
                    $('#requestProductsModal').modal('show');

                    }

                    $( ".products" ).select2({
                        placeholder:'Select',
                        allowClear:true,
                        dropdownParent: $("#requestProductsModal")
                       });





            $(document).on('click', '.addProduct', function () {  

        
                    var cid = $('.currentProducts > div:last').attr('id');
                        cid = parseFloat(cid)+1;
                     $('.products').select2("destroy");

                    var clonedDiv = $('.currentProducts > div:first').first().clone(true);
                    clonedDiv.appendTo(".currentProducts");
                    $('.currentProducts > div:last').attr('id',cid);
                   $('#'+cid).find('.dates').val('');
                   $('#'+cid).find('.qtys').val(1);

    

                    $('.products').select2({
                
                                      placeholder:'Select',
                                          matcher: function(params, data) {
                                                  
                                                  // Do not display the item if there is no 'text' property
                                                  if (typeof data.text === 'undefined')
                                                  { return null; }
                                                  
                                                  // If there are no search terms, return all of the data
                                                  if (params.term === '' || typeof params.term === 'undefined') { 
                                                      return data; 
                                                  } else {
                                                      // `params.term` is the user's search term
                                                      // `data.id` should be checked against
                                                      // `data.text` should be checked against
                                                      // console.log(params.term.toLowerCase());
                                                      var q = params.term.toLowerCase();

                                
                 
                                                      if (data.text.toLowerCase().indexOf(q) > -1 || $(data.element).attr('data3').toLowerCase().indexOf(q) > -1) {
                                                          return $.extend({}, data, true);
                                                      }
                                                  }

                                                  // Return `null` if the term should not be displayed
                                                  return null;
                                              }

                                      });
                            

                 })




                
    
                $(document).on('click', '.removeProduct', function () {  

                             var currentProducts =  $('.currentProducts > div');
                        
                            if(currentProducts.length > 1) { 

                                $('#'+$(this).closest('.row').prop('id')).remove();
                            }
                            else {

                                 Lobibox.notify('warning', {
                                    pauseDelayOnHover: true,
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    msg: 'Atleast add 1 Product.',
                                    icon: 'bx bx-info-circle'
                                });

                            }

                             loadquestions();
                            
                })



            $(document).on('click', '.submitProducts', function () { 

                    

                        //stop submit the form, we will post it manually.
                        event.preventDefault();

                        // Get form
                        var form = $('#form')[0];

                        // Create an FormData object
                        var data = new FormData(form);

                        var rid= $('#ridRPs').val()
                        var eid = $('#eidRPs').val()

                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "{{ route('submitProducts') }}",
                            data: data,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function(data) {
                                //console.log(data);
                                    if ($.isEmptyObject(data.error)){

                                         Lobibox.notify('success', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,            
                                                position: 'top right',
                                                msg: data.success,
                                                icon: 'bx bx-check-circle'
                                            });
                                          
                                          window.location = "{{route('viewBTRequest')}}/"+rid+"/"+eid; 
                                         

                                    } else {
                                         Lobibox.notify('warning', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,
                                                position: 'top right',
                                                msg: data.error,
                                                icon: 'bx bx-info-circle'
                                            });
                                         $(".AddUpdatebtn").prop("disabled", false);
                                    }
                                }



                            });    

             })



                    $(".addProduct").trigger('click');
                    $('#2').remove();


            }



            function loadquestions(){


                  var profileIDs = $(".products  option:selected").map(function() {
                          return this.value;
                        }).get();

                      if(profileIDs != '') {
                                  separator = ',';
                                  implodedArray = '';
                        
                                  for(let i = 0; i < profileIDs.length; i++) {
                        
                                      // add a string from original array
                                      implodedArray += profileIDs[i];
                        
                                      // unless the iterator reaches the end of
                                      // the array add the separator string
                                      if(i != profileIDs.length - 1){
                                          implodedArray += separator; 
                                      }
                                  }
                        
                                   $.get("{{route('getBTQuestions')}}", 
                                             {
                                            id: implodedArray
                                                      }, 
                                          function(data){
                                                //console.log(data)
                                                $('.questionsDiv').html(data)  
                                            
                                            $('.questios_').removeDuplicates();


                                            }

                                )


                          } 

            }

(function($) {
  'use strict';
  
  $.fn.removeDuplicates = function() {
    var $original = $([]);
    
    this.each(function(i, el) {
      var $el = $(el),
          isDuplicate;
      
      $original.each(function(i, orig) {
        if (el.isEqualNode(orig)) {
          isDuplicate = true;
          $el.remove();
        }
      });
      
      if (!isDuplicate) {
        $original = $original.add($el);
      }
    });
    
    return $original;
  };
  
}(jQuery));





    $(document).on('select2:select', '.products', function () { 
            
                
              loadquestions();


                
            }) 


      $(document).on('click', '.answers_', function () {  
        
        var id = '.answersList-'+this.id+'>input';
        //alert(id);
        $(id).prop('checked', false);
        $(this).prop('checked', true);
        //alert(this.id)
        //alert(this.value)
        $('.'+this.id).val(this.value)

    })


        $(document).on('keyup', '.answers__', function () {  
        
        var id = '.answersList-'+this.id+'>input';
        //alert(id);
        // $(id).prop('checked', false);
        // $(this).prop('checked', true);
        //alert(this.id)
        //alert(this.value)
        $('.'+this.id).val(this.value)

    })

      


    
</script>
@endpush

