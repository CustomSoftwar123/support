@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
  <style>

    .counter-cards{
      box-shadow: 8px 5px 3px 3px rgba(0,0,0,0.45);
-webkit-box-shadow: 8px 5px 3px 3px rgba(0,0,0,0.45);
-moz-box-shadow: 8px 5px 3px 3px rgba(0,0,0,0.45);
    }
    </style>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Home
               
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
     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

                      <div class="row">
                        
                    <div class="col-md-3  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="../Tickets/Opened">
                      <div class="card card-widget mb-0  widget-user-2 bg-primary counter-cards">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">
                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek" class='openthisweekdata'>{{$data['ticketsThisWeek']}}</h4>
                          <h5>Tickets Opened</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>
                    <!-- /.col -->



                    <div class="col-md-3  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="../Tickets/Processing">
                      <div class="card card-widget mb-0  widget-user-2 bg-warning counter-cards">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek" class='processingthisweekdata'>{{$data['ticketsProcessing']}}</h4>
                          <h5>Tickets Processing</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>
                    <!-- /.col -->

<div class="col-md-3  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="#" class="Requests">
                      <div class="card card-widget mb-0  widget-user-2 bg-info counter-cards">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek" class="compthisweekdata">{{$data['ticketsCompletedThisWeek']}}</h4>
                          <h5 class="compthisweeklabel">Tickets Completed This Week</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>

                    <div class="col-md-3  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" class="Requests"  href='#'>
                      <div class="card card-widget mb-0  widget-user-2 bg-success counter-cards">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek" class="closedthisweekdata">{{$data['ticketsClosedThisWeek']}}</h4>
                          <h5 class="closedthisweeklabel">Tickets Closed This Week</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>
                    @if(Auth::user()->role<=3)
                    <br>

                    <div class="row">
                        
                      <div class="col-md-3  mt-1">
                        <!-- Widget: user widget style 2 -->
                          <a id="Requests2" href="../tasks">
                        <div class="card card-widget mb-0  widget-user-2 bg-primary counter-cards">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header">
                            <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                            <h4 id="thisWeek2" class='projopenthisweekdata'>{{$data['projticketsThisWeek']}}</h4>
                            <h5>Project Tickets Opened</h5>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </a>
                      </div>
                      <!-- /.col -->
  
  
  
                      <div class="col-md-3  mt-1">
                        <!-- Widget: user widget style 2 -->
                          <a id="Requests2" href="../tasks">
                        <div class="card card-widget mb-0  widget-user-2 bg-warning counter-cards">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header">
  
                            <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                            <h4 id="thisWeek2" class='projprocessingthisweekdata'>{{$data['projticketsProcessing']}}</h4>
                            <h5>Project Tickets Processing</h5>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </a>
                      </div>
                      <!-- /.col -->
  
  <div class="col-md-3  mt-1">
                        <!-- Widget: user widget style 2 -->
                          <a id="Requests2" href="../tasks" class="Requests2">
                        <div class="card card-widget mb-0  widget-user-2 bg-info counter-cards">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header">
  
                            <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                            <h4 id="thisWeek" class="projcompthisweekdata">{{$data['projticketsCompletedThisWeek']}}</h4>
                            <h5 class="projcompthisweeklabel">Project Tickets Completed This Week</h5>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </a>
                      </div>
  
                      <div class="col-md-3  mt-1">
                        <!-- Widget: user widget style 2 -->
                          <a id="Requests2" class="Requests"  href='../tasks'>
                        <div class="card card-widget mb-0  widget-user-2 bg-success counter-cards">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header">
  
                            <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                            <h4 id="thisWeek" class="projclosedthisweekdata">{{$data['projticketsClosedThisWeek']}}</h4>
                            <h5 class="projclosedthisweeklabel">Project Tickets Closed This Week</h5>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </a>
                      </div>
                      @endif
                    <!-- /.col -->
                    
<!-- resources/views/tickets/modal.blade.php -->

