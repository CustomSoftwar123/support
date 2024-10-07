<!-- resources/views/tickets/index.blade.php -->
@include('layouts.header')

<div class="content-wrapper">

<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
  <div class="row mb-0">
    <div class="col-sm-6">
      <h1 class="m-0">Outstanding Tickets
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
<div class="container-fluid">

<div class="card card-primary card-outline p-2">
<div class="row">
    <div class="col-md-2">
      <label for="">Date</label>
    <input class="form-control" type="date" name='todate' id="todate">
</div>
<div class="col-sm-1">
                                        <label class="text-white">.</label>
                                        <button type="button" class="btn btn-primary btn-block" id="search">Search</button>
                                    </div>
</div>
</div>
</div>

<!-- Main content -->
<div class="content">


                            <div class=" card card-body table-responsive"> 
    <table id="tickets-table"class="table mb-0 table-striped table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>Assigned To</th>
                <th>Created By</th>
                <th>Ticket Created At</th>
                <th>Client</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
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
<script type="text/javascript">
$(document).ready(function() {
    var table =$('#tickets-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{ 
          url:'{!! route('dailyreportsdata') !!}',
          data: function (d) {
                d.date = $('#todate').val(); // Dynamically fetch the value of #todate input
                
            }
      },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ticketid', name: 'ticketid' },
            { data: 'subject', name: 'subject' },
            { data: 'assignedto', name: 'assignedto' },
            { data: 'createdby', name: 'createdby' },
            { data: 'ticket_created_at', name: 'ticket_created_at',
              "render": function (data, type, row) {
                  return moment(data).format('DD-MM-YYYY HH:mm');
              }
             },
            { data: 'client', name: 'client' },

             { 
            data: null, // Use null for custom column without data source
            name: 'action', // Name for the column (optional)
            orderable: false, // Disable ordering on this column
            searchable: false, // Disable searching on this column
            render: function (data, type, row) {
                // Custom render function for the action column
                var url = "{{ route('TicketView', ['id' => ':id']) }}".replace(':id', row.ticket_view_id);
                return '<a href="' + url + '" class="btn btn-primary"><i class="fas fa-eye"></i></a>';
            }
        }
        ]
    });
    $('#search').on('click', function() {
        table.draw();
    });
});
</script>
@endpush

