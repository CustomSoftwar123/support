@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Ticket View
               <a class="btn btn-info btn-sm" href="{{route('Tickets')}}"><i class="fas fa-arrow-left"></i> Go Back </a>
             </h1>
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
                                <h3 class="mb-3">
                                  Ticket #{{$data['ticketinfo'][0]->ticketid}} by {{$data['ticketinfo'][0]->username}}
                                  

                                  <?php

                                    if($data['ticketinfo'][0]->priority == 'Low') {

                                        ?>
                                        <button class="btn btn-info float-right">{{$data['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    }
                                   elseif($data['ticketinfo'][0]->priority == 'Medium') {

                                        ?>
                                        <button class="btn btn-primary float-right">{{$data['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    } 
                                    elseif($data['ticketinfo'][0]->priority == 'High') {

                                        ?>
                                        <button class="btn btn-warning float-right">{{$data['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    } 
                                    elseif($data['ticketinfo'][0]->priority == 'Critical') {

                                        ?>
                                        <button class="btn btn-danger float-right">{{$data['ticketinfo'][0]->priority}}</button>
                                        <?php

                                    } 

                                   ?>





                               
                                <button class="btn btn-secondary float-right mr-1">{{$data['ticketinfo'][0]->department}}</button>

                                <?php

                                    if($data['ticketinfo'][0]->status == 'Opened') {

                                        ?>
                                        <button class="btn btn-primary float-right mr-1">{{$data['ticketinfo'][0]->status}}</button>
                                        <?php

                                    }
                                   elseif($data['ticketinfo'][0]->status == 'Processing') {

                                        ?>
                                        <button class="btn btn-warning float-right mr-1">{{$data['ticketinfo'][0]->status}}</button>
                                        <?php

                                    } 
                                    elseif($data['ticketinfo'][0]->status == 'Closed') {

                                        ?>
                                        <button class="btn btn-success float-right mr-1">{{$data['ticketinfo'][0]->status}}</button>
                                        <?php

                                    } 

                                   ?>


                                
                              </h3>
                                <p>Subject : <b> 
                                  {{$data['ticketinfo'][0]->subject}}
                                  @if($data['ticketinfo'][0]->patientname != '')
                                  | Patient - <span id="Patient">{{$data['ticketinfo'][0]->patientname}}</span>
                                  @endif
                                  @if($data['ticketinfo'][0]->requestid != '')
                                  | RequestID {{$data['ticketinfo'][0]->requestid}}
                                  @endif
                                  @if($data['ticketinfo'][0]->sampleid != '')
                                  | SampleID {{$data['ticketinfo'][0]->sampleid}}
                                  @endif
                                   </b></p>
                                
                                <p class="m-0">Message <button class="btn btn-dark float-right mr-1">{{$data['ticketinfo'][0]->created_at}}</button> </p>  
                                <div class="jumbotron py-2 px-2 mb-0">
                                  {{$data['ticketinfo'][0]->message}}
                                </div>


                                 <?php 
                                 
                                  if(count(json_decode($data['ticketattachments'])) > 0) { ?>


                                  <div class="col-xl-12 mx-auto">
                                  <label  class="col-form-label">Attached Files</label> 
                                  <div class="row">
                                  @foreach($data['ticketattachments'] as $ticketattachment)
                                    
                                    <div class="col-md-3">

                                      <div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 100px;overflow: hidden;">
                                      @if(

                                      pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'webp' || 
                                      pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'jpg' || 
                                      pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'jpeg' || 
                                      pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'png' || 
                                      pathinfo($ticketattachment->filename, PATHINFO_EXTENSION) == 'gif' 

                                      )
                                       <a target="_blank" href="../images/{{$ticketattachment->filename}}"><img class="w-100" src="../images/{{$ticketattachment->filename}}"></a>
                                      @else
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




                        @foreach($data['ticketmessages'] as $ticketmessage)
                         <div class="card card-primary card-outline">
                            <div class="card-body row">  
                              <div class="col-md-12">
                                <h3 class="mb-3">Reply from {{$ticketmessage->username}}
                                </h3>
                             
                                  
                               <p class="m-0">Message <button class="btn btn-dark float-right mr-1">{{$ticketmessage->created_at}}</button> </p>  
                                <div class="jumbotron py-2 px-2 mb-0">
                                 {{$ticketmessage->message}}
                                </div>



                                    
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

                                      <div class="jumbotron p-0 mb-0" style="border:5px solid #dcdcdc;min-height:100px;max-height: 100px;overflow: hidden;">
                                      @if(

                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'webp' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'jpg' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'jpeg' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'png' || 
                                      pathinfo($attachment->filename, PATHINFO_EXTENSION) == 'gif' 

                                      )
                                       <a target="_blank" href="../images/{{$attachment->filename}}"><img class="w-100" src="../images/{{$attachment->filename}}"></a>
                                      @else
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
                   <input type="hidden"  name="patientname"  id="patientname_">

               
                <div class="form-group col-md-6">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" readonly name="subject" placeholder="Subject" required>
                </div>

   
                  <div class="col-md-3">
                    <label class="form-label">Department</label>
                    <select class="form-select form-control" name="department" readonly required id="department">
                      <option value="0">Choose an option</option>
                      <option>Technical Department</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Priority</label>
                    <select class="form-select form-control" name="priority" readonly required id="priority">
                      <option value="0">Choose an option</option>
                      <option>Low</option>
                      <option>Medium</option>
                      <option>High</option>
                      <option>Critical</option>
                    </select>
                  </div>


                   <div class="form-group col-md-6 patientInfo">
                    <label for="patientName">Patient Name</label>
                     <select class="form-control"  id="patientname" disabled >
                        <option disabled selected value=""></option>
                     @foreach ($data['patients'] as $patient)
                        <option>{{$patient->PatName}} | MRN {{$patient->Chart}}</option>
                        @endforeach
                    </select>
                </div>


                  <div class="form-group col-md-3 requestInfo">
                   <label for="requestid">Request ID</label>
                    <input type="text" class="form-control f-one" readonly id="requestid" name="requestid" placeholder="Request ID" required>
            
                </div>


                <!-- Request ID and Sample ID -->
                <div class="form-group col-md-3 sampleInfo">
                   
                    <label for="sampleid">Sample ID</label>
                    <input type="text" class="form-control f-one" readonly name="sampleid" id="sampleid" placeholder="Sample ID" required>
                </div>


         

                <!-- Message Area -->
                <div class="form-outline my-2 col-md-12">
                    <label class="form-label" for="textAreaExample2">Message</label>
                    <textarea class="form-control" rows="9" name="message" id="message" placeholder="Reply" required></textarea>
                </div>


              
               <div class="col-xl-12 mx-auto">
                <label  class="col-form-label">Attach Files <span>*</span></label>    
                  <input id="files" type="file" name="files[]">
                </div>

             
         
              
                <div class="col-md-12 mt-2">

                  @if($data['ticketinfo'][0]->internal == 1)

                  <button type="button" class="btn btn-primary float-right saveupdatebtn" value="Submit">Generate Ticket</button>
                 
                  @else

                  <button type="button" class="btn btn-danger float-right ml-1 sendtoocm" value="Submit">Send to OCM Support</button>

                  <button type="button" class="btn btn-warning float-right ml-1 replyandclose" value="Submit">Reply & Close Ticket</button>

                  <button type="button" class="btn btn-primary float-right saveupdatebtn" value="Submit">Generate Ticket</button>

                  @endif

                  

                  <div id="result"></div>
                </div>


                            </div>
                          </div>

                  </form>        

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
<script type="text/javascript">
    
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function(){
      

        var data = @json($data);

        //console.log(data)

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



    $('#patientname').select2({
        placeholder:'Choose a Patient'
    });



 $(".replyandclose").click(function(){


    let myform=document.getElementById("form");
    let data=new FormData(myform);
    $.ajax({
                    
            url: "../CloseTicket",
            data: data,    
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            }).done(function (response) {

                            if(response > 0) {

                                $("#result").html('Ticket has been Closed successfully!')

                             window.location="../TicketView/"+response;

                            }
                       
                           
                    });
            event.preventDefault();
    }); 


    $(".saveupdatebtn").click(function(){


    let myform=document.getElementById("form");
    let data=new FormData(myform);
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

                             window.location="../TicketView/"+response;

                            }
                       
                           
                    });
            event.preventDefault();
    });



    $(".sendtoocm").click(function(){


    let myform=document.getElementById("form");
    let data=new FormData(myform);
    $.ajax({
                    
            url: "../sendTicketToOCM",
            data: data,    
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            }).done(function (response) {

                            if(response > 0) {

                                $("#result").html('Ticket has been generated successfully!')

                             window.location="../TicketView/"+response;

                            }
                       
                           
                    });
            event.preventDefault();
    }); 


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
                    
                    
                }
            });



    });
</script>
@endpush