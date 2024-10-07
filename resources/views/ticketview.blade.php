@include('layouts.header')
  <style>
    *{
    margin: 0;
    padding: 0;
}
.rate {
    /* width: 37.9%; */
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}


/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
  </style>
 
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            @if(strpos(Request::url(), 'task')===false)
            <h1 class="m-0">Ticket View
               <a class="btn btn-info btn-sm" onclick=history.back()><i class="fas fa-arrow-left"></i> Go Back </a>
             </h1>
             @else
             <h1 class="m-0">Task View
              <a class="btn btn-info btn-sm" onclick=history.back()><i class="fas fa-arrow-left"></i> Go Back </a>
            </h1>
             @endif
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Tickets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">



                         <div class="card card-primary card-outline pb-0">
                            <div class="card-body row">  
                              <div class="col-md-12">
                                <h3 class="mb-3 crih" >
                                  Ticket #{{$data22['ticketinfo'][0]->ticketid}} by {{$data22['ticketinfo'][0]->username}}
                                  

                                  <?php

                                    if($data22['ticketinfo'][0]->priority == 'Low') {

                                        ?>
                                        <button class="btn btn-info float-right">{{$data22['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    }
                                   elseif($data22['ticketinfo'][0]->priority == 'Medium') {

                                        ?>
                                        <button class="btn btn-primary float-right">{{$data22['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    } 
                                    elseif($data22['ticketinfo'][0]->priority == 'High') {

                                        ?>
                                        <button class="btn btn-warning float-right">{{$data22['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    } 
                                    elseif($data22['ticketinfo'][0]->priority == 'Critical') {

                                        ?>
                                        <button class="btn btn-danger float-right cri">{{$data22['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    } 

                                   ?>





                               
                                <button class="btn btn-secondary float-right mr-1">{{$data22['ticketinfo'][0]->department}}</button>

                                <?php

                                    if($data22['ticketinfo'][0]->status == 'Opened') {

                                        ?>
                                        <button class="btn btn-primary float-right mr-1">{{$data22['ticketinfo'][0]->status}}</button>
                                        <?php

                                    }
                                   elseif($data22['ticketinfo'][0]->status == 'Processing') {

                                        ?>
                                        <button class="btn btn-warning float-right mr-1">{{$data22['ticketinfo'][0]->status}}</button>
                                        <?php

                                    } 
                                    elseif($data22['ticketinfo'][0]->status == 'Closed') {

                                        ?>
                                        <button class="btn btn-success float-right mr-1">{{$data22['ticketinfo'][0]->status}}</button>
                                        <?php

                                    } 
                                    elseif($data22['ticketinfo'][0]->status == 'Completed') {

                                      ?>
                                      <button class="btn btn-info float-right mr-1 " id="completed">{{$data22['ticketinfo'][0]->status}}</button>
                                      <?php

                                  } 
                                  
                                 

                                   ?>
                                  
                                                                        



                                
                              </h3>
                                <p>Subject : <b> 
                                  {{$data22['ticketinfo'][0]->subject}}
                                  @if($data22['ticketinfo'][0]->patientname != '')
                                  | Patient - <span id="Patient">{{$data22['ticketinfo'][0]->patientname}}</span>
                                  @endif
                                  @if($data22['ticketinfo'][0]->requestid != '')
                                  | RequestID {{$data22['ticketinfo'][0]->requestid}}
                                  @endif
                                  @if($data22['ticketinfo'][0]->sampleid != '')
                                  | SampleID {{$data22['ticketinfo'][0]->sampleid}}
                                  @endif
                                   </b></p>
                                
                                <p class="m-0">Message <button class="btn btn-dark float-right mr-1">{{ \App\Http\Controllers\tickets::DateTime($data22['ticketinfo'][0]->created_at)}}</button> </p>  
                                <div class="jumbotron py-2 px-2 mb-0">
                                  {{$data22['ticketinfo'][0]->message}}
                                </div>


                                 <?php 
                                 
                                  if(count(json_decode($data22['ticketattachments'])) > 0) { ?>


                                  <div class="col-xl-12 mx-auto">
                                  <label  class="col-form-label">Attached Files</label> 
                                  <div class="row">
                                  @foreach($data22['ticketattachments'] as $ticketattachment)
                                  
                                    <div class="col-md-3">
                                    @if(

pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'webp' || 
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'jpg' || 
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'jpeg' || 
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'png' || 
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'gif' 

)
                                      <div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 100px;overflow: hidden;">
                                       <a target="_blank" href="../images/{{$ticketattachment->filename}}"><img class="w-100" src="../images/{{$ticketattachment->filename}}"></a>
                                     
                                       
                                       @elseif(

pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'mov'||
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'mp4'||
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'mpg'||
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'webj'||
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'webm'||
pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'flv'

)
<div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 15rem;overflow:hidden ;width:30rem">

<video style="height:15rem;width:30rem;" controls>
      <source src="../images/{{$ticketattachment->filename}}" type="video/mp4">
 
</video>

                                      @else
                                      <div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 100px;overflow: hidden;">
                                       <a target="_blank" href="../images/{{$ticketattachment->filename}}">{{$ticketattachment->filename}}</a>
                                       @endif

                                      </div>
                                      
                                    </div>

                                  @endforeach
                                  </div>
                                  </div>

                                <?php } ?>

                              </div>
                            </div>
                          </div>




                        @foreach($data22['ticketmessages'] as $ticketmessage)
                         <div class="card card-primary card-outline">
                            <div class="card-body row">  
                              <div class="col-md-12">
                                <h3 class="mb-3">Reply from {{$ticketmessage->username}}
                                </h3>
                             
                                  
                               <p class="m-0">Messages <button class="btn btn-dark float-right mr-1">{{\App\Http\Controllers\tickets::DateTime($ticketmessage->created_at)}}</button> </p>  
                                <div class="jumbotron py-2 px-2 mb-0">
                                 {{$ticketmessage->message}} 
                                </div>

                                {{-- @if($loop->last) --}}
                                @if($ticketmessage->changes)
                                <p class="m-0 mt-1">Changes and Effects  </p>  
                                <div class="jumbotron py-2 px-2 mb-0">
                                 {{$ticketmessage->changes}} 
                                </div>

                                <div class="form-group col-md-12 d-flex mr-2">
                                  
                                  <div class="col-md-4">
                                  <label for="sentdate">Exe Sent Date</label>
                                  <input type="date" class="form-control f-one"  name="sentdate" id="sentdate" value="{{$data22['ticketinfo'][0]->exesentdate}}" readonly >
                                </div>
                                <div class="col-md-4">
                                  <label for="version">Version</label>
                                  <input type="text" class="form-control f-one"  name="version" id="version" placeholder="Version" value="{{$data22['ticketinfo'][0]->version}}" readonly>
                                </div>
                                <div class="col-md-4">
                                  <label for="project">Application</label>
                                  <input type="text" class="form-control f-one"  name="project" id="project" placeholder="Project" value="{{$data22['ticketinfo'][0]->project}}" readonly>
                                </div>
                              
                              
                                
                              </div>
                
                            

                             @endif
                             {{-- @endif --}}
                                    
                                  <?php 

                                  $attachments = \App\Http\Controllers\tickets::getTicketReplyAttachments($ticketmessage->mid);
                                 
                                  if(count(json_decode($attachments)) > 0) {

                                    $attachments = json_decode($attachments);

                                    ?>

                                  <div class="col-xl-12 mx-auto">
                                  <label  class="col-form-label">Attached Files</label> 
                                  <div class="row">
                                 
                                    <?php
                                      foreach($attachments as $attachment) {

                                          ?>
                                           <div class="col-md-3">
                                      
                                      @if(

                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'webp' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'jpg' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'jpeg' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'png' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'gif' 

                                      )
                                      <div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 100px;overflow: hidden;">
                                       <a target="_blank" href="../images/{{$attachment->filename}}"><img class="w-100" src="../images/{{$attachment->filename}}"></a>
                                       @elseif(

pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'mov'||
pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'mp4'||
pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'mpg'||
pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'webm'||
pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'flv'

)
<div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 15rem;overflow:hidden ;width:30rem">

<video style="height:15rem;width:30rem;" controls>
      <source src="../images/{{$attachment->filename}}" type="video/mp4">
 
</video>
                                       @else
                                       <div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 100px;overflow: hidden;">
                                       <a target="_blank" href="../images/{{$attachment->filename}}">{{$attachment->filename}}</a>
                                       @endif

                                      </div>
                                      
                                    </div>
                                          <?php
                                      }

                                      ?>

                                  </div>
                                  </div>
                                  <?php

                                  } 




                                  ?>  

                                

                


                              </div>
                            </div>
                          </div>
                          @endforeach

                         
                          
                  <form id="form">
                                       {{ csrf_field() }}
                                                  
                         <div class="card card-primary card-outline">
                            <div class="card-body row">  

                  <input type="hidden"  name="tid" id="tid">
                  <input type="hidden"  name="mid" id="mid" value="<?=uniqid();?>">

               
                <div class="form-group col-md-6">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" readonly name="subject" placeholder="Subject" required>
                </div>

   
                  <div class="col-md-2">
                    <label class="form-label">Department</label>
                    {{-- <select class="form-select form-control" name="department" readonly required id="department">
                      <option value="0">Choose an option</option>

                      <option>Technical Department</option>
                    </select> --}}
                    <input type="text" class="form-control" id="department" readonly name="department" placeholder="Department" required value={{$data22['ticketinfo'][0]->department}}>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Priority</label>
                    <select class="form-select form-control" name="priority" required id="priority">
                      <option value="">Choose an option</option>
                      <option>Low</option>
                      <option>Medium</option>
                      <option>High</option>
                      <option>Critical</option>
                    </select>
                  </div>
                  @if($data22['ticketinfo'][0]->tasks_id)
                  <div class="col-md-2">
                    <label class="form-label">Timeline</label>
                  <input type="date" class="form-control"name= "timeline" id="res_expiry" value={{ $data22['ticketinfo'][0]->response_expiry}}>
                  </div>
                  @endif

                   <div class="form-group col-md-6 patientInfo">
                    <label for="patientName">Patient Name</label>
                   <input type="" class="form-control f-one" name="patientname"  id="patientname_" readonly>
                     
                </div>


                  <div class="form-group col-md-3 requestInfo">
                   <label for="requestid">Request ID</label>
                    <input type="text" class="form-control f-one" readonly id="requestid" name="requestid" placeholder="Request ID" required>
            
                </div>


                <!-- Request ID and Sample ID -->
                <div class="form-group col-md-3 sampleInfo">
                   
                    <label for="sampleid">Sample ID</label>
                    <input type="text" class="form-control f-one" readonly name="sampleid" id="sampleid" placeholder="Sample ID" >
                </div>
                  @if($data22['ticketinfo'][0]->critical_risk_reason)
                  <div class="col-md-3">
                    <label for="version">Critical Risk Reason</label>
                    <input type="text" class="form-control f-one"  name="criticalrr" id="criticalrr" placeholder="" value="{{$data22['ticketinfo'][0]->critical_risk_reason}}" readonly>
                  </div>
                  @endif

                <div class="form-group col-md-3 ">
                   
                  <label for="sentdate">Exe Sent Date</label>
                  <input type="date" class="form-control f-one"  name="sentdate" id="sentdate"  >
              </div>

              <div class="form-group col-md-3 ">
                   
                <label for="version">Version</label>
                <input type="text" class="form-control f-one"  name="version" id="version" placeholder="Version" 
               >
            </div>
            @if(Auth::user()->role<=3)

            <div class="form-group col-md-3 ">
                   
              <label for="project">Application</label>
              <select type="text" class="form-control f-one"  name="project" id="project" placeholder="application" 
             >
             <option value="">Choose Application</option>
             @foreach($data22['versions'] as $versions)
             <option value="{{$versions}}">{{$versions}}</option>
             @endforeach
            </select>
          </div>
          @endif


            
            <input type="hidden" class="form-control" value="{{$data22['ticketinfo'][0]->tasks_id}}"  name="taskId" id="taskId"  >

            @if($data22['ticketinfo'][0]->tasks_id)
            @if(Auth::user()->role<3)
            <div class="form-group col-md-3  ">       
              <label for="dependency">Dependency</label>

              <select type="text" name="dependency[]" id="dependency" multiple="multiple">
                @foreach ($data22['task_tickets'] as $ticket)
                <option value="{{$ticket->subject}}">{{$ticket->subject}}</option>
                @endforeach
              </select>
            </div>
            @endif
            @endif


                @if(Auth::user()->email == $data22['ticketinfo'][0]->assignedto && ($data22['ticketinfo'][0]->status == 'Opened' || $data22['ticketinfo'][0]->status == 'Processing' ))
                <div class="form-group col-md-3">
                <label for="duration">Duration</label>
                  <select  class="form-control" name="duration" id="duration" placeholder="Add Duration" required>
                  <option value="1">1 day</option>
                  <option value="2">2 days</option>
                  <option value="3">3 days</option>
                  <option value="4">4 days</option>
                  <option value="5">5 days</option>
                  <option value="6">6 days</option>
                  <option value="7">7 days</option>
                  <option value="8">8 days</option>
                  <option value="9">9 days</option>
                  <option value="10">10 days</option>
                  </select>
               </div>
              @endif

                <!-- Message Area -->
                <div class="form-outline my-2 col-md-12">
                  <label for="">Changes And Effects</label>
                  <input type="text" class="changes form-control">
                    <label class="form-label mt-1" for="textAreaExample2">Messages</label>
                    <textarea class="form-control" rows="9" name="message" id="message" placeholder="Reply" required></textarea>
                    @if($data22['ticketinfo'][0]->tasks_id)
                    <button class="btn btn-primary mt-2 float-right raisenew" type="button">Reply & Raise a ticket for that action</button>
                    @endif
                    <input class="pnameraise d-none" value={{$data22['ticketinfo'][0]->patientname}}>
                    <input class="contactraise d-none" value={{$data22['ticketinfo'][0]->contact}}>
                    <input class="sampleidraise d-none" value={{$data22['ticketinfo'][0]->sampleid}}>
                    <input type="hidden" name="tid" id="tidraisehehe" value="<?=uniqid();?>">
                    <input class="clientraise d-none" value={{$data22['ticketinfo'][0]->ticket_client}}
                    >
                    <input class="tasksidraise d-none" value={{$data22['ticketinfo'][0]->tasks_id}}>
                    <input class="ticketidraisereply d-none" value={{$data22['ticketinfo'][0]->ticketid}}>
                </div>


              
               <div class="col-xl-12 mx-auto">
                <label  class="col-form-label">Attach Files <span>*</span></label>    
                  <input id="files" type="file" name="files[]">
                </div>

             
         
              
                <div class="col-md-12 mt-2">

                

                  @if(Auth::user()->role==4||(Auth::user()->role<3&&$data22['ticketinfo'][0]->tasks_id))
               
               <button type="button" class="btn btn-warning float-right ml-1 replyandclose mr-1" value="Submit">Reply & Close Ticket</button>
               @endif
               @if(Auth::user()->role==4||Auth::user()->role==1)

               
               <button type="button" class="btn btn-danger float-right sendtoocm" value="Submit">Send to OCM Support</button>

                  
                  
                 
<button type="button" class="btn btn-dark float-right mr-1 ml-1 sendtonet" value="Submit">Send to NA Support</button>
             @else
             <button type="button" class="btn btn-warning float-right ml-1 d-none replyandclose" value="Submit">Reply & Close Ticket</button>
             
               @endif

                  <button type="button" class="btn btn-success float-right ml-1 replyandcomplete" value="Submit">Reply & Complete Ticket</button>
              

                  <button type="button" class="btn btn-primary float-right ml-1 saveupdatebtn" value="Submit">Generate Ticket</button>
                  @if(($data22['ticketTimeline'][0]['time2'] ?? null) == '0000-00-00 00:00:00' && count($data22['ticketTimeline'])!==0)
                  <button type="button" class="btn btn-secondary float-right paused ml-1">Pause</button>
                  @endif
                  @if( ( ($data22['ticketTimeline'][0]['time1'] ?? null) && $data22['ticketTimeline'][0]['time2'] != '0000-00-00 00:00:00')||count($data22['ticketTimeline'])===0)

                  <button type="button" class="btn btn-warning float-right started ml-1 ">Start</button>
               @endif

                  @if(Auth::user()->role<=3)
                  <div class='col-md-2'>
                    <select name="assignToProject" id="assignToProject" class="form-control">
                     <option hidden selected disabled>Select a Project</option>
                    
                     @foreach($data22['projects'] as $project)
                     <option value="{{$project->id}}">{{$project->subject}}</option>
                      @endforeach
                    </select>
                   </div>
                   @endif

                
                
                  <div id="result">
                  <img src="/images/Iphone-spinner-2.gif" alt="Loading..." id='loading-image' class='d-none'>
                  </div>
                </div>

        
                            </div>
                          </div>

                  </form>      
                  <div class="modal fade" id="selectUsers" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                          
                            
                                <h5 class="modal-title text-white">Rate The agent <span id="requestText2"></span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                               
                              </button>

                            </div>

                            <div class="modal-body" style="overflow: hidden"><div  style="display:flex;justify-content:center;align-item:center;flex-direction:column" >
                                     
                           
                                      <div class="rate mb-4" style="width:70%">
    <input type="radio" id="star5" name="rate" value="5"  />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>

  <div class="d-flex " style="justify-content:space-between; width:100% ">
    <div>
  <label for="html" class="mt-">Was the response timely?</label><br>
    </div>
  <div class='d-flex' style="justify-content:space-evenly">
  <div class="form-check">
  <input class="form-check-input" type="radio" value="1" id="flexCheckDefault" name="time">
  <label class="form-check-label mr-2" for="flexCheckDefault">
   Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" value="0" id="flexCheckChecked" name="time">
  <label class="form-check-label" for="flexCheckChecked">
    No
  </label>
</div>

</div>
</div>

<div class="d-flex time" style="justify-content:space-between; width:100% ">
    <div>
  <label for="html" class="mt-">Was the response satisfactory?</label><br>
    </div>
  <div class='d-flex' style="justify-content:space-evenly">
  <div class="form-check">
  <input class="form-check-input" type="radio" value="1" id="flexCheckDefault" name="satisfy">
  <label class="form-check-label mr-2" for="flexCheckDefault">
   Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" value="0" id="flexCheckChecked" name="satisfy">
  <label class="form-check-label" for="flexCheckChecked">
    No
  </label>
</div>
</div>


</div>
<div class="d-flex " style="justify-content:space-evenly; width:100% ">
   <div>
  <label for="html" class="mt-3">Additional Comments:</label><br>
    
 <textarea name="comments" id="comments" cols="25" rows="5"></textarea>
  </div>
</div>

                                </div>
                                <button type="button" class="mt-2 btn btn-primary ratenow float-right">Rate Now</button>
                                        
                                
                            </div>     

                           
                           
                        </div>
                    </div>
                </div> 
                  <!-- BASIC -->
            

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>



@extends('layouts.footer')

@push('script')
<!-- fancyfileuploader -->
<script src="{{ asset('plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script src="{{ asset('plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>


<script></script>

<script type="text/javascript">
    
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function(){


     


               $('#dependency').select2({
                    placeholder: 'Select tasks',
                    allowClear: true
                });

                const ticketInfo = @json($data22['ticketinfo'][0]->dependencytickets);
                const dependencyTicketArray = ticketInfo?.split(',');
                $("#dependency").val(dependencyTicketArray).trigger('change');


                $(document).on('change','#dependency',function(){
                  const dependencyTicketSubjects = $(this).val();

                  console.log(dependencyTicketSubjects,"sss")
                  const url = window.location.href;
                  const urlSegments = url.split('/');
                  const thisTicketId = urlSegments[urlSegments.length-1];
                  const thisTicketSubject = $("#subject").val();
                
                  const taskId = $("#taskId").val();
                
                  $.ajax({
                    type: 'POST',
                    url: "{{route('dependencyEmail')}}",
                    data: {
                    
                      dependencyTicketSubjects:dependencyTicketSubjects,
                      thisTicketId:thisTicketId,
                      thisTicketSubject:thisTicketSubject,
                      taskId:taskId,

                    }
                }).done(function(response){
                  // console.log(response);
                })

                })
      
const status=$("#completed").html();
if(status==='Completed'){
  $(".replyandcomplete").addClass('d-none')
  $('.paused').addClass('d-none')
      $('.started').addClass('d-none')
      
}
        var data = @json($data22);
        var d = @json($data22);
        // console.log(data22.internal[0])

        if(data.ticketinfo[0] != ''){


             if(data.ticketinfo[0].patientname == null) {

                  $('.patientInfo').remove();

             } else {

                $('#Patient').text(data.ticketinfo[0].Patientname);
                $('#patientname_').val(data.ticketinfo[0].patientname);
                $('#patientname').val(data.ticketinfo[0].patientname).trigger('change');
             }



            if(data.ticketinfo[0].requestid == null) {

                  $('.requestInfo').remove();

             } else {

                $('#requestid').val(data.ticketinfo[0].requestid);
             }



            
            if(data.ticketinfo[0].sampleid == null) {

                  $('.sampleInfo').remove();

             } else {

                $('#sampleid').val(data.ticketinfo[0].sampleid);
             }


  

    
            $('#tid').val(data.ticketinfo[0].ticketid)
            $('#subject').val(data.ticketinfo[0].subject)
            $('#department').val(data.ticketinfo[0].department).trigger('change');
            $('#priority').val(data.ticketinfo[0].priority).trigger('change');
            //$('#message').val(data.ticketinfo[0].message)
            $('.saveupdatebtn').text('Reply Now');



            if(data.ticketinfo[0].status == 'Closed') {

                $('#form').remove();
            }
      

 

        }



 
    $(".paused").click(function(){
      
      $('.paused').addClass('d-none');
      
      $('.paused').removeClass('d-block');
      $('.started').addClass('d-block');
   
      let myform=document.getElementById("form");
let data=new FormData(myform);
data.delete('tid')
data.append('tid', $('#tid').val())
$.ajax({
                
        url: "../PauseTicket",
        data: data,    
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        }).done(function (response) {

                        if(response > 0) {

                            $("#result").html('Ticket time has been paused!')

                         window.location=''

                        }
                   
                       
                }).fail(function(response){

console.log(Object.values(response.responseJSON.errors)[0]);
Lobibox.notify('warning', {
pauseDelayOnHover: true,
continueDelayOnInactiveTab: false,
position: 'top right',
msg: Object.values(response.responseJSON.errors)[0],
icon: 'bx bx-info-circle'           
});
});;
                event.preventDefault();


  });
 
  $('#patientname').select2({
        placeholder:'Choose a Patient'
    });

    $(".started").click(function(){
      
        $('.started').addClass('d-none');
        $('.started').removeClass('d-block');
        $('.paused').addClass('d-block');
        let myform=document.getElementById("form");
        
let data=new FormData(myform);
data.delete('tid')
        data.append('tid', $('#tid').val())
$.ajax({
                
        url: "../StartTicket",
        data: data,    
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        }).done(function (response) {
console.log(response);

                            $("#result").html('Ticket time has been started')

                         window.location="../TicketView/"+response;

                      
                   
                       
                }).fail(function(response){

console.log(Object.values(response.responseJSON.errors)[0]);
Lobibox.notify('warning', {
pauseDelayOnHover: true,
continueDelayOnInactiveTab: false,
position: 'top right',
msg: Object.values(response.responseJSON.errors)[0],
icon: 'bx bx-info-circle'           
});
});;
        event.preventDefault();
});
      
  

    $(".replyandcomplete").click(function(){
  //  var tid=$('#tid').val();S
  $(".replyandcomplete").attr("disabled", true);
// console.log(tid);
// return true;
let myform=document.getElementById("form");
let data=new FormData(myform);
var messages= $('#message').val();
    data.append('messages',messages);
    data.append('completionmessage',messages);

    var userRole = @json(Auth::user()->role);
    var words = messages.trim().split(/\s+/);
    
   
    var wordCount = words.length;
    if (wordCount<20 && userRole<=3){
      Lobibox.notify('warning', {
          pauseDelayOnHover: true,
          continueDelayOnInactiveTab: false,
          position: 'top right',
          msg: 'The resolution message can not be less than  25 words',
          icon: 'bx bx-info-circle'           
});
$(".replyandcomplete").attr("disabled", false);

return false;
    }
   const changes= $(".changes").val();
   const changeCount= changes.trim().split(/\s+/);
   const changeCount2=changeCount.length;
  //  alert(changeCount2)
  //  return false;
   if(changeCount2<20 && userRole<=3){
    Lobibox.notify('warning', {
          pauseDelayOnHover: true,
          continueDelayOnInactiveTab: false,
          position: 'top right',
          msg: 'The Changes and affects message can not be less than 25 words',
          icon: 'bx bx-info-circle'           
});
$(".replyandcomplete").attr("disabled", false);

return false;
   }
  const esdate= $("#sentdate").val()
  const ver= $("#version").val()
  const project= $("#project").val()
   data.append('changes',changes);
   data.append('esdate',esdate);
   data.append('project',project);
   data.append('ver',ver);
   data.delete('tid')
   data.append('tid', $('#tid').val())

    $('#loading-image').removeClass('d-none');

    // data.append('me',messages);
$.ajax({
                
        url: "{{route('CompleteTicket')}}",
        data: data,    
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        }).done(function (response) {

                        if(response > 0) {
                                  window.location="{{route('TicketView')}}/"+response;
                                 $.ajax({
                              
                              url: "../sendMail",
                             data:data,
                              cache: false,
                              processData: false,
                              contentType: false,
                              type: 'POST',
                              }).done(function (response) {
                                   
console.log(response);
$(".replyandcomplete").removeAttr("disabled");

                                              if(response == 1) {
        
                                          
        
                                              //  window.location="Tickets/Opened";
                                          
                                              
                            $("#result").html('Ticket has been completed successfully!')
                            $('#loading-image').addClass('d-none');
                            location.reload(true)
                                              }
                                            //  elseif(response[1] == 0)
                                            //   console.log("t");
                                             
                                              
                                              
                                             
                                      })


                        }
                   
                       
                }).fail(function(response){
                  $(".replyandcomplete").removeAttr("disabled");

                  console.log(Object.values(response.responseJSON.errors)[0]);
Lobibox.notify('warning', {
          pauseDelayOnHover: true,
          continueDelayOnInactiveTab: false,
          position: 'top right',
          msg: Object.values(response.responseJSON.errors)[0],
          icon: 'bx bx-info-circle'           
});
                });
        // event.preventDefault();
});

 $(".replyandclose").click(function(){
  $(".replyandclose").attr("disabled", true);
  let myform=document.getElementById("form");
    let data1=new FormData(myform);
    data1.delete('tid')
data1.append('tid', $('#tid').val())
  $.ajax({
                    
                    url: "{{ route('CloseTicket') }}",
                    method: 'POST',
                    data:data1,
                    cache : false,
            processData: false,
            contentType: false
                  
                    }).done(function (response) {
                      $(".replyandclose").removeAttr("disabled");
                                    if(response > 0) {
        
                                        $("#result").html('Ticket has been Closed successfully!')
        
                                     window.location="../TicketView/"+response;
        
                                    }
                               
  $(".replyandclose").removeAttr("disabled", true);
                                   
                            }).fail(function(response){
  $(".replyandclose").removeAttr("disabled", true);
        
        console.log(Object.values(response.responseJSON.errors)[0]+"s");
        Lobibox.notify('warning', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        msg: Object.values(response.responseJSON.errors)[0],
        icon: 'bx bx-info-circle'           
        });
        
        });
        event.preventDefault();
console.log(d);
      });    
// return true;
// var v=0;


$(".raisenew").click(function(){
    patientname=$(".pnameraise").val()
    contact=$(".contactraise").val()
    sampleid=$(".sampleidraise").val()
    department=$("#department").val()
    priority=$("#priority").val()
    message=$("#message").val()
    tid=$("#tidraisehehe").val()
    client=$(".clientraise").val()
    taskId=$(".tasksidraise").val()

    
  //   alert(priority);
  // return false;
    $.ajax({
      url:"{{route('Ticket')}}",
      method:"POST",
      data:{
        patientname:patientname,
        contact:contact,
        sampleid:sampleid,
        department:department,
        priority:priority,
        message:message,
        client:client,
        tid:tid,
        subject:message,
        client:client,
        taskId:taskId
      }

    }).done(function(response){
      // location.reload()
      let myform=document.getElementById("form");
    let data=new FormData(myform);
    var messages= $('#message').val();
    var timeline=$("#res_expiry").val()
    lpc=$(".ticketidraisereply").val()
    data.append('messages',messages);
    data.append('resExpiry',timeline);
    data.delete('tid');
    data.append('tid',lpc)
    $.ajax({
                    
            url: "../updateTicketInfo",

            data: data,    
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            }).done(function (response) {

                            if(response > 0) {
                              location.reload()
                              //   $("#result").html('Ticket has been generated successfully!')
                              // const val=$(".cri").text()
                              // console.log(val)
                            }
                            })
    })
  })

    $(".saveupdatebtn").click(function(){
      $(".saveupdatebtn").attr("disabled", true);
      $('#loading-image').removeClass('d-none');
      
    let myform=document.getElementById("form");
    let data=new FormData(myform);
    var messages= $('#message').val();
    var timeline=$("#res_expiry").val()
    data.append('messages',messages);
    data.append('resExpiry',timeline);
    data.delete('tid')
    data.append('tid', $('#tid').val())
    $.ajax({
                    
            url: "../updateTicketInfo",

            data: data,    
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            }).done(function (response) {

                            if(response > 0) {

                                $("#result").html('Ticket has been generated successfully!')
                              const val=$(".cri").text()
                              console.log(val)
                              if(val=='Critical'){
                                // alert()
                                // const h3Element = document.querySelector('h3');
        
        // Get the text content of the h3 element
        const h3Element =$(".crih")
        var textContent = h3Element.contents().filter(function() {
                return this.nodeType === 3; // Node type 3 is a text node
            }).text().trim();
// console.log("tc",textContent)
        // Find the posicontion of the word "by"
        const byIndex = textContent.indexOf('by');
        
        // Extract the email after the word "by"
        // const email = textContent.substring(byIndex + 3).trim();
        // console.log (email)
        var regex = /Ticket #(\w+) by (\S+)/;
            var matches = textContent.match(regex);

            if (matches) {
                var ticketNumber = matches[1];
                var email = matches[2];

                // Log the extracted values to the console
                console.log('Ticket Number:', ticketNumber);
                console.log('Email:', data);
                $.ajax({
                            url: '/send-reply',
                            method: 'POST',
                            data: {
                                email: email,
                                ticketNumber: ticketNumber,
                                messages:messages,
                                subject:data.get('subject')
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // alert('Reply sent successfully!');
                            },
                            error: function(xhr) {
                                // alert('An error occurred while sending the reply.');
                            }
                        });
            } else {
                console.log('No match found');
            }
                              }
                             //window.location="../../TicketView/"+response;
                             // $("#result").html('Ticket has been generated successfully!')

                             $(".saveupdatebtn").removeAttr("disabled");

                          }

                            



                           
                    }).fail(function(response){

                      $(".saveupdatebtn").removeAttr("disabled");
console.log(Object.values(response.responseJSON.errors)[0]);
Lobibox.notify('warning', {
pauseDelayOnHover: true,
continueDelayOnInactiveTab: false,
position: 'top right',
msg: Object.values(response.responseJSON.errors)[0],
icon: 'bx bx-info-circle'           
});
});;
            event.preventDefault();
    });



    $(".sendtoocm").click(function(){

      $(".sendtoocm").attr("disabled", true);
    let myform=document.getElementById("form");
    let data=new FormData(myform);
    data.delete('tid')
data.append('tid', $('#tid').val())
    $.ajax({
                    
            url: "../sendTicketToOCM",
            data: data,    
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            }).done(function (response) {

                            if(response > 0) {

                                $("#result").html('Ticket has been sent to OCM support!')

                             window.location="../../TicketView/"+response;

                            }
                            $(".sendtoocm").removeAttr("disabled");
                           
                    }).fail(function(response){
                      $(".sendtoocm").removeAttr("disabled");
console.log(Object.values(response.responseJSON.errors)[0]);
Lobibox.notify('warning', {
pauseDelayOnHover: true,
continueDelayOnInactiveTab: false,
position: 'top right',
msg: Object.values(response.responseJSON.errors)[0],
icon: 'bx bx-info-circle'           
});
});;
            event.preventDefault();
    }); 


    $(".sendtonet").click(function(){

      $(".sendtonet").attr("disabled", true);

let myform=document.getElementById("form");
let data=new FormData(myform);
data.delete('tid')
data.append('tid', $('#tid').val())
$.ajax({
                
        url: "../sendTicketToNET",
        data: data,    
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        }).done(function (response) {

                        if(response > 0) {

                            $("#result").html('Sent to Net Acquire Support!')

                         window.location="../../TicketView/"+response;

                        }
                   
                       
      $(".sendtonet").removeAttr("disabled", true);
                }).fail(function(response){

                  $(".sendtonet").removeAttr("disabled", true);
console.log(Object.values(response.responseJSON.errors)[0]);
Lobibox.notify('warning', {
pauseDelayOnHover: true,
continueDelayOnInactiveTab: false,
position: 'top right',
msg: Object.values(response.responseJSON.errors)[0],
icon: 'bx bx-info-circle'           
});
});;
        event.preventDefault();
}); 


          var filename;

  $('#files').FancyFileUpload({

url : "../uploadFiles",
maxfilesize: 100000000,
params: {
    tid:$('#tid').val(),
    mid:$('#mid').val()
},
added : function(e, data) {
this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
},
uploadcompleted : function(e, data) {
   
    // console.log(data.result.filename)
    filename = data.result.filename;

this.find('.ff_fileupload_actions button.ff_fileupload_remove_file').val(filename);

    
}
});


$(document).on('click', '.ff_fileupload_remove_file', function () {  
        // console.log($(this).id)

        filename=$(this).val();
        // console.log("ss");
        let tid= $('#tid').val();
        
        // alert(filename);
// alert(tid)
let data=new FormData();
data.append('tid',tid);

data.append('filename',filename);

        $.ajax({
                    
                    url: "../deleteattachment",
                    data: data,
                    cache: false,
                    processData: false,
                   contentType: false,
                    type: 'POST',
                    })
        
                })


                $(document).on('change','#assignToProject',function(){
                  const projectid = $(this).val();
                  const currentUrl = window.location.href;
                  const urlSegments = currentUrl.split('/');
                  const lastSegment = urlSegments[urlSegments.length - 1];
                  console.log(lastSegment);
                  console.log(projectid);

                  
                    $.ajax({
                    type: 'POST',
                    url: "{{route('assignToProject')}}",
                    data: {
                      projectid:projectid,
                      ticketid:lastSegment
                    }

                    }).done(function(response){
                      if(response == 1){
                        window.location = "";
                      }
                    })

                });


                
                

     


    });
</script>
@endpush