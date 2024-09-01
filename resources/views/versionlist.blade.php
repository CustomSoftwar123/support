@include('layouts.header')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Version Control
            
              <a class="btn btn-info btn-sm" onclick="history.back()"><i class="fas fa-arrow-left"></i> GO BACK </a> 
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
              <li class="breadcrumb-item active">User Roles Mapping </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
              
        <div class="card">
          <div class="card-body">
             


              <div class="row justify-content-center mt-5">
                <div class="col-12" style="width: 90%;">
                  <table class="table table-striped" id="table">
                    <thead>
                      <tr>
                        <th scope="col">Ticket</th>
                        <th scope="col">Change</th>
                        <th scope="col">Version</th>
                        <th>Ticket Completed At</th>

                      </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>

    </div>    
    </div>   
      </div>    
    </div>    
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
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    console.log('Document ready, initializing DataTable...');
// alert(),
var project = @json(request()->segment(count(request()->segments())));

// project.replace(/%20/g, ' ');
console.log('project:', project);
// var url = "{{ route('versionlist', ['project' => '__PROJECT__']) }}".replace('__PROJECT__', project);
// console.log(url);
var encodedProject = encodeURIComponent(project); // Encode project for use in URL
var url = "{{ route('versionlist', ['project' => '__PROJECT__']) }}".replace('__PROJECT__', encodedProject);
  
$('#table').DataTable({
        lengthMenu: [[10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"]],
        dom: 'lBfrtip',
        ajax: {
             url: url,
            method: 'GET',
            // data: { ListType: "ROL" }
        },
        columns: [
            { data: 'ticketid', name: 'ticketid' },
            { data: 'changes', name: 'changes' },
            { data: 'version', name: 'version' },
            { data: 'completedat', name: 'completedat' },
        ],
        order: [[1, 'asc']],
        dom: "Blfrtip",
        // buttons: [
        //     {
        //         title: "Test",
        //         text: 'Excel',
        //         footer: true,
        //         extend: 'excelHtml5',
        //         exportOptions: { columns: [':visible :not(:last-child)'] }
        //     },
        //     {
        //         title: "",
        //         text: 'PDF',
        //         extend: 'pdfHtml5',
        //         exportOptions: { columns: [':visible :not(:last-child)'] },
        //         footer: true,
        //         orientation: 'landscape',
        //         pageSize: 'LEGAL'
        //     },
        //     {
        //         text: 'Print',
        //         title: "",
        //         extend: 'print',
        //         footer: true,
        //         exportOptions: { columns: [':visible :not(:last-child)'] }
        //     },
        //     'colvis'
        // ],
        // columnDefs: [
        //     { "defaultContent": "-", "targets": "_all" },
        //     { "visible": false, "targets": [] }
        // ]
    });





        });
  
  
   
  </script>
  

@endpush
