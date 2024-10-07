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
              <input type="hidden" name="id" id="id">
              <form id="versioncontrol" class="mx-1 mx-md-4">
                @csrf
          
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="form-outline flex-fill mb-0">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="client">Client</label>
                    <input id="client" name="client" type="text" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-outline flex-fill mb-0">
                    <i class="fas fa-code-branch fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="currentversion">Current Version</label>
                    <input id="currentversion" name="currentversion" type="text" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline flex-fill mb-0">
                    <i class="fas fa-code fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="newversion">New Version</label>
                    <input id="newversion" name="newversion" type="text" class="form-control" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline flex-fill mb-0">
                    <i class="fas fa-cogs fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="application">Application</label>
                    <input id="application" name="application" type="text" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col d-none">
                  <div class="form-outline flex-fill mb-0">
                    <i class="fas fa-paper-plane fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="sentDate">Sent Date</label>
                    <input id="sentDate" name="sentDate" type="date" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="d-flex mb-3 mb-lg-4">
                <button id="submit" name="submit" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Submit</button>
                <div class="update-button">
                  <button type="button" class="btn btn-info d-none" id="update">Update</button>
                </div>
              </div>

              </form>


              <div class="row justify-content-center mt-5">
                <div class="col-12" style="width: 90%;">
                  <table class="table table-striped" id="table">
                    <thead>
                      <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Current Version</th>
                        <th scope="col">New Version</th>
                        <th scope="col">Application</th>
                        {{-- <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Sent Date</th> --}}
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
              </div>

    </div>    
    </div>   
      </div>    
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
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  

var table = $('#table').DataTable({

"lengthMenu": [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50,100, 200, 500, "All"] ],
dom: 'lBfrtip', //"Bfrtip",


processing: true,
serverSide: true,
// stateSave: true,
ajax: {
   url: "{{ route('versioncontrol') }}",
   method: 'GET',
   data:{ListType:"ROL"}
},
columns: [
  
   {data: 'client', name: 'client'},
   {data: 'currentversion', name: 'currentversion'},
   {data: 'newversion', name: 'newversion'},
   {data: 'application', name: 'application'},
  //  {data: 'createdAt', name: 'createdAt'},
  //  {data: 'updatedAt', name: 'updatedAt'},
  //  {data: 'sentDate', name: 'sentDate'},
   {data: 'action', name: 'action', orderable: false, searchable: false},

],
"order":[[2, 'asc']],

dom: "Blfrtip",
       buttons: [
       
           {
               title:"Test",
               text: 'Excel',
               footer: true,
               extend: 'excelHtml5',
               exportOptions: {
               columns: [':visible :not(:last-child)']
               },
           },
           {
           title:"", 
           text: 'PDF', 
           extend: 'pdfHtml5',
           exportOptions: {
               columns: [':visible :not(:last-child)']
               },
           footer: true,
           orientation: 'landscape',
           pageSize: 'LEGAL'
           },
           {
               text: 'Print',
               title:"",
               extend: 'print',
               footer: true,
               exportOptions: {
               columns: [':visible :not(:last-child)']
               },
           }, 
           'colvis'   
       ],
       columnDefs: [{
"defaultContent": "-",
"targets": "_all"
},
       { "visible": false, "targets": [] }
       ]
       



});

  
    $("#submit").click(function(){
  

      var form = $("#versioncontrol")[0];
      var formData = new FormData(form);
  
      $.ajax({
        url: "{{ route('versioncontrolsubmit') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response){
          table.ajax.reload();
          if ($.isEmptyObject(response.error)){
                                         Lobibox.notify('success', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,
                                                position: 'top right',
                                                msg: response.success,
                                                icon: 'bx bx-check-circle'
                                            });
 
            }else{
              Lobibox.notify('warning', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,
                                                position: 'top right',
                                                msg: response.error,
                                                icon: 'bx bx-check-circle'
                                            });

            }
        },
        error: function(error){
          alert(error.responseJSON.message);
        }
      });
    });

    $(document).on('click', '.edit', function(){
          $("#update").removeClass('d-none');
          $("#submit").addClass('d-none');

          let client = $(this).closest('tr').find('td:first').text();
          let currentversion = $(this).closest('tr').find('td:nth(1)').text();
          let newversion = $(this).closest('tr').find('td:nth(2)').text();
          let application = $(this).closest('tr').find('td:nth(3)').text();
          

          $("#client").val(client);
          $("#currentversion").val(currentversion);
          $("#newversion").val(newversion);
          $("#application").val(application);
          


          let id = $(this).attr('id');
          $("#id").val(id);
    });

    $("#update").click(function(){
          let id =  $('#id').val();
          let form = $("#versioncontrol")[0];
          let data = new  FormData(form);
          data.append('id', id);

          $.ajax({
          url: "{{ route('versioncontrolupdate') }}",
          type: "POST",
          data : data,
          processData:false,
          contentType:false,
          cache:false,
          success: function(response){
          table.ajax.reload();
          if ($.isEmptyObject(response.error)){
                                         Lobibox.notify('success', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,
                                                position: 'top right',
                                                msg: response.success,
                                                icon: 'bx bx-check-circle'
                                            });
 
            }else{
              Lobibox.notify('warning', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,
                                                position: 'top right',
                                                msg: response.error,
                                                icon: 'bx bx-check-circle'
                                            });

            }
        },
        error: function(error){
          alert(error.responseJSON.message);
        }

        })
        });



        });
  
  
   
  </script>
  

@endpush
