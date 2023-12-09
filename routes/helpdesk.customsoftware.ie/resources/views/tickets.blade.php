@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Tickets
               <a class="btn btn-info btn-sm" href="{{route('Tickets')}}"><i class="fas fa-sync"></i></a>
               
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


              <th>Patient</th>
              <th>Request#</th>
              <th>Sample#</th>

              <th>Status</th>
              <th>Requested</th>
              <th>Assigned</th>
              <th>Resolved</th>
              <th>Department</th>
              <th>Priority</th>
              <th>System</th>
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

                                  <select class="form-control"  id="user" name="user">
                                      <option disabled selected value=""></option>
                                    @foreach ($data as $user)
                                      <option value="{{$user->email}}">{{$user->name}} | {{$user->email}} </option>
                                      @endforeach
                                      
                                      
                                      
                                  </select>

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

$('#user').select2({

    placeholder:'select a user'
});
   
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
var table = $('#table').DataTable({
 
ajax: {
    
    url: "{{ route('Tickets') }}",
    
},
 columns: [

    {data: 'id', name: 'id'},
    {data: 'business', name: 'business'},
    {data: 'ticketid', name: 'ticketid'},
    {data: 'subject', name: 'subject'},
   {data: 'patientname', name: 'patientname'},
   {data: 'requestid', name: 'requestid'},
    {data: 'sampleid', name: 'sampleid'},
    {data: 'status', name: 'status'},
    {data: 'requestedat', name: 'requestedat'},
    {data: 'assignedto', name: 'assignedto'},
    {data: 'resolved', name: 'resolved'},
      {data: 'department', name: 'department'},
        {data: 'priority', name: 'priority'},
        {data: 'internal', name: 'internal'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
],
"order":[[8, 'desc']], 

  dom: "Blfrtip",
                buttons: [
                
                    {
                        title:'Users',
                        text: 'Excel',
                        footer: true,
                        extend: 'excelHtml5',
                        exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    },
                    {
                    title:'Users', 
                    text: 'PDF', 
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    footer: true,
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    customize: function (doc) {
                    doc.content[1].table.widths = 
                              Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                          doc.styles.tableBodyEven.alignment = 'center';
                          doc.styles.tableBodyOdd.alignment = 'center'; 
                                
                        }
                    },
                    {
                        text: 'Print',
                        title:'Users',
                        extend: 'print',
                        footer: true,
                        exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    }, 
                    'colvis'   
                ],

                columnDefs: [{
                    orderable: false,
                    targets: -1,
                },
                { "visible": false, "targets": [0,4,5,6,10,12] }
                ], 

});



table.on('click', '.assign', function () { 
     
     var id=this.id;

       $('#tid').val(id) 
       $('#selectUsers').modal('show');  

});


$(document).on('click', '.assignTicketNowBtn', function() {
        
 
     var tid = $('#tid').val();
     var user = $('#user').val();

     if(user == '' || user == null) {

              Lobibox.notify('warning', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Please select a User.',
                                icon: 'bx bx-info-circle'
                            });
                return false;   
     }

          $.ajax({
                  type: 'post',
                  url:"{{route('assignTicketNow')}}",
                  data: {

                        tid:tid,
                        user:user    
                  },
                  dataType: '',                  
                  success: function(){
                      
                     table.ajax.reload( null, false );
                     $('#selectUsers').modal('hide');  

                        }
                      }); 



       

});













     
    




   

});  
    </script>
@endpush