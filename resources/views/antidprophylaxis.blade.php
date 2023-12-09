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




<div class="row">

<div class="col-md-6">
<label class="form-label " for="">Hosp #</label>
<input class="form-control " type="text">

</div>
<div class="col-md-6">
<label class="form-label " for="">Hosp #</label>
<input class="form-control " type="text">
</div>
</div>



<div class="row mt-3">

<div class="col-md-6">
<label class="form-label " for="">D.O.B</label>
<input class="form-control " type="text">

</div>

<div class="col-md-6">
<label class="form-label " for="">Name</label>
<input class="form-control " type="text">

</div>
</div>


<div class="row mt-3">

<div class="col-md-6">
<label class="form-label " for="">Ward</label>
<select class="form-control form-select" aria-label=".form-select-sm example">
  <option value=""></option>
  <option value="ward 1">Ward 1</option>
  <option value="ward 2">Ward 2</option>
  <option value="ward 3">Ward 3</option>
</select>

</div>
<div class="col-md-6">
<label class="form-label " for="">Ward</label>
<select class="form-control form-select" aria-label=".form-select-sm example">
  <option value=""></option>
  <option value="ward 1">Ward 1</option>
  <option value="ward 2">Ward 2</option>
  <option value="ward 3">Ward 3</option>
</select>

</div>

</div>




<div class="row mt-3">

<div class="col-md-6">
<label for="">Group</label>
<input class=" form-control " type="text">
</div>

<div class="col-md-6 ">
<label for="">Group</label>
<input class=" form-control " type="text">
</div>

</div>

<div class="row mt-3">
<div class="col-md-6">

<label class="radio-inline">POS
    <input type="radio" name="optradio">
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">NEG
    </label>

</div>    
<div class="col-md-6">

<label class="radio-inline">POS
    <input type="radio" name="optradio">
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">NEG
    </label>

</div>    
</div>






<div class="row mt-2 mb-3">

<div class="col-md-6">
<label class="form-label " for="">Coombs</label>
<input class="form-control " type="text">
</div>

<div class="col-md-6">
<label class="form-label " for="">A/B Screen</label>
<input class="form-control " type="text">

</div>

</div>






                 <div class="col-md-12">
                   
                 </div>          
         
             

             
                 <table  class="mb-0 table-striped" id="table">      
                           
                           <thead>
                           
                           <tr>


                           <th>Serial</th>
                          <th>Exp</th>
                          <th>Supp</th>
                          <th>Use</th>
              
                            </tr>
                               </thead>
                               
                        
                             </table> 
               
             

   
                   

                   
           
                            </div>
                           </div>
                            <div id="result" class="text-danger"></div>

                  </form>        

        <!-- /.row -->
      </div>
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

  {data: 'serial', name: 'serial'},
    {data: 'exp', name: 'exp'},
   {data: 'supp', name: 'supp'},
   {data: 'use', name: 'use'}
     
],
"order":[[1, 'desc']], 

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



     
    




   

});  
    </script>





@endpush