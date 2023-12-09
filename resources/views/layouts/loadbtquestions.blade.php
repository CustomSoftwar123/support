@foreach($data as $key => $questions)
<div class="col-md-12 questios_" id="{{$questions->QuestionID}}">
    <div class="row">
         <div style="font-size: 13px;" class="text-capitalize col-md-5"><label>{{$questions->question}}</label></div>
            <div class="col-sm-7 text-right text-capitalize">
                
                <input type="hidden" name="question[]" value="{{$questions->question}}">
                <input type="hidden" name="answer[]" value="" class='<?=$key;?>___<?=$questions->QuestionID;?>'>
                
                <div class="form-group clearfix answersList-<?=$key;?>___<?=$questions->QuestionID;?>">
                    
                    <?php 
                    $answers = \App\Http\Controllers\requests::answers($questions->QuestionID)[0];
                    $answers = explode(',',$answers); 
                    foreach($answers as $answer) { 

                                if($answer == '') {

                                      ?>

                         <input class="answers__"  type="text"  id='<?=$key;?>___<?=$questions->QuestionID;?>' > <?=$answer;?>

                             <?php


                                } else {

                                      ?>

                         <input class="answers_"  type="radio"  id='<?=$key;?>___<?=$questions->QuestionID;?>' value="<?=$answer;?>" > <?=$answer;?>

                    <?php

                                }
                           }   
                    ?>

                </div>
        </div>
        <div class="text-capitalize col-md-12"><hr class="mt-1" /></div>

    </div>
</div>
@endforeach