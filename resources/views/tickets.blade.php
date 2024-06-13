@include('layouts.header')
  <style>
      *{
    margin: 0;
    padding: 0;
}
.rate {
    /* width: 37.9%; */
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

  </style>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Tickets
               <a class="btn btn-info btn-sm" href="{{(request()->segment(2))}}"><i class="fas fa-sync"></i></a>
               @if(request()->segment(2)==='task')
               
               <a class="btn btn-info btn-sm" href="{{route('Ticket')}}/task/{{request()->segment(3)}}"><i class="fas fa-plus"></i> Ticket </a>
             @else
             <a class="btn btn-info btn-sm" href="{{route('Ticket')}}"><i class="fas fa-plus"></i> Ticket </a>
@endif
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

  <div class="content">
      <div class="container-fluid">

            
                         <div class="card card-primary card-outline">

                            
                                
                                <div class="row p-3">
                                    
                                    <div class="col-sm-1">
                                        <label>Ticket ID</label>
                                        <input type="text" class="form-control" id="ticketid">
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" id="subject">
                                    </div>


                                    <div class="col-sm-2">
                                        <label>Raised By</label>
                                        <input type="text" class="form-control" id="raisedby">
                                    </div>

                                    <div class="col-sm-2">
                                        <label>From</label>
                                        <input class="form-control" type="date" name='todate' id="fromdate">

                                    </div>

                                    <div class="col-sm-2">
                                        <label>To</label>
                                        <input type="date" class="form-control" id="todate">
                                    </div>
                                    @if(auth::user()->role<=4)

                                    <div class="col-sm-2">
                                        <label>Client</label>
                                        <select class="form-select form-control" name="client" id="client">
                      <option value="" disabled selected>Choose an option</option>
                      <option value="CAVAN">Cavan</option>
                      <option value="TULLAMORE">Tullamore</option>
                      <option value="St.Lukes">St.Lukes</option>
                      <option value="Portlaoise">Portlaoise</option>
                      
                    </select>
                                    </div>
@endif

                                    <div class="col-sm-2">
                                        <label>Priority</label>
                                        <select type="text" class="form-control" id="priority">
                                            <option>All</option>
                                            <option>Critical</option>
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-2 d-none">
                                        <label>Status</label>
                                        <input type="text" readonly class="form-control" id="status" value="{{ request()->segment(2) !== 'ALL' ? request()->segment(2) : '' }}">

                                    </div>
                                    <div class="col-sm-2 d-none">
                                        <label>TaskId</label>
                                        <input type="text" readonly class="form-control" id="task" value="{{ request()->segment(2) =='task'?  request()->segment(3) : '' }} ">

                                    </div>

                                    


                                    <div class="col-sm-1">
                                        <label class="text-white">.</label>
                                        <button type="button" class="btn btn-primary btn-block" id="search">Search</button>
                                    </div>





                                </div>

                         

                         </div>
        </div>
  </div>      

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

            
                         <div class="card card-primary card-outline">
                            <div class="card-body table-responsive"> 
             <table id="table"  class="table mb-0 table-striped table">
                                 
             <thead>
             
             <tr>
             
              <th>ID</th>
              
              <th >Client</th>
                
              <th>Ticket#</th>
              <th>Subject</th>


              <th>Patient</th>
              <th>Request#</th>
              <th>Sample#</th>

              <th>Status</th>
              <th>Raised By</th>
              <th>Assigned To</th>
              <th>Assigned by</th>
              <th>Department</th>
              <th>Priority</th>
              <th>System</th>
              <th>Time</th>
              <th>Timetaken</th>
            
              

              <th>Actions</th>

            </tr>


                 </thead>
          
               </table>
            




                 <!-- Modal -->
                <div class="modal fade" id="selectUsers" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                          
                            
                                <h5 class="modal-title text-white">Assign Ticket to a User <span id="requestText2"></span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>

                            </div>
                            <div class="modal-body">
                                      
                                 

                              <div class="col-md-12">
                                
                                    <input type="hidden" id="tid"> 
                                    @if(Auth::user()->role==4||Auth::user()->role==5)
                                  <select class="form-control"  id="user" name="user">
                                      <option disabled selected value=""></option>
                                    @foreach ($data3 as $user)
                                      <option value="{{$user->email}}">{{$user->name}} | {{$user->email}} </option>
                                      @endforeach
                                     @elseif(Auth::user()->role<=3)
                                     <select class="form-control"  id="user" name="user">
                                      <option disabled selected value=""></option>
                                    @foreach ($data2 as $user)
                                      <option value="{{$user->email}}">{{$user->name}} | {{$user->email}} </option>
                                      @endforeach
                                      @endif
                                  </select>

                                  </div>

                                <button type="button" class="mt-2 btn btn-primary assignTicketNowBtn float-right">Assign Now</button>
                                        

                            </div>     

                           
                           
                        </div>
                    </div>
                </div> 
              
              
     
<div class="row">

          <div class="modal fade" id="ratings" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-md  modal-dialog">
                        <div class="modal-content">
                           
          <div class="card card-primary ">
              <div class="card-body ">
               
        
          

                <div id="noice">

              </div>
            </div>



            </div>
</div>               

          </div>

          </div>
</div>        </div>      

</div>
</div>  

        </div>
        <div class="modal fade" id="rateUsers" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                          
                            
                                <h5 class="modal-title text-white">Rate The agent <span id="requestText2"></span></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                               
                              </button>

                            </div>

                            <div class="modal-body" style="overflow: hidden"><div  style="display:flex;justify-content:center;align-item:center;flex-direction:column" >
                                     
                           
                                      <div class="rate mb-4" style="width:70%">
    <input type="radio" id="star5" name="rate" value="5"  />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>

  <div class="d-flex " style="justify-content:space-between; width:100% ">
    <div>
  <label for="html" class="mt-">Was the response timely?</label><br>
    </div>
  <div class='d-flex' style="justify-content:space-evenly">
  <div class="form-check">
  <input class="form-check-input" type="radio" value="1" id="flexCheckDefault" name="time">
  <label class="form-check-label mr-2" for="flexCheckDefault">
   Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" value="0" id="flexCheckChecked" name="time">
  <label class="form-check-label" for="flexCheckChecked">
    No
  </label>
</div>

</div>
</div>

<div class="d-flex time" style="justify-content:space-between; width:100% ">
    <div>
  <label for="html" class="mt-">Was the response satisfactory?</label><br>
    </div>
  <div class='d-flex' style="justify-content:space-evenly">
  <div class="form-check">
  <input class="form-check-input" type="radio" value="1" id="flexCheckDefault" name="satisfy">
  <label class="form-check-label mr-2" for="flexCheckDefault">
   Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" value="0" id="flexCheckChecked" name="satisfy">
  <label class="form-check-label" for="flexCheckChecked">
    No
  </label>
</div>
</div>


</div>
<div class="d-flex " style="justify-content:space-evenly; width:100% ">
   <div>
  <label for="html" class="mt-3">Additional Comments:</label><br>
    
 <textarea name="comments" id="comments" cols="25" rows="5"></textarea>
  </div>
</div>

                                </div>
                                <button type="button" class="mt-2 btn btn-primary ratenow float-right">Rate Now</button>
                                        
                                
                            </div>     

                           
                           
                        </div>
                    </div>
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
  var a=$(".buttons-columnVisibility").attr('data-cv-idx');
console.log(a)  




   
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 

  var role = {!! json_encode((array)auth()->user()->role) !!}
  // alert(role);
  // console.log(role)


                

     load_data(role);
     
  function load_data(type ='',role)
     {
  var role = {!! json_encode((array)auth()->user()->role) !!}


$('#search').click( function() {

         if ($.fn.DataTable.isDataTable('#table')) {
        $('#table').DataTable().destroy();
    }
        tickets();

})

$(document).ready(function () {
    // Call the tickets() function after one second (1000 milliseconds)
    setTimeout(function () {
        tickets();
    }, 500);
});



function tickets() {


// alert($("#task").val());
// let task=

var table = $('#table').DataTable({
  "paging": true,
  "processing": true,
  "serverSide": true,
  "ajax": {
    "url": "{{ route('Tickets') }}",
    "type": "POST",
    "data": {
     
      "status": $("#status").val()==='task'?'':$("#status").val(),
      "ticketid": $("#ticketid").val(),
      "subject": $("#subject").val(),
      "priority": $("#priority").val(),
      "raisedby": $("#raisedby").val(),
      "fromdate": $("#fromdate").val(),
      "todate": $("#todate").val(),
      "client": $("#client").val(),
      "task":Number($("#task").val())?Number($("#task").val()):''

    }
  },
  "stateSave": true,
  "columns": [
    { "data": "id", "name": "id" },
    { "data": "client", "name": "client" },
    { "data": "ticketid", "name": "ticketid" },
    { "data": "subject", "name": "subject" },
    { "data": "patientname", "name": "patientname" },
    { "data": "requestid", "name": "requestid" },
    { "data": "sampleid", "name": "sampleid" },
    { "data": "status", "name": "status" },
    { "data": "username", "name": "username" },
    { "data": "assignedto", "name": "assignedto", "className": "assigned" },
    { "data": "assignedby", "name": "assignedby" },
    { "data": "department", "name": "department" },
    { "data": "priority", "name": "priority" },
    { "data": "internal", "name": "internal" },
    {"data": "created_at",
    "name": "created_at",
    "render": function (data, type, row) {
        if (type === 'display' || type === 'filter') {
            // Format the date and time in DD-MM-YY HH:mm:ss format
            return moment(data).format('DD-MM-YYYY HH:mm');
        } else {
            // If not displaying or filtering, return the original data
            return data;
        }
    }
    },
    { "data": "timetaken", "name": "timetaken" },
    {
      "data": "action",
      "name": "action",
      "orderable": false,
      "searchable": false
    }
  ],
  "order": [[14, 'desc']],
  "dom": "Blfrtip",
  "buttons": [
    {
      "title": "Tickets",
      "text": "Excel",
      "footer": true,
      "extend": "excelHtml5",
      "exportOptions": {
        "columns": [":visible:not(:last-child)"]
      }
    },
    {
      "title": "Tickets",
      "text": "PDF",
      "extend": "pdfHtml5",
      "exportOptions": {
        "columns": [":visible:not(:last-child)"]
      },
      "footer": true,
      "orientation": "landscape",
      "pageSize": "LEGAL",
      "customize": function (doc) {
        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        doc.styles.tableBodyEven.alignment = 'center';
        doc.styles.tableBodyOdd.alignment = 'center';
      }
    },
    {
      "text": "Print",
      "title": "Tickets",
      "extend": "print",
      "footer": true,
      "exportOptions": {
        "columns": [":visible:not(:last-child)"]
      }
    },
    'colvis'
  ],
 "columnDefs": [
    {
        "searchable": true,
        "orderable": false,
        "targets": -1
    },
    {
        "targets": [3], // Index of the 'Subject' column, assuming it's the 4th column (0-based index)
        "width": "30%"
    },
    {
        "targets": [14], // Index of the 14th column
        "width": "100px"
    },
    {
        "targets": [13], // Index of the 14th column
        "width": "100px"
    },
    { "visible": false, "targets": [0, 4, 5, 6, 9, 10, 11, 15] }
],
  "searching": false
});



let elements = document.getElementsByName("name");

table.on('click','.assigned',function(){
var id=$(this).text();
console.log(id);
if(id!=""){
  $('#ratings').modal('show');  

}
var obj={
email:id
};

// let data1=new FormData(id);
// data1.append('email',id)
$.ajax({

url:"{{route('userRate')}}",
method:'Post',
data:obj

}).done(function(response){

  // $('.modal')
  $("#noice").html(response);
});


});

table.on('click', '.assign', function () { 
    var id = this.id;
    $('#tid').val(id);

    $('#selectUsers').on('shown.bs.modal', function () {
        // $('#user').select2();
      $('#user').select2({
         dropdownParent: $("#selectUsers")
      });

    });

    $('#selectUsers').modal('show');  
});

table.on('click', '.rates', function () { 
    //  var name=document.getElementsByName('ticketid').val();
    //  var id=this.name;
    var c=" cost";

    // id=this.document.getElementsByClassName('cost');
    // var id = $(this).closest("tr")   // Finds the closest row <tr> 
    //                    .find("td:eq(0)")     // Gets a descendent with class="nr"
    //                    .text();   

    // var id = $(this).find("td").text();    
    // id = $(this).closest('tr').find('td.cost').text();
var id=document.getElementById('cost');
// console.log(id)
text=this.id;
// let text = id.item();
    console.log(text);

    //    $('#tid').val(id) 
       $('#rateUsers').modal('show');  
    

// console.log("Noice");
$('.ratenow').on('click',function (){
 var v=$(".rate input[type='radio']:checked").val();
 var t=$("input[name='time']:checked").val();
 var s=$("input[name='satisfy']:checked").val();
 var comment=$("#comments").val();

//  return 1;
// });
 
// alert(v);
    // let myform=document.getElementById("form");
    let data1=new FormData();
    data1.append("check",v);
    data1.append("time",t);
    data1.append("satisfy",s);
    data1.append("comment",comment);
    
    data1.append("tid",text);

$.ajax({
  url: "{{ route('rateNow') }}",
            method: 'POST',
            data:data1,
            cache : false,
    processData: false,
    contentType: false
})
.done(function (response) {
console.log(response);
if(response > 0) {

    // $("#result").html('Ticket has been Closed successfully!')

//  window.location="../TicketView/"+response;

}


});

    })

});

}



}


$(document).on('click', '.assignTicketNowBtn', function() {
        
 
     var tid = $('#tid').val();
     var user = $('#user').val();

     if(user == '' || user == null) {

              Lobibox.notify('warning', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Please select a User.',
                                icon: 'bx bx-info-circle'
                            });
                return false;   
     }

          $.ajax({
                  type: 'post',
                  url:"{{route('assignTicketNow')}}",
                  data: {

                        tid:tid,
                        user:user    
                  },
                  dataType: '',                  
               
                      }).done(function (response) {
console.log(response);
if(response > 0) {
  var ref = $('#table').DataTable();
ref.ajax.reload(null,false)
                      $('#selectUsers').modal('hide');

    

}


});

event.preventDefault();

                   

});











var segment3 = '{{ request()->segment(3) }}';

if (segment3 !== '') {
  $.ajax({
    url: "{{ route('sendMail') }}",
    data: {
      tid: segment3
    },
    cache: false,
    processData: true,
    contentType: false,
    type: 'GET'
  });
}


     
    




   

});  
    </script>
@endpush