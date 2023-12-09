@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

                      <div class="row">
                        
                    <div class="col-md-4  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="#">
                      <div class="card card-widget mb-0  widget-user-2 bg-primary">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                          <h2><i class="fas fa-file-medical float-right display-5"></i></h2>
                          <h4 id="thisWeek">{{$data['ticketsThisWeek']}}</h4>
                          <h5>Tickets Opened This Week</h5>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </a>
                    </div>
                    <!-- /.col -->



                    <div class="col-md-4  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="#">
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



                    <div class="col-md-4  mt-1">
                      <!-- Widget: user widget style 2 -->
                        <a id="Requests" href="#">
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


          <div class="col-lg-12 mt-3">
            <div class="card">
              <div class="card-body">
        
                   <!--  <span class="text-bold text-lg requestsTotal">182</span> -->
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

                                  //console.log(data)


                                  var label = data.labels;
                                  var values = data.values;
                                  var values2 = data.values2;
                                  var values3 = data.values3;
                                
                                $( label ).each(function(index) {
                    
                                       myChart.data.labels[index] = label[index];
                                       myChart.data.datasets[0].data[index] = values[index];
                                       myChart.data.datasets[1].data[index] = values2[index];
                                       myChart.data.datasets[2].data[index] = values3[index];
                                       myChart.update();
                                })  
                                        

                              }
                              
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
                                                
                                                $( label ).each(function(index) {
                                    
                                                       myChart.data.labels[index] = label[index];
                                                       myChart.data.datasets[0].data[index] = values[index];
                                                       myChart.data.datasets[1].data[index] = values2[index];
                                                       myChart.data.datasets[2].data[index] = values3[index];
                                                       myChart.update();
                                                })  
                                                        

                                              }
                                              
                                          })         


       })


                        

              })




                       





       

</script>

@endpush