<div class="modal fade" id="ticketsModal" tabindex="-1" role="dialog" aria-labelledby="ticketsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketsModalLabel">Tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Duration</th>
                            <th>Total</th>
                            <th>Opened</th>
                            <th>Closed</th>
                            <th>Processing</th>
                            <th>Completed</th>
                            

                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

          <div class="col-lg-12 mt-3">
            <div class="card">
              <div class="card-body">
        
                   <!--  <span class="text-bold text-lg requestsTotal">182</span> -->
                 
                    <h4>
                      Tickets Report
                      @if(Auth::user()->role<=3)
                      <select class="form-control w-25 float-right ml-2 d-none" id="ticketsbreakdown">
                        <option>All</option>
                        <option>Projects</option>
                  </select>
                  @endif
                      <select class="form-control w-25 float-right" id="duration">
                            <option>This Week</option>
                            <option>Last Week</option>
                            <option>This Month</option>
                            <option>Last Month</option>
                      </select>

                    </h4>
         

                <div class="position-relative mb-4">
                  <canvas id="chart" height="390"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->

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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

             
      var label = [];
       var values = [];
        var values2 = [];
         var values3 = [];
         var values4=[];
                                
        $(function () {
                'use strict'

                var ticksStyle = {
                  fontColor: '#495057',
                  fontStyle: 'bold'
                }

                var mode = 'index'
                var intersect = true

                          var myChart = new Chart($('#chart').get(0).getContext('2d'), {

                                type: 'bar',
                                data: {
                                 labels: label,
                                  
                                   datasets: [
                                    {
                                      label: 'Opened',  
                                      backgroundColor: main_color,
                                      borderColor: main_color,
                                      data: values
                                    },
                                    {
                                      label: 'Processing',  
                                      backgroundColor: '#ffc107',
                                      borderColor: '#ffc107',
                                      data: values2
                                    },
                                    {
                                      label: 'Closed',  
                                      backgroundColor: '#00897B',
                                      borderColor: '#00897B',
                                      data: values3
                                    },
                                    {
                                      label: 'Completed',  
                                      backgroundColor: '#17A2B8',
                                      borderColor: '#17A2B8',
                                      data: values4
                                    }
                                  ],

                                  

                                },
                                options: {
                                   plugins: {
                                              legend: {
                                                  display: false,
                                                  labels: {
                                                      color: 'rgb(255, 99, 132)'
                                                  }
                                              }
                                            },
                                  maintainAspectRatio: false,
                                  tooltips: {
                                    mode: mode,
                                    intersect: intersect
                                  },
                                  hover: {
                                    mode: mode,
                                    intersect: intersect
                                  },
                                  scales: {
      x: {
        title: {
          display: true,

        }
      },
      y: {
        title: {
          display: true,
          text: 'Tickets'
        },
        min: 0,
        
        ticks: {
          // forces step size to be 50 units
          stepSize: 1
        }
      }
    }
                                }
                                
                              })


                      var duration = 'This Week';

                        $.ajax({
                              type: "get",
                              url:"{{ route( 'getTicketsReport') }}",
                              data: {'duration' : duration},
                              timeout: 600000,
                              success: function(data) {

                                  console.log(data)


                                  var label = data.labels;
                                  var values = data.values;
                                  var values2 = data.values2;
                                  var values3 = data.values3;
                                  var values4=data.values4;
                                
                                $( label ).each(function(index) {
                    
                                       myChart.data.labels[index] = label[index];
                                       myChart.data.datasets[0].data[index] = values[index];
                                       myChart.data.datasets[1].data[index] = values2[index];
                                       myChart.data.datasets[2].data[index] = values3[index];
                                       myChart.data.datasets[3].data[index] = values4[index];
                                       myChart.update();
                                })  
                                        

                              }
                              
                          }) 

$(document).on('click','.reports',function(){
  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  var duration =$("#duration").val();
  $.ajax({
    type:"post",
    url:"{{route('getTicketsComparison')}}",
    data: {'duration' : duration},
    success:function(data){
      console.log(data)
      // alert
      const ticketsThis = data.ticketsThis;
      const ticketsClosedThis = data.ticketsClosedThis;
      const ticketsOpenedThis = data.ticketsOpenedThis;
      const ticketsProcessingThis = data.ticketsProcessingThis;
      const ticketsCompletedThis = data.ticketsCompletedThis;
      const ticketsLast = data.ticketsLast;
      const ticketsClosedLast = data.ticketsClosedLast;
      const ticketsOpenedLast = data.ticketsOpenedLast;
      const ticketsProcessingLast = data.ticketsProcessingLast;
      const ticketsCompletedLast = data.ticketsCompletedLast;

var extractedPart = duration.substring(5);
$("#ticketsModal .modal-body table tbody").empty();
$("#ticketsModal .modal-body table tbody").append(
                '<tr>' +
                '<td>This '+extractedPart +'</td>'+
                '<td>' + ticketsThis + '</td>' +
                '<td>'+ticketsOpenedThis+'</td>'+
                '<td>'+ticketsClosedThis+'</td>'+
               '<td>'+ ticketsProcessingThis+'</td>'+
               '<td>'+ ticketsCompletedThis+'</td>'+
                '</tr>'+
                '<tr>' +
                '<td>Last '+extractedPart +'</td>'+
                '<td>' + ticketsLast + '</td>' +
                '<td>'+ticketsOpenedLast+'</td>'+
                '<td>'+ticketsClosedLast+'</td>'+
               '<td>'+ ticketsProcessingLast+'</td>'+
               '<td>'+ ticketsCompletedLast+'</td>'+
                '</tr>'
            );
            // $("#ticketsModal .modal-body table thead th:nth-child(1)").text('Tickets HEHE');
            

    $("#ticketsModal").modal('show')

    }

    

  })
})
$(document).on('change', '#ticketsbreakdown', function () { 
  const duration=$("#duration").val()
  if($(this).val()=='All'){
    location.reload()
  }
  // alert()
  $.ajax({
                                              type: "get",
                                              url:"{{ route( 'getTicketsReport') }}",
                                              data: {'duration' : duration,
                                              'param':$(this).val()

                                              },
                                              timeout: 600000,
                                              success: function(data) {

                                                  //console.log(data)
                                                  

                                                  var label = data.labels;
                                                  var values = data.values;
                                                  var values2 = data.values2;
                                                  var values3 = data.values3;
                                                  var values4 = data.values4;
                                                
                                                $( label ).each(function(index) {
                                    console.log(duration);
                                                       myChart.data.labels[index] = label[index];
                                                       myChart.data.datasets[0].data[index] = values[index];
                                                       myChart.data.datasets[1].data[index] = values2[index];
                                                       myChart.data.datasets[2].data[index] = values3[index];
                                                       myChart.data.datasets[3].data[index] = values4[index];
                                                       console.log(myChart.data.labels);
                                                       if(duration=='This Week' || duration=='Last Week' ){
                                                       console.log(myChart.data.labels.splice(6,(myChart.data.labels.length-7)));
                                                      }
                                                      if(duration=='This Month' ){
                                                        var date = new Date();
var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0); var dd = String(lastDay.getDate()).padStart(2, '0'); 
                                                      console.log("s");
                                                       console.log(myChart.data.labels.splice(dd,(myChart.data.labels.length)));
                                                      }
                                                      if(duration=='Last Month'){
                                                        const date = new Date();
var prevl=new Date(date.getFullYear(), date.getMonth(), 0);
var dd1 = String(prevl.getDate()).padStart(2, '0');
console.log(dd);
console.log(myChart.data.labels.splice(dd1,(myChart.data.labels.length)));
                                                      }
                                                      $(".compthisweeklabel").text(`Tickets Completed ${duration}`)
                                                      $(".closedthisweeklabel").text(`Tickets Closed ${duration}`)
                                                       myChart.update();
                                                })  
                                                        

                                              }
                                             
                                              
                                          }) 

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  const projOrAll=this.value;
$.ajax({
  type: "post",
url:"{{ route( 'getProjOrAll') }}",
data: {
'projOrAll':projOrAll,
'duration':duration
},
success: function(data) {
  // alert(duration)
  if(duration=='This Week'){
$(".openthisweekdata").text(data.projOpenedTotal)
$(".processingthisweekdata").text(data.projProcessingTotal)
$(".compthisweekdata").text(data.projectTicketsCompletedThisWeek)
$(".closedthisweekdata").text(data.projectTicketsClosedThisWeek)
  }
  if(duration=='Last Week'){
    $(".openthisweekdata").text(data.projOpenedTotal)
$(".processingthisweekdata").text(data.projProcessingTotal)
$(".compthisweekdata").text(data.projectTicketsCompletedLastWeek)
$(".closedthisweekdata").text(data.projectTicketsClosedLastWeek)
  }

  if(duration=='This Month'){
$(".openthisweekdata").text(data.projOpenedTotal)
$(".processingthisweekdata").text(data.projProcessingTotal)
$(".compthisweekdata").text(data.projectTicketsCompletedThisMonth)
// $(".closedthisweekdata").text(data.projectTicketsClosedThisMonth)
  }
  if(duration=='Last Month'){
    // alert("true")
    console.log(data.projectTicketsCompletedLastMonth)
    $(".openthisweekdata").text(data.projOpenedTotal)
$(".processingthisweekdata").text(data.projProcessingTotal)
$(".compthisweekdata").text(data.projectTicketsCompletedLastMonth)
// $(".closedthisweekdata").text(data.projectTicketsClosedLastMonth)
  }
}
})
})


                          $(document).on('change', '#duration', function () { 

            
                             var duration = this.value;
                             const param=$("#ticketsbreakdown").val()
                            //  alert(param) 
                                        $.ajax({
                                              type: "get",
                                              url:"{{ route( 'getTicketsReport') }}",
                                              data: {'duration' : duration,
                                              'param':param

                                              },
                                              timeout: 600000,
                                              success: function(data) {

                                                  //console.log(data)
                                                  

                                                  var label = data.labels;
                                                  var values = data.values;
                                                  var values2 = data.values2;
                                                  var values3 = data.values3;
                                                  var values4 = data.values4;
                                                
                                                $( label ).each(function(index) {
                                    console.log(duration);
                                                       myChart.data.labels[index] = label[index];
                                                       myChart.data.datasets[0].data[index] = values[index];
                                                       myChart.data.datasets[1].data[index] = values2[index];
                                                       myChart.data.datasets[2].data[index] = values3[index];
                                                       myChart.data.datasets[3].data[index] = values4[index];
                                                       console.log(myChart.data.labels);
                                                       if(duration=='This Week' || duration=='Last Week' ){
                                                       console.log(myChart.data.labels.splice(6,(myChart.data.labels.length-7)));
                                                      }
                                                      if(duration=='This Month' ){
                                                        var date = new Date();
var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0); var dd = String(lastDay.getDate()).padStart(2, '0'); 
                                                      console.log("s");
                                                       console.log(myChart.data.labels.splice(dd,(myChart.data.labels.length)));
                                                      }
                                                      if(duration=='Last Month'){
                                                        const date = new Date();
var prevl=new Date(date.getFullYear(), date.getMonth(), 0);
var dd1 = String(prevl.getDate()).padStart(2, '0');
console.log(dd);
console.log(myChart.data.labels.splice(dd1,(myChart.data.labels.length)));
                                                      }
                                                      $(".compthisweeklabel").text(`Tickets Completed ${duration}`)
                                                      $(".closedthisweeklabel").text(`Tickets Closed ${duration}`)
                                                      $(".projcompthisweeklabel").text(`Project Tickets Completed ${duration}`)
                                                      $(".projclosedthisweeklabel").text(`Project Tickets Closed ${duration}`)
                                                       myChart.update();
                                                })  
                                                        

                                              }
                                             
                                              
                                          })      
                                          
                                          $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

                                          $.ajax({
    type:"post",
    url:"{{route('getTicketsComparison')}}",
    data: {'duration' : duration,
      'param':param
    },
    success:function(data){
      // console.log(data,"testts")
      // alert
      const ticketsThis = data.ticketsThis;
      const ticketsClosedThis = data.ticketsClosedThis;
      const ticketsOpenedThis = data.ticketsOpenedThis;
      const ticketsProcessingThis = data.ticketsProcessingThis;
      const ticketsCompletedThis = data.ticketsCompletedThis;
      const ticketsLast = data.ticketsLast;
      const ticketsClosedLast = data.ticketsClosedLast;
      const ticketsOpenedLast = data.ticketsOpenedLast;
      const ticketsProcessingLast = data.ticketsProcessingLast;
      const ticketsCompletedLast = data.ticketsCompletedLast;
      const projticketsCompletedThis = data.projticketsCompletedThis;
      const projticketsCompletedLast = data.projticketsCompletedLast;
      const projticketsClosedLast = data.projticketsClosedLast;
      const projticketsClosedThis = data.projticketsClosedThis;
      
      
      console.log("Closed This",ticketsClosedThis)
      console.log("Closed Last",ticketsClosedLast)
      console.log(duration,"DURATIONNN")
      if(duration == 'This Week'||duration=='This Month'){
        console.log("HERE NEEW")

        $('.compthisweekdata').text(ticketsCompletedThis)
        $('.projcompthisweekdata').text(projticketsCompletedThis)
        // $('.openthisweekdata').text(ticketsCompletedThis)
        $('.closedthisweekdata').text(ticketsClosedThis)
        $('.projclosedthisweekdata').text(projticketsClosedThis)
        // $('.projclosedthisweekdata').text(ticketsClosedThis)
      }else {
        console.log("HERE")
        $('.compthisweekdata').text(ticketsCompletedLast)
        $('.projcompthisweekdata').text(projticketsCompletedLast)
        $('.closedthisweekdata').text(ticketsClosedLast)
        
      }
    }
  })

       })


                     $(".Requests").click(function(){
                     let duration=$("#duration").val()
                      var text = $('#Requests .widget-user-header h5').text();
                      // var hasClass = ;

                     let condition=$(this).find('h5').text();
                     let status='';

                     if(condition.includes('Completed')){
                      status='Completed'
                     }
                     else if(condition.includes('Closed')){
                      status='Closed'
                     }
                     window.location=`{{route('Tickets')}}/${status}/${duration}`

                     })   

              })




                       





       

</script>

@endpush
