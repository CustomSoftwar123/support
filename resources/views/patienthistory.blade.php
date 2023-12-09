@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Patient Histroy
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
          
               
                <div class="row border pt-2">
                  <div class="col-md-6  mx-4">
                    <div class="row">
                      <div class="col-md-6 ">
                           <input type="checkbox" name="soundex" class="form-check-input" checked>
                        <label class="form-label">Soundex</label>
                     
                   
                      </div>
                      <div class="col-md-2">
                        <input type="radio" name="name" class="form-check-input">
                        <label class="form-check-label">Name</label>

                      <div class="row">
                        <div class="col-md-12">
                                   <input type="radio" name="name" class="form-check-input">
                                   <label class="form-check-label">Chart</label>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                              <input type="radio" name="name" class="form-check-input">
                              <label class="form-check-label">D.o.B</label>
                      </div>
                      </div>
                      </div>
                      

                    </div>
                  </div>
                  <div class="col-md-5 mt-3">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control"><a href="#" class="btn btn-primary">Search</a>
                    </div>
                    
                  </div>
                </div>
             
            <div class="mt-4">
                            <table  id="table"  class="table">
                              <thead>
                               <tr>
                                  <th>Lab</th>
                                  <th>Antibodies</th>
                                  <th>Name</th>
                                  <th>Chart</th>
                                  <th>D.O.B</th>
                                  <th>Group</th>
                                  <th>Kell</th>
                                  <th>Address</th>
                                  <th>Sample Date</th>
                                  <th>Req</th>
                                  <th>Comment</th>
                                </tr>
                              </thead>
                             </table>
            </div>
            <div class="col-md-12 mt-2">
              <a href="#" class="btn btn-warning">Cancel</a>
            </div>    
              

   
                    

                   
           
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
<script >
$(document).ready(function() {


   
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
var table=$('#table').DataTable({
 
// ajax: {
    
//     url: "{{ route('Clients') }}",
    
// },
 columns: [

    {data: 'lab', name: 'lab'},
    {data: 'antibodies', name: 'antibodies'},
    {data: 'name', name: 'name'},
    {data: 'chart', name: 'chart'},
    {data: 'dob', name: 'dob'},
    {data: 'group', name: 'group'},
    {data: 'kell', name: 'kell'},
    {data: 'address', name: 'address'},
    {data: 'sampledate', name: 'sampledate'},
    {data: 'req', name: 'req'},
    {data: 'comment', name: 'comment'},
    // {data: 'action', name: 'action', orderable: false, searchable: false},
],
"order":[[0, 'desc']], 

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
     


       
    });
     
    




   

}); 
</script>
@endpush