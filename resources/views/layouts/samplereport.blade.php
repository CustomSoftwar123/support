

<div class="row">

<div class="col-md-12">
    <span class="float-right">
 <button class="btn btn-primary" id="status">{{$data['OCMRequest'][0]->RequestState}}</button>
</span>

<h3 class="profile-username text-left mb-1">Patient Info</h3>
<p class="text-dark text-left m-0">
<b id="patname">{{$data['OCMRequest'][0]->PatName}}</b>
</p>
<p class="text-dark text-left m-0">
<span id="patSex">

<?php 

if($data['OCMRequest'][0]->Sex == 'F') {

    echo 'Female';

} elseif($data['OCMRequest'][0]->Sex == 'M') {

    echo 'Male';

} else {

    echo 'Other';
}

?>
</span> / 
<span id="patage">{{$data['DoB']}}</span> yrs
</p>
<p class="text-dark text-left m-0 mb-2" id="pataddress">{{$data['OCMRequest'][0]->Address0}}</p>

</div>

<div class="col-md-5">
<label>Patient Chart : </label> <span id="patchart">{{$data['OCMRequest'][0]->Chart}}</span>
<br>
 <label>Patient MRN : </label> <span id="patmrn">{{$data['OCMRequest'][0]->MRN}}</span>
<br>
 <label>Clinician : </label> <span id="clinician">{{$data['OCMRequest'][0]->Clinician}}</span>
 <br>
 <label>Location : </label> <span id="ward">
     <?php 

     if($data['OCMRequest'][0]->Ward != null) { 

                            if($data['OCMRequest'][0]->bed != null) {
                            
                            echo $data['OCMRequest'][0]->Ward.' - Bed '. $data['OCMRequest'][0]->bed;

                            } else {
                            
                             echo $data['OCMRequest'][0]->Ward;

                            }

                            } else {

                            if(response.OCMRequest[0].bed != null) {
                            
                             echo $data['OCMRequest'][0]->clinic.' - Bed '. $data['OCMRequest'][0]->bed;

                            } else {
                            
                             echo $data['OCMRequest'][0]->clinic;

                            }
                            }

                            ?>
 </span>
</div>



<div class="col-md-4">
<label>Date Time : </label> <span id="datetime">{{$data['OCMRequest'][0]->ExecutionDateTime}}</span>
<br>
<label>Request #  </label> <span id="requestid">{{$data['OCMRequest'][0]->ReqestID}}</span>
<br>
<label>Request Episode : </label> <span id="episode">{{$data['OCMRequest'][0]->RequestEpisodeID}}</span>
</div>


<div class="col-md-3">
<label>Fasting : </label> <span id="fasting">{{$data['OCMRequest'][0]->RequestFasting}}</span>
<br>
<label>Out of Hours :  </label> <span id="outofhours">{{$data['OCMRequest'][0]->outofhours}}</span>
<br>
<label>Priority : </label> <span id="priority">{{$data['OCMRequest'][0]->RequestPriority}}</span>
</div>


<div class="col-md-12 mt-2">
  
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link" id="results-tab" data-toggle="pill" href="#results" role="tab" aria-controls="results" aria-selected="false">Results</a>
</li>
</ul>



<table class="table tableResutls">
        
<thead>

<tr>

<th>Sample ID</th>    
<th>Test</th>
<th>Result</th>
<th>Ranges</th>
<th>Units</th>
<th>Flags</th>
<th>Analyser</th>
<th>Comments</th>


</tr>



</thead>

<tbody>
    
@foreach ($data['results'] as $BioResult)
    <tr>
        <td>{{$BioResult->PhlebotomySampleID}}</td>
        <td>{{$BioResult->test}}</td>
        <td><?php 
            if($BioResult->result == '') {

                echo '-';
            }
        ?></td>
        
        <td>{{$BioResult->NormalLow}}{{$BioResult->NormalHigh}}</td>
        <td><?php 
            if($BioResult->Units == '') {

                echo '-';
            }
        ?></td>
        <td><?php 
            if($BioResult->Flags == '') {

                echo '-';
            }
        ?></td>
        <td><?php 
            if($BioResult->Analyser == '') {

                echo '-';
            }
        ?></td>
        <td><?php 
            if($BioResult->Comments == '') {

                echo '-';
            }
        ?></td>

    </tr>
@endforeach

</tbody>

</table>


</div>
</div>

