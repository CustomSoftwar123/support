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
                          
                          <th>id</th>
                          <th>SampleID</th>
                          <th>Patient Name</th>
                          <th>Date of Birth</th>
                          <th>Profile</th>
                          <th>Urgent</th>
                          <th>Sample Date</th>
                          
                          <th>Received Date</th>
                   
                       
             
             
                           
                          
                           
             
             
                           
                           </tr>
             
             
                              </thead>
                              <tbody id="noice">

                              </tbody>
</table >

                              <button class="btn btn-info d-none " style="padding:10px" id="placeholder" >
    Place Order
</button>


            
</div>
      

</div>
           


     
                 
      
      
                   
      
              </div>
</div>
        <!-- /.row -->
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
    console.log(response);
   
// console.log("done");
// esult = $('#results',response).val();
        // var as = $('#as',response).val();
        $("#noice").append(response.html);
console.log(response)

    });

 event.preventDefault();


   }
  

   $("#submit").click(function(){
    $("#placeholder").removeClass('d-none');
    senddata();
   });

 
  
   
// senddata();
// var a= $("#s").val();
// console.log(a);
$(document).on('click', '#placeholder', function () {

var input = document.getElementsByName('ID[]');

k=[];
console.log(input) 
            for (var i = 0; i < input.length; i++) {
                var a = input[i];
                k[i] = a.value  ;
                                   
            }
            var input2 = document.getElementsByName('sID[]');
            
s=[];
            console.log(input2) 
            for (var i = 0; i < input2.length; i++) {
                var b = input2[i];
                s[i] = b.value  ;
                                   
            }
            $.ajax({
    url: "{{ route('Scanpost') }}",
   method: 'POST',
   data : {
k:k,
s:s
}

 })
.done(function(response){
    // window.location="../Scan";
    // Window.location=""
// console.log("done");
// esult = $('#results',response).val();
        // var as = $('#as',response).val();
//         $(".container-fluid").html(response.html);
// console.log(response)

    });
           
   });

});


 
 




                  

    </script>
@endpush