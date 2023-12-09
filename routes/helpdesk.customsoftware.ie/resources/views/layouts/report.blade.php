<?php

$interface = $data['reportInfo'][0]->interface;

if($data['reportInfo'][0]->interface == 'Table' && $data['reportInfo'][0]->report == 'Samples' ) {

 ?>

<div class="table-responsive mb-3 bg-white p-3">
<table id="table" class="table tableResutls">
<thead>

<tr>
  <th>Datetime</th>
 <?php 
foreach($data['report'] as $column) {

    $column = $column->column_;         
    $column2 =  App\Http\Controllers\reports::GetColumnName($column ,$data['reportInfo'][0]->report);

               
               if(count($column2) ==  0) {

                    if($column == 'reflexed' || $column == 'addon') {

                         $column_ = $column.' Test';
                    } 

                    else  {

                          if($column == 'units') {

                              $column_ = 'Filled(ML)'; 
                          } 
                          elseif($column == 'capacity') {

                              $column_ = $column.'(ML)'; 
                          }  
                          else {

                              $column_ = $column; 
                          }
                    }
               }
                else {

                     $column_ = $column2[0]->table2.'.'.$column2[0]->value1;
              }

?>
<th style="text-transform: capitalize;">{{$column_}}</th>
<?php }  ?>
<th></th>
</tr>



</thead>


<tfoot>

<tr>
<th></th>
 <?php 
foreach($data['report'] as $column) {
?>
<th></th>
<?php }  ?>
<th></th>
</tr>



</tfoot>
</table>
</div>

<?php }

elseif($data['reportInfo'][0]->interface == 'Table' && $data['reportInfo'][0]->report == 'Activity Logs' ) {

 ?>

<div class="table-responsive mb-3 bg-white p-3">
<table id="table" class="table tableResutls">
<thead>

<tr>

 <?php

foreach($data['report'] as $column) {

    $column = $column->column_;         
    $column2 =  App\Http\Controllers\reports::GetColumnName($column ,$data['reportInfo'][0]->report);

               
               if(count($column2) ==  0) {

                    $column_ = $column; 
               }
                else {

                     $column_ = $column2[0]->table2.'.'.$column2[0]->value1;
              }

?>
<th style="text-transform: capitalize;">{{$column_}}</th>
<?php }  ?>

</tr>



</thead>


<tfoot>

<tr>
 <?php 
foreach($data['report'] as $column) {
?>
<th></th>
<?php }  ?>
</tr>



</tfoot>
</table>
</div>

<?php }

elseif($data['reportInfo'][0]->interface == 'Table' && $data['reportInfo'][0]->report == 'Results' ) {

 ?>

<div class="table-responsive mb-3 bg-white p-3">
<table id="table" class="table tableResutls">
<thead>

<tr>

 <?php

foreach($data['report'] as $column) {

    $column = $column->column_;         
    $column2 =  App\Http\Controllers\reports::GetColumnName($column ,$data['reportInfo'][0]->report);

               
               if(count($column2) ==  0) {

                    $column_ = $column; 
               }
                else {

                     $column_ = $column2[0]->table2.'.'.$column2[0]->value1;
              }

?>
<th style="text-transform: capitalize;">{{$column_}}</th>
<?php }  ?>

</tr>



</thead>


<tfoot>

<tr>
 <?php 
foreach($data['report'] as $column) {
?>
<th></th>
<?php }  ?>
</tr>



</tfoot>
</table>
</div>

<?php }


