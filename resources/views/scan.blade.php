@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Tickets
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


     <!-- Main content -->
    <div class="content">
   
    

<div class="row">
<div class="form-group col-md-3" >
<input type="text" class="form-control" placeholder="Sample #" id="sampleid" >
</div>
<div class="form-group col-md-4">

<input type="button" id ="submit" value="Submit" class="btn btn-primary">
</div>
</div>    

 
      <div class="container-fluid">

      
                         <div class="card card-primary card-outline">
                            <div class="card-body table-responsive"> 
             <table id=""  class="">
                          
             <thead>
             
             <tr>
             
             <th>Chart</th>
            


              
             
              


              
              </tr>


                 </thead>
<tbody>
<tr>
    <?php 
        // print_r($array);
        for($m=0;$m<count($array);$m++){
        ?>
       
    <td> {{$array[$m]['ID']}}</td>
   
    <?php }?>
    </tr>
</tbody>
                
               </table>
            


<button class="btn btn-info" style="padding:10px">
    Placeholder
</button>

             

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
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
 
    function senddata () {
  var sid = $("#sampleid").val();
 
 $.ajax({
    url: "{{ route('ScanSample') }}",
   method: 'POST',
   data : {
sid:sid
}

 })
.done(function(response){
// console.log("done");
// esult = $('#results',response).val();
$('.content').html(response.html);
console.log(response)

    });

 event.preventDefault();


   }

   $("#submit").click(function(){
senddata();
   });
  
});


 
 



                  

    </script>
@endpush