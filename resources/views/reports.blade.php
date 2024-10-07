@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Tickets
               <a class="btn btn-info btn-sm" href="{{(request()->segment(2))}}"><i class="fas fa-sync"></i></a>
               
               <a class="btn btn-info btn-sm" href="{{route('Ticket')}}"><i class="fas fa-plus"></i> Ticket </a>
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
   
    
<div class="row">
    <div class="col-md-2">
      <label for="">From</label>
    <input class="form-control" type="date" name='todate' id="todate">
</div>



<div class="col-md-2">

<label for="">To</label>
    <input class="form-control" type="date" name="tilldate" id="tilldate" >
</div>
<div class="col-md-1">



<label for="">Status</label>
    <!-- <input  class="form-control" type="text" name="status" id="status"> -->
    <select class="form-control" name="status" id="status" >
                                                    <option value="">Choose a Status</option>
                                                      
                                                        <option value="Closed">Closed</option>
                                                        
                                                        <option value="Processing">Processing</option>
                                                        
                                                        <option value="Opened">Opened</option>
                                                        
                                                        <option value="Completed">Completed</option>
                                                     
                                                  </select>  
</div>
<div class="form-group col-md-2">
  <label for="">Assigned To</label>

                                                  <select class="form-control" name="assignedto" id="assignedto" >
                                                    <option value="">Assigned to </option>
                                                        @foreach ($data as $role)
                                                        <option  >{{$role->email}}</option>
                                                        @endforeach
                                                  </select>      
</div>
<div class="form -group col-md-1">
<label>Client</label>
                                        <select class="form-select form-control" name="client" id="client">
                      <option value="" disabled selected>Choose an option</option>
                      <option value="CAVAN">Cavan</option>
                      <option value="TULLAMORE">Tullamore</option>
                      <option value="St.Lukes">St.Lukes</option>
                      <option value="Portlaoise">Portlaoise</option>
                      
                    </select>
</div>
<div class="form-group col-md-2">
  <label for="">Assigned By</label>

                                                  <select class="form-control" name="assignedby" id="assignedby" >
                                                    <option value="">Assigned By </option>
                                                        @foreach ($data as $role)
                                                        <option  >{{$role->email}}</option>
                                                        @endforeach
                                                  </select>      
</div>
<div class="form-group col-md-2 mt-4">

<input type="button" id ="submit" value="Submit" class="btn btn-primary">

</div>
</div>    

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Tickets Report To Admins</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group d-flex justify-content-between w-100">
        <div class="col-md-5">
      <label for="">From</label>
    <input class="form-control" type="date" name='todateemail' id="todateEmail">
</div>

<div class="col-md-5">

<label for="">To</label>
    <input class="form-control" type="date" name="tilldateemail" id="tilldateEmail" >
</div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Subject:</label>
            <input type="text" class="form-control" id="email-subject">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='sendEmail'>Send message</button>
      </div>
    </div>
  </div>
</div>
      <div class="container-fluid">

      
                         <div class="card card-primary card-outline">
                            <div class="card-body table-responsive"> 
             <table id="table"  class="table mb-0 table-striped table">
                                 
             <thead>
             
             <tr>
             
             <th>ID</th>
              <th>Client</th>
              <th>Ticket#</th>
              <th>Subject</th>


             

              <th>Status</th>
              <th>Raised By</th>
              <th>Assigned</th>
              <th>Assigned By</th>

        
              <th>Department</th>
              <th>Priority</th>
              <th>Time</th>
              <th>Timetaken</th>
              <th>Actions</th>
             
              


              
              </tr>


                 </thead>

                
               </table>
            




                 <!-- Modal -->
                <div class="modal fade" id="selectUsers" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Assign Ticket to a User <span id="requestText2"></span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                      
                                 

                              <div class="col-md-12">
                                
                                    <input type="hidden" id="tid"> 


                                  </div>

                                <button type="button" class="mt-2 btn btn-primary assignTicketNowBtn float-right">Assign Now</button>
                                        

                            </div>     

                           
                           
                        </div>
                    </div>
                </div> 




        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
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
   <script>
   
