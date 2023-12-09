 <div class="col-lg-12">

        <canvas id="PatientHistory-chart" height="550"></canvas>

  </div>
  <!-- /.card -->

</div>

<script type="text/javascript">

 var mode = 'index'
 var intersect = true
 var label = @json($data['labels']);
 var values = @json($data['values']);
 var NormalLow = @json($data['NormalLow']);
     NormalLow = parseInt(NormalLow); 
 var NormalHigh = @json($data['NormalHigh']);
     NormalHigh = parseInt(NormalHigh); 



var pointBackgroundColors = [];
var myChart = new Chart($('#PatientHistory-chart').get(0).getContext('2d'), {
    type: 'line',
    data: {
        labels: label,
        
        datasets: [
            {
                data: values,
                fill: false,
                pointBackgroundColor: pointBackgroundColors,
                pointRadius: 10
            }
        ],
        
    },
     options: {
                        legend: {
                        display: false
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                          yAxes: [{
                             id: 'y-axis-1',
                            ticks: {
                              beginAtZero:true
                            }
                          }]
                        },
                        annotation: {
                          drawTime: "afterDraw",
                          annotations: [{
                             id: 'box1',
                            type: 'box',
                            yScaleID: 'y-axis-1',
                            yMin: NormalLow,
                            yMax: NormalHigh,
                            backgroundColor: 'rgba(100, 100, 100, 0.2)',
                            borderColor: 'rgba(100, 100, 100, 0.2)',
                          }]
                        },
                       plugins: {
                                  legend: {
                                      display: false,
                                      labels: {
                                          color: 'rgb(255, 99, 132)'
                                      }
                                  }
                                },
    
                      
                    }
});



for (i = 0; i < myChart.data.datasets[0].data.length; i++) {

        
        if(NormalLow == 0 && NormalHigh == 0) {

             pointBackgroundColors.push("#6c757d");

        } else {

            if (myChart.data.datasets[0].data[i] > NormalHigh) {

                pointBackgroundColors.push("#dc3545");
            }
            else if (myChart.data.datasets[0].data[i] < NormalLow) {

                pointBackgroundColors.push("#17a2b8");
            }
             else {
                pointBackgroundColors.push("#6c757d");
            }


        }

}

myChart.update();



</script>





