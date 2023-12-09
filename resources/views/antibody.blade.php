@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Clients
               <a class="btn btn-info btn-sm" href="{{route('Clients')}}"><i class="fas fa-arrow-left"></i> Go Back </a>
             </h1>
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Clients</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


                  <form id="form" >
                                       {{ csrf_field() }}
                                                 
                         <div class="card card-primary card-outline">
                            <div class="card-body ">  
                 <div class="col-md-12">
                   
                 </div>          
         
             
             
               
             
                  <table  class="mb-0 table-striped" id="table">      
                           
             <thead>
             
             <tr>
             <th>Antibody Reported</th>
              <th>Chart</th>
              <th>AandE</th>
              <th>Name</th>
              <th>Date of Birth</th>
              <th>SampleID</th>
              <th>Date/Time of Entry</th>


              </tr>
                 </thead>
                 
          
               </table> 
               
             
      <div class="ml-5" >
  <h5>NEQAS</h5>

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" id="" value="include" name="neqas">
  <label class="form-check-label" >Include</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" id="" value="exclude" name="neqas">
  <label class="form-check-label" >Exclude</label>
</div>
</div> 



<button class="btn btn-success ml-5"> Submit </button>
<button class="btn btn-danger ml-1"> Cancel </button>   

                   
           
                            </div>
                           </div>
                            <div id="result" class="text-danger"></div>

                  </form>        

        <!-- /.row -->
      </div>



<!-- 
      <div class="ml-5" >
  <h5>NEQAS</h5>

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" id="" value="include" name="neqas">
  <label class="form-check-label" >Include</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" id="" value="exclude" name="neqas">
  <label class="form-check-label" >Exclude</label>
</div>
</div> 



<button class="btn btn-success ml-5"> Submit </button>

<button class="btn btn-danger ml-1"> Cancel </button> -->


      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>



@extends('layouts.footer')

@push('script')



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

    
var table=$('#table').DataTable({
 // ajax: {
    
//     url: "{{ route('Tickets') }}",
    
// },

 columns: [

    {data: 'Antibody_Reported', name: 'Antibody_Reported'},
    {data: 'Chart', name: 'Chart'},
   {data: 'AandE', name: 'AandE'},
   {data: 'Name', name: 'Name'},
    {data: 'Date_of_Birth', name: 'Date_of_Birth'},
    {data: 'SampleID', name: 'SampleID'},
    {data: 'Date/Time_of_Entry', name: 'Date/Time_of_Entry'}
     
],
"order":[[6, 'desc']], 

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
                { "visible": false, "targets": [] }
                ], 

});


table.on('click', '.delete', function () { 
     
     var id=this.id;

             swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              }).then((willDelete) => {
                  if (willDelete) {
                 
                 $.ajax({
                  type: 'get',
                  url:"deleteTicket/"+id,
                  dataType: '',                  
                  success: function(){
                      
                     table.ajax.reload( null, false );

                        }
                      }); 

   

  } 
});

       
    });
     
    




   

});  
    </script>





@endpush