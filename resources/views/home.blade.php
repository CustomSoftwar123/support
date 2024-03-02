@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
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
                      <div class="card card-widget mb-0  widget-user-2 bg-primary">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">
                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek">{{$data['ticketsThisWeek']}}</h4>
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
                      <div class="card card-widget mb-0  widget-user-2 bg-warning">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek">{{$data['ticketsProcessing']}}</h4>
                          <h5>Tickets Processing</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>
                    <!-- /.col -->

<div class="col-md-3  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="../Tickets/Completed">
                      <div class="card card-widget mb-0  widget-user-2 bg-info">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek">{{$data['ticketsCompletedThisWeek']}}</h4>
                          <h5>Tickets Completed This Week</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>

                    <div class="col-md-3  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="../Tickets/Closed">
                      <div class="card card-widget mb-0  widget-user-2 bg-success">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek">{{$data['ticketsClosedThisWeek']}}</h4>
                          <h5>Tickets Closed This Week</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>
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
                   <button class="btn btn-success reports">Reports</button>
                    <h4>
                      Tickets Report
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
  alert()
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


                          $(document).on('change', '#duration', function () { 

            
                             var duration = this.value;

                                        $.ajax({
                                              type: "get",
                                              url:"{{ route( 'getTicketsReport') }}",
                                              data: {'duration' : duration},
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
                                                       myChart.update();
                                                })  
                                                        

                                              }
                                             
                                              
                                          })         


       })


                        

              })




                       





       

</script>

@endpush
