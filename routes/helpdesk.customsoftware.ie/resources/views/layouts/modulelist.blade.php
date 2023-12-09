<div class="row">
    <div class="col-md-12">
        <table class="table table-stripeds">
            <thead>
                <tr>
                    <th colspan="3" class="p-3">
                        <h4 class="m-0">Key Information</h4>
                        <p class="m-0">Select columns you want to see in this report.</p>
                    </th>
                </tr>
            </thead>

            <tbody>
                
                 <tr>
                    <th style="border-bottom: 2px solid #ced4da;">
                        <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="SelectAllA">
                        <label for="SelectAllA" class="custom-control-label">  Select All</label></div> 
                    </th>

                    <th style="border-bottom: 2px solid #ced4da;">
                        <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="SelectAllB">
                        <label for="SelectAllB" class="custom-control-label">  Select All</label></div> 
                    </th>


                    <th style="border-bottom: 2px solid #ced4da;">
                        <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="SelectAllC">
                        <label for="SelectAllC" class="custom-control-label">  Select All</label></div> 
                    </th>

                </tr>

        
<?php 

foreach($data['columns'] as $key =>  $column) {


            $checked = '';
            $columnname = 0;
            $checked2 = '';
            $columnfilters0 = 0;
            $checked3 = '';
            $sortings0 = 0;

                        if($data['editmode'] == 'yes') {

                             $column2 =  App\Http\Controllers\reports::GetColumnStatus($column,$data['rid']);

                             if(count($column2) > 0) {

                               $checked = 'checked'; 
                               $columnname = $column2[0]->column_;

                               if($column2[0]->columnfilter == 1) {

                               $checked2 = 'checked'; 
                               $columnfilters0 = 1; 

                               }

                               if($column2[0]->sorting == 1) {

                               $checked3 = 'checked'; 
                               $sortings0 = 1; 

                               }

                             }
                        }
    ?>
        <tr>
            <th style="width:70%;text-transform: capitalize;">

               
                <?php 
     
                 $column2 =  App\Http\Controllers\reports::GetColumnName($column,$data['table']);

                 $column_ = '';   

               if(count($column2) ==  0) {

                    if($column == 'reflexed' || $column == 'addon') {

                         $column_ = $column.' Test';
                    } 
                    else  {

                          $column_ = $column;   
                    }
               }
                else {

                     $column_ = $column2[0]->table2.'.'.$column2[0]->value1;
              }

               

                ?>
              
              <input type="hidden" name="columns[]" class="columns0" data="{{$column}}" value="{{$columnname}}" id="A-{{$column}}columns"> 
              <div class="custom-control custom-checkbox">
              <input  class="custom-control-input columns" type="checkbox" id="{{$column}}columns" {{$checked}}>
              <label for="{{$column}}columns" class="custom-control-label">  {{$column_}}</label></div> 


            </th>

            <td>

              <input type="hidden" name="columnfilters[]" class="columnfilters0" value="{{$columnfilters0}}" id="B-{{$column}}columnfilters"> 
              <div class="custom-control custom-checkbox">
              <input class="custom-control-input columnfilters" type="checkbox" id="{{$column}}columnfilters" {{$checked2}}>
              <label for="{{$column}}columnfilters" class="custom-control-label">Column Search Filter</label></div> 

            </td>
             <td>
             
              <input type="hidden" name="sortings[]" class="sortings0" value="{{$sortings0}}" id="C-{{$column}}sortings">  
              <div class="custom-control custom-checkbox">
              <input class="custom-control-input sortings" type="checkbox" id="{{$column}}sortings" {{$checked3}}>
              <label for="{{$column}}sortings" class="custom-control-label">Sorting</label></div> 
            
            </td>


        </tr>
    <?php

}

?>          </tbody>
        </table>
    </div>
</div>

