@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          
          <div class="col-lg-6">
            

            <h1 class="m-0" style="width:2rem; display:flex">Tasks
         
         </h1>
         
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Timeline</li>
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





                                <table id="table" class="table mb-0 table-striped">
                                  
                                  <thead>
                                    <tr>
                            
                                      <th>TicketId</th>
                                      <th>Text</th>
                                      <th>User email</th>
                                      <th>Status</th>
                                      
                                   
                                    </tr>
                                  </thead> 

                                  <tfoot>
                                    <tr>
                                  
                                      <th>TicketId</th>
                                      <th>Text</th>

                                    <th>User email</th> 
                                     <th>Status</th>
                                    
                                    </tr>
                                  </tfoot> 


                                </table>                 
                            </div>
                        </div> 
     


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


<script type="text/javascript">
    $(document).ready(function () {

        // $("#assignto").select2({
        //     placeholder: "Select Users",
        //     multiple: true
        // });

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


 var table = $('#table').DataTable({

         "lengthMenu": [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50,100, 200, 500, "All"] ],
        dom: 'lBfrtip', //"Bfrtip",


        // processing: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            url: "{{ route('ticketstimeline') }}",
            type: 'POST',
        },
         columns: [
            {data: 'ticketid', name: 'TicketId'},
            {data: 'text', name: 'Text'},
            {data: 'useremail', name: 'User email'},
            {data: 'status', name: 'Status'},
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



        initComplete: function () {
            this.api().columns(0).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "id";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
             this.api().columns(1).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "subject";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
             this.api().columns(2).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "description";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });

             this.api().columns(3).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "department";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });

            this.api().columns(4).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "status";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });

            this.api().columns(5).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "created_at";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
        }
    });




$("#addtask").click(function(){

    let myform = $("#myform")[0];
    let data = new FormData(myform);

    $.ajax({
        url:"{{route('addtask')}}",
        type:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,

    }).done(function(response){

          if ($.isEmptyObject(response.error)){
                      Lobibox.notify('success', {
                             pauseDelayOnHover: true,
                             continueDelayOnInactiveTab: false,
                             position: 'top right',
                             msg: response.success,
                             icon: 'bx bx-check-circle'
                         });
                       table.ajax.reload( null, false );
                    
                       $('#myform')[0].reset();
                       $("#assignto").val(null).trigger('change');

                      
         }
         else{
                Lobibox.notify('error', {
                             pauseDelayOnHover: true,
                             continueDelayOnInactiveTab: false,
                             position: 'top right',
                             msg: response.error,
                             icon: 'bx bx-check-circle'
                         });
         }

    });

    event.preventDefault();
});



table.on('click', '.viewTickets', function() {

    const id = $(this).attr('id');
    window.location="{{route('Tickets')}}/task/"+id;
  
    $.ajax({
            url:"{{route('Tickets')}}",
            type:"POST",
            data:{
                id:id,
            }
        }).done(function(response){

                // if(response){
                //     $("#subject").val(response.row[0]['subject']);
                //     $("#department").val(response.row[0]['department']);
                //     $("#description").val(response.row[0]['description']);
                //     $("#status").val(response.row[0]['status']);
                //     $("#id").val(response.row[0]['id']);


                //     $("#addtask").addClass('d-none');
                //     $("#updatetask").removeClass('d-none');

                // }

        })

})

table.on('click', '.edit', function() {


        const id = $(this).attr('id');
        
        $.ajax({
            url:"{{route('edittask')}}",
            type:"POST",
            data:{
                id:id,
            }
        }).done(function(response){

                if(response){
                    $("#subject").val(response.row[0]['subject']);
                    $("#department").val(response.row[0]['department']);
                    $("#description").val(response.row[0]['description']);
                    $("#status").val(response.row[0]['status']);
                    $("#id").val(response.row[0]['id']);


                    $("#addtask").addClass('d-none');
                    $("#updatetask").removeClass('d-none');

                }

        })
      

            
   })


$(document).on('click','#updatetask' ,function(){

    let myform = $("#myform")[0];
    let data = new FormData(myform);

    $.ajax({
        url:"{{route('updatetask')}}",
        type:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,

    }).done(function(response){

         if ($.isEmptyObject(response.error)){
                     Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: response.success,
                            icon: 'bx bx-check-circle'
                        });
                      table.ajax.reload( null, false );
                      
                      $('#myform')[0].reset();
                      $("#assignto").val(null).trigger('change');
                      
        }
        else{
               Lobibox.notify('error', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: response.error,
                            icon: 'bx bx-check-circle'
                        });
        }
    })

})

  table.on('click', '.delete', function() {

        
        const id = $(this).attr('id');

        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            
            $.ajax({
            url:"{{route('deletetask')}}",
            type:"POST",
            data:{
                id:id,
            },
        }).done(function(response){
            
            if ($.isEmptyObject(response.error)){
                     Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: response.success,
                            icon: 'bx bx-check-circle'
                        });
                      table.ajax.reload( null, false );
                      
        }
        else{
               Lobibox.notify('error', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            msg: response.error,
                            icon: 'bx bx-check-circle'
                        });
        }

        });

           } 
        });

        

 });

    
        
    


            


    });

</script>
@endpush