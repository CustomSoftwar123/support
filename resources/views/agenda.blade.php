@include('layouts.header')
<style>
    .topicth{
        width:30% !important; 
    }
    .colortd{
       background-color: #0A4454;
       color:white;
    }

    .desccolor{
        background-color: white;
        color: black;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-0">
            <div class="col-lg-6">
              <h1 class="m-0" style="width:2rem; display:flex">Agenda
           </h1>
           
            </div><!-- /.col -->
            <div class="col-sm-6  d-none d-sm-none d-md-block ">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Agenda</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="content">
        <div class="container-fluid">
  
      <div class="card card-primary card-outline">
      <div class="card-body table-responsive"> 

        <div class="col-lg-12 text-center">
            <h1 style="color:#0A4454;">Meeting Agenda</h1>
        </div>

        <div class="row" style="border-top: 2px solid black; border-bottom: 2px solid black;  ">
            <div class="col-lg-4 col-md-4 mt-2">
                <p> <b>Date:</b> {{ date('d/m/Y') }}</p> 
            </div>
            
           
            <div class="col-lg-4 col-md-4 mt-2">
                <h6> Time: 9:00 </h6> 
            </div>
    
            <div class="col-lg-4 col-md-4 mt-2">
                <h6>  Location: Boarding Room</h6> 
            </div>
        </div>
       
        
        @foreach ($agenda as $data)

        <div class="row mt-3">
            <div class="col-md-12">

                <table class="table table-striped">
                    {{-- <thead>
                        <th class="topicth">Topic</th>
                        <th class="desccolor">Description</th>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <td class="colortd topicth">Action:</td>
                            <td ><a style="color: black;" href="{{ route('TicketView', ['id' => $data->id]) }}">{{$data->subject}}</a></td>

                        </tr>
                        <tr>
                            <td class="colortd topicth">Action By:</td>
                            <td>{{$data->agenda_dev}}</td>
                        </tr>
                        <tr>
                            <td class="colortd topicth done">Done:</td>
                            <td><input id="done" class="done-check" data-id="{{$data->id}}" type="checkbox"></td>
                        </tr>
                    </tbody>
                </table>
        

        </div>
      </div>
      @endforeach



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
<script  type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $(document).on('change','.done-check',function(){
            alert()
            $.ajax(
                {
                    url:"{{route('agendaDone')}}",
                    method:'Post',
                    data:{
                       tid:$(this).data('id')     
                    }
                }
            ).done(function(response){
                console.log(response)
                if(response==1){
                    location.reload()
                }
            })
        })
        
 var table = $('#table').DataTable({

"lengthMenu": [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50,100, 200, 500, "All"] ],
dom: 'lBfrtip', //"Bfrtip",


processing: true,
serverSide: true,
// stateSave: true,
ajax: {
   url: "{{ route('agenda') }}",
   method: 'GET',
   data:{ListType:"ROL"}
},
columns: [
  
   
   {data: 'agenda_dev', name: 'agenda_dev'},
   {data: 'timetaken', name: 'timetaken'},
   {data: 'ticketid', name: 'ticketid'},
   {data: 'subject', name: 'subject'},
   {data: 'action', name: 'action', orderable: false, searchable: false},
],
"order":[[2, 'asc']],

dom: "Blfrtip",
       buttons: [
       
           {
               title:"",
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
               title:"",
               extend: 'print',
               footer: true,
               exportOptions: {
               columns: [':visible :not(:last-child)']
               },
           }, 
           'colvis'   
       ],

       // columnDefs: [{
       //     orderable: false,
       //     targets: -1,
       // },
       columnDefs: [{
"defaultContent": "-",
"targets": "_all"
},
       { "visible": false, "targets": [] }
       ], 




});



    })
    </script>

@endpush