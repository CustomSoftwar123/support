@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


      <div class="row">


<div class="col-md-12">   
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">

        <div class="">
  <div class="row">
    <div class="col-sm">



  </div>
  
  <div class="row">
    Remarkss: 
  </div>
 


</div>

 







</div>
</div>
</div>
</div>

<div class="row">


<div class="col-md-12">   
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">

        <div>
             <h4>Kleihauer</h4>
  <table id="table_id" class=" ">
<thead>
  <tr>
    <th>Sample Data</th>
    <th>Lab Number</th>
    <th>Result</th>
    <th>Comment</th>
    </tr>  
  </thead>
    <tbody>
    
     @foreach($kleihauer as $kleihauers)
    <tr>
      <td>{{$kleihauers->DateTime}}</td>
      <td>{{$kleihauers->SampleID}}</td>
      <td>Fetal Cells {{$kleihauers->FetalCells}}</td>
      <td>{{$kleihauers->RH}} - {{$kleihauers->Report}}</td>
      
      </tr> 
    @endforeach


    </tbody>
  </table>
</div>  


</div>
</div>
</div>
</div>


<div class="row">


<div class="col-md-12">   
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">

<div>
<h4>Product History</h4>
  <table id="table_i" class=" ">
<thead>
  <tr>
    <th>Product</th>
    <th>Group</th>
    <th>Unit Number</th>
    <th>Available To</th>
    <th>Status</th>
    <th>Date Time</th>
    </tr>  
  </thead>
    <tbody>
    
    @if(count($data) < 1)
    <div class="alert alert-warning">
        <strong>Sorry!</strong> No Product Found.
    </div>                                      
@else 
    
    @foreach($data['btproducts'] as $btproducts)
    <tr>
      <td>pname</td>
      <td>{{$btproducts->fgroup}}</td>
      <td>{{$btproducts->unitnumber}}</td>
      <td>Pending</td>
      <td>{{$btproducts->status}}</td>
      <td>{{$btproducts->receiveddate}}</td>
      
      </tr> 
    @endforeach
      
@endif 
</tbody>
  </table>
</div>


</div>
</div>
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
        $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    $(document).ready( function () {
        $('#table_i').DataTable();
    } );
</script>

@endpush