$(document).ready(function() {
 
   
$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 function loadtable () {
  var todate = $("#todate").val();
  var  tilldate= $("#tilldate").val();
  var status = $("#status").val();
  var assignedto = $("#assignedto").val();
  var assignedby = $("#assignedby").val();
  var client = $("#client").val();


 var table = $('#table').DataTable({

"lengthMenu": [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50,100, 200, 500, "All"] ],
// dom: 'lBfrtip', //"Bfrtip",
dom: 'lBfrtip',
        buttons: [
          
'copy','excel',
'csv',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            
              },

              'print',

        ]
,
processing: true,
serverSide: true,
// stateSave: true,

ajax: {
   url: "{{ route('reporte') }}",
   method: 'POST',
   data : {
 todate: todate,
 tilldate:tilldate,
 status:status,
 assignedto:assignedto,
 assignedby:assignedby,
 client:client
}
},

columns: [
  {data: 'id', name: 'id'},
    {data: 'ticket_client', name: 'ticket_client'},
    {data: 'ticketid', name: 'ticketid'},
    {data: 'subject', name: 'subject'},
 
    {data: 'status', name: 'status'},
    {data: 'username', name: 'username'},
    {data: 'assignedto', name: 'assignedto'},
    {data: 'assignedby', name: 'assignedby'},
    // {data: 'resolved', name: 'resolved'},
      {data: 'department', name: 'department'},
        {data: 'priority', name: 'priority'},
        {data: 'created_at', name: 'created_at'},

        {data: 'timetaken', name: 'timetaken'},
        { 
            data: null, // Use null for custom column without data source
            name: 'action', // Name for the column (optional)
            orderable: false, // Disable ordering on this column
            searchable: false, // Disable searching on this column
            render: function (data, type, row) {
                // Custom render function for the action column
                var url = "{{ route('TicketView', ['id' => ':id']) }}".replace(':id', row.id);
                return '<a href="' + url + '" class="btn btn-primary"><i class="fas fa-eye"></i></a>';
            }
        }
      ],
"order":[[1, 'asc']],


  
});

 }
  



    $("#submit").click(function(){ 
      var todate = $("#todate").val();
  var  tilldate= $("#tilldate").val();
      $('#table').DataTable().destroy();
      if(todate!="" && tilldate==""){
Lobibox.notify('warning', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Date is required',
                                icon: 'bx bx-info-circle'
                            });
                            return false;

}
else if(todate=="" && tilldate!=""){
  Lobibox.notify('warning', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Date is required',
                                icon: 'bx bx-info-circle'
                            });
                            return false;
}

      loadtable();


    })
    $("#sendEmail").click(function(){ 
      const toDate = $("#todateEmail").val();
  const  tillDate= $("#tilldateEmail").val();
  const  emailSubject= $("#email-subject").val();
  const  messageText= $("#message-text").val();
console.log(toDate,tillDate,emailSubject,messageText,'Test')
  $.ajax({
    method: 'POST',
                
                url: "{{route('SendReportEmail')}}",
                data: {
                  toDate,
                  tillDate,
                  emailSubject,
                  messageText
                },    
               
                }).done(function (response) {
    console.log(response);

    // Display a success message using Lobibox
  
}).fail(function (xhr, status, error) {
    console.error(xhr.responseText);

    // Display an error message using Lobibox
    Lobibox.notify('error', {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: 'top right',
                                            msg: response.error,
                                            icon: 'bx bx-check-circle'
                                        });

    })

    Lobibox.notify('success', {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: 'top right',
                                            msg: 'Email will be sent shortly',
                                            icon: 'bx bx-check-circle'
                                        });
$('#exampleModal').modal('hide')
 
   });
   });


   
 
 



                  

    </script>
@endpush