elseif($data['reportInfo'][0]->interface == 'Pie Chart') {

      ?>
      <div class="row">
      <?php

      $sr = 0;
      foreach($data['maindata'] as $key => $maindata) {  
      $sr = $sr+1;  
         // echo '<pre>';
         //  print_r($data['maindata']['Samples Count']['values']);
          //$data['maindata'][$key]['labels']
          //$total .= $data['maindata'][$key]['values'];
          ?>

           

          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span><?php echo $data['maindata'][$key]['name'];?> 
                    <span class="duration">{{$data['date']}}</span>
                    -
                    <span class="total{{$sr}}"></span>
                  </span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="<?php echo str_replace(" ","",$data['maindata'][$key]['name']); ?>-chart" height="250"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->

           <script type="text/javascript">

                function getRndInteger(min, max) {
                  return Math.floor(Math.random() * (max - min + 1) ) + min;
                }

                function random_rgba() {
                    var o = Math.round, r = Math.random, s = 255;
                    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + 1 + ')';
                } 

                     // var  label = ['', '', '', '', '', '', ''];
                    

                       var label = @json($data['maindata'][$key]['labels']);
                       var values = @json($data['maindata'][$key]['values']);

                
                          var sum = values.reduce(function(a, b){
                              return a + b;
                          }, 0);
                          
                        $('.total<?=$sr?>').text(sum);
        
                       

                 var $topTests = $('#<?php echo str_replace(" ","",$data['maindata'][$key]['name']); ?>-chart');
                  var topTests = new Chart($topTests, {
                    
                          type: 'polarArea',      
                          data: {
                            labels: label,
                            datasets: [{
                              data: values,
                               backgroundColor: [
                                 main_color,
                                 "#dc3545",
                                 "#00897B",
                                 "#343a40",
                                 "#ffc107"
                                ] 
                            }]},
                         options: {
                            responsive: true,
                            plugins: {
                              legend: {
                                position: 'top',
                              },
                              title: {
                                display: false
                              }
                            }
                          }
                      })
          </script>

            <?php
      }

 ?>
      </div>

<?php }  elseif($data['reportInfo'][0]->interface == 'Bar Chart') { $unicode = uniqid(); 

        if($data['reportInfo'][0]->report == 'Results') {
  ?>


  <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                   <!--  <span class="text-bold text-lg requestsTotal">182</span> -->
                    <h4>{{$data['reportInfo'][0]->name}} <span class="duration"></span> - <span class="total{{$unicode}}"></span></h4>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="requests-chart<?=$unicode;?>" height="350"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->

          </div>

          <!-- /.col-md-6 -->

<script type="text/javascript">
       

          var label = @json($data['labels']);
          var values = @json($data['values']);
          var reportInfo = @json($data['reportInfo']);

         if(reportInfo[0].report == 'Results') {

               var values2 = @json($data['values2']);

               var values3 = @json($data['values3']);

          }


          var values2Count = values2.reduce(function(a, b){
                              return a + b;
                          }, 0);



          var sum = values.reduce(function(a, b){
                              return a + b;
                          }, 0);

          var totalRes = values2Count+sum;
                          
          $('.total<?=$unicode?>').text(totalRes);

         $(function () {
            'use strict'

            var ticksStyle = {
              fontColor: main_color,
              fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

                       // var  label = ['', '', '', '', '', '', ''];
                       //  var  values = [0,0,0,0,0,0,0];

                      var $requests = $('#requests-chart<?=$unicode;?>')
                          // eslint-disable-next-line no-unused-vars
                          var requests = new Chart($requests, {
                            type: 'bar',
                            data: {
                             labels: label,
                              datasets: [
                                {
                                  label: 'High Flag {{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: '#dc3545',
                                  borderColor: '#dc3545',
                                  data: values2
                                },
                               {
                                  label: '{{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: main_color,
                                  borderColor: main_color,
                                  data: values
                                },
                                 {
                                  label: 'Low Flag {{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: '#17a2b8',
                                  borderColor: '#17a2b8',
                                  data: values3
                                }
                              ]
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


          })

</script> 

<?php 
}

if($data['reportInfo'][0]->report == 'Samples') {
  ?>


  <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                   <!--  <span class="text-bold text-lg requestsTotal">182</span> -->
                    <h4>{{$data['reportInfo'][0]->name}} <span class="duration"></span> - <span class="total{{$unicode}}"></span></h4>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="requests-chart<?=$unicode;?>" height="350"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->

          </div>

          <!-- /.col-md-6 -->

<script type="text/javascript">
       

          var label = @json($data['labels']);
          var values = @json($data['values']);
          var reportInfo = @json($data['reportInfo']);



          var sum = values.reduce(function(a, b){
                              return a + b;
                          }, 0);
                          
                        $('.total<?=$unicode?>').text(sum);

         $(function () {
            'use strict'

            var ticksStyle = {
              fontColor: '#495057',
              fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

                       // var  label = ['', '', '', '', '', '', ''];
                       //  var  values = [0,0,0,0,0,0,0];

                      var $requests = $('#requests-chart<?=$unicode;?>')
                          // eslint-disable-next-line no-unused-vars
                          var requests = new Chart($requests, {
                            type: 'bar',
                            data: {
                             labels: label,
                              datasets: [
                                {
                                  label: '{{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: main_color,
                                  borderColor: main_color,
                                  data: values
                                }
                              ]
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


          })

</script> 

<?php 
}  
 } elseif($data['reportInfo'][0]->interface == 'Line Chart') {   $unicode = uniqid(); 

        if($data['reportInfo'][0]->report == 'Results') {
  ?>


  <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                   <!--  <span class="text-bold text-lg requestsTotal">182</span> -->
                    <h4>{{$data['reportInfo'][0]->name}} <span class="duration"></span> - <span class="total{{$unicode}}"></span></h4>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="requests-chart<?=$unicode;?>" height="350"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->

          </div>

          <!-- /.col-md-6 -->

<script type="text/javascript">
       

          var label = @json($data['labels']);
          var values = @json($data['values']);
          var reportInfo = @json($data['reportInfo']);

          if(reportInfo[0].report == 'Results') {

               var values2 = @json($data['values2']);

               var values3 = @json($data['values3']);

          }


          var values2Count = values2.reduce(function(a, b){
                              return a + b;
                          }, 0);

          var sum = values.reduce(function(a, b){
                              return a + b;
                          }, 0);

          var totalRes = values2Count+sum;
                          
                        $('.total<?=$unicode?>').text(totalRes);

         $(function () {
            'use strict'

            var ticksStyle = {
              fontColor: '#495057',
              fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

                       // var  label = ['', '', '', '', '', '', ''];
                       //  var  values = [0,0,0,0,0,0,0];

                      var $requests = $('#requests-chart<?=$unicode;?>')
                          // eslint-disable-next-line no-unused-vars
                          var requests = new Chart($requests, {
                            type: 'line',
                            data: {
                             labels: label,
                              datasets: [
                                {
                                  label: '{{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: main_color,
                                  borderColor: main_color,
                                  data: values
                                },
                                {
                                  label: 'High Flag {{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: '#dc3545',
                                  borderColor: '#dc3545',
                                  data: values2
                                },
                                 {
                                  label: 'Low Flag {{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: '#17a2b8',
                                  borderColor: '#17a2b8',
                                  data: values3
                                }
                              ]
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


          })

</script> 

<?php 
}

if($data['reportInfo'][0]->report == 'Samples') {
  ?>


  <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                   <!--  <span class="text-bold text-lg requestsTotal">182</span> -->
                    <h4>{{$data['reportInfo'][0]->name}} <span class="duration"></span> - <span class="total{{$unicode}}"></span></h4>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="requests-chart<?=$unicode;?>" height="350"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->

          </div>

          <!-- /.col-md-6 -->

<script type="text/javascript">
       

          var label = @json($data['labels']);
          var values = @json($data['values']);
          var reportInfo = @json($data['reportInfo']);



          var sum = values.reduce(function(a, b){
                              return a + b;
                          }, 0);
                          
                        $('.total<?=$unicode?>').text(sum);

         $(function () {
            'use strict'

            var ticksStyle = {
              fontColor: '#495057',
              fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

                       // var  label = ['', '', '', '', '', '', ''];
                       //  var  values = [0,0,0,0,0,0,0];

                      var $requests = $('#requests-chart<?=$unicode;?>')
                          // eslint-disable-next-line no-unused-vars
                          var requests = new Chart($requests, {
                            type: 'line',
                            data: {
                             labels: label,
                              datasets: [
                                {
                                  label: '{{$data['reportInfo'][0]->name}}',  
                                  backgroundColor: '#ced4da',
                                  borderColor: '#ced4da',
                                  data: values
                                }
                              ]
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


          })

</script> 

<?php 
}
   } ?>
