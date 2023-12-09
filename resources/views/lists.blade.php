@include('layouts.header')
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">{{$data['name']}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$data['name']}} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

                    <div class="row">
                        
                        <div class="col-md-4">    
                        <div class="card card-primary card-outline">
                            <div class="card-body">                  
                                <h5>Add New {{$data['name']}}</h5>   

                                  <form id="form">
                                            {{ csrf_field() }}
                                            <div class="row">
                                            
                                            <div class="col-md-12">
                                            <label  class="col-form-label">Code <span>*</span></label>
                                                 <input type="text" class="form-control" id="Code" name="Code" value="" />
                                             </div>

                                             <div class="col-md-12">
                                            <label  class="col-form-label">Name <span>*</span></label>
                                                 <input type="text" class="form-control" id="name" name="name" value="" />
                    
                                                 <input type="hidden" class="form-control" id="id" name="id" value="" />
                                             </div>
              
                                            
                                             <div class="col-md-12 pt-2">
                                                <label  class="col-form-label">In Use <span>*</span></label>
                                            
                                            <div class="row px-2">
                                              
                                             <div class="custom-control custom-radio">
                                              <input class="custom-control-input" type="radio" id="InUse1" name="InUse" value="1" checked>
                                              <label for="InUse1" class="custom-control-label">Yes</label>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                              <input class="custom-control-input" type="radio" id="InUse2" name="InUse" value="0">
                                              <label for="InUse2" class="custom-control-label">No</label>
                                            </div>

                                            </div>
                                            <hr class="mb-0"/>
                                             </div>  



                                             <div class="col-md-12 pt-2">
                                                <label  class="col-form-label">Default <span>*</span></label>
                                            
                                            <div class="row px-2">
                                              
                                             <div class="custom-control custom-radio">
                                              <input class="custom-control-input" type="radio" id="Default1" name="Default" value="Yes" >
                                              <label for="Default1" class="custom-control-label">Yes</label>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                              <input class="custom-control-input" type="radio" id="Default2" name="Default" value="" checked>
                                              <label for="Default2" class="custom-control-label">No</label>
                                            </div>

                                            </div>

                                             </div> 

                             <div class="col-md-12 mt-3">
                                        
                                             
            
                    </div>   

                                            
        
   
                                        
                                             <div class="col-md-12 mt-3">
                                                <button type="button" class="btn btn-info ml-1 float-right clear">Clear Form</button>
                                              
                                                    
                                     <button type="button" class="btn btn-primary float-right AddUpdatebtn">Save Now</button>
                                     
                                  
                                              
                                              
                                             </div> 
                                            
    
 


                                             
                                        
                                           </div>   
                                        </form>
                                          


                            </div>
                        </div>
                        </div>

                    <div class="col-md-8">
                         <div class="card card-primary card-outline">
                            <div class="card-body table-responsive">                  
                                <table id="table" class="table mb-0 table-striped">
                                  
                                  <thead>
                                    <tr>
                            
                                    
                                  
                                      <th>ID</th>
                                      <th>Code</th>
                                      <th>Name</th>
                                      <th>ActivityTime</th>
                                      <th>InUse</th>
                                      <th></th>
                                   
                                    </tr>
                                  </thead> 

                                  <tfoot>
                                    <tr>
                                  
                                     
                                      <th>ID</th>
                                      <th>Code</th>
                                      <th>Name</th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      
                                     
                                    
                                    </tr>
                                  </tfoot> 


                                </table>                 
                            </div>
                        </div> 
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


<script type="text/javascript">
    $(document).ready(function () {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


// 


 var table = $('#table').DataTable({

         "lengthMenu": [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50,100, 200, 500, "All"] ],
        dom: 'lBfrtip', //"Bfrtip",


        processing: true,
        serverSide: true,
        // stateSave: true,
        ajax: {
            url: "{{ route('List') }}",
            method: 'POST',
            data:{ListType:"ROL"}
        },
         columns: [
           
            {data: 'id', name: 'id'},
            {data: 'Code', name: 'Code'},
            {data: 'Text', name: 'Text'},
            {data: 'activitytime', name: 'activitytime'},
            {data: 'InUse', name: 'InUse'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "order":[[2, 'asc']],

         dom: "Blfrtip",
                buttons: [
                
                    {
                        title:"{{$data['name']}}",
                        text: 'Excel',
                        footer: true,
                        extend: 'excelHtml5',
                        exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    },
                    {
                    title:"{{$data['name']}}", 
                    text: 'PDF', 
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    footer: true,
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    customize: function (doc) {
                    doc.content[1].table.widths = 
                              Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                          doc.styles.tableBodyEven.alignment = 'center';
                          doc.styles.tableBodyOdd.alignment = 'center'; 
                                
                        }
                    },
                    {
                        text: 'Print',
                        title:"{{$data['name']}}",
                        extend: 'print',
                        footer: true,
                        exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    }, 
                    'colvis'   
                ],

                // columnDefs: [{
                //     orderable: false,
                //     targets: -1,
                // },
                columnDefs: [{
    "defaultContent": "-",
    "targets": "_all"
  },
                { "visible": false, "targets": [1,6,7,8,9] }
                ], 



        initComplete: function () {
            this.api().columns(1).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "ID";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
             this.api().columns(2).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "Code";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });

              this.api().columns(3).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.classList.add("form-control");
                input.classList.add("text-center");
                input.classList.add("p-0");
                input.placeholder = "Name";
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
                
        

                          //    $(".update").remove();
                          //    $('.col-md-4').remove();
                          //     $(".col-md-8").toggleClass("col-md-12");
                          //     $('#table').css('width','100%');



                          //  $(".delete").remove();
                             


                          //   $(".update").remove();
                             
            



        }
    });



  table.on('click', '.delete', function() {

        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')) {
            $tr = $tr.prev('parent');
        }

        var data = table.row($tr).data();
        var tr_id = '#'+table.row($tr).data().id;
        


        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
         
             $.ajax({
                        type: 'post',
                        url:"{{ route( 'deleteList') }}",
                        data: {'id' : data.id},
                        dataType: 'json',                   
                        success: function(response){ 
                   
                                   if ($.isEmptyObject(response.error)){



                                         $(tr_id).fadeOut(1000);
                                            $(tr_id).css("background", "#4bca52");
                                            setTimeout(function() {
                                                $(tr_id).css("background", "none");
                                                table.ajax.reload( null, false );
                                                }, 900);

                                            
                                    } else {
                                         Lobibox.notify('warning', {
                                                pauseDelayOnHover: true,
                                                continueDelayOnInactiveTab: false,
                                                position: 'top right',
                                                msg: response.error,
                                                icon: 'bx bx-info-circle'
                                            });


                                    }    

                            }
                        });

           } 
        });


      
 });

    table.on('click', '.movedown', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('parent');
            }

            var data = table.row($tr).data();
            
            var currentRowId = table.row($tr).data().id;
            var nextRowId = $('#'+currentRowId ).next("tr").attr("id");

            var currentRow = $(this).attr('index');        
            var moveToRow = parseFloat(currentRow)+1;

              $.get("{{route('ListRowShift')}}", 
               {
                currentRow: currentRow,
                moveToRow: moveToRow,
                currentRowId: currentRowId,
                nextRowId: nextRowId
              }, 
              function(data){
                table.ajax.reload( null, false );
              });


    })

    table.on('click', '.moveup', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('parent');
            }

            var data = table.row($tr).data();
            
            var currentRowId = table.row($tr).data().id;
            var nextRowId = $('#'+currentRowId ).prev("tr").attr("id");

            var currentRow = $(this).attr('index');        
            var moveToRow = parseFloat(currentRow)-1;

              $.get("{{route('ListRowShift')}}", 
               {
                currentRow: currentRow,
                moveToRow: moveToRow,
                currentRowId: currentRowId,
                nextRowId: nextRowId
              }, 
              function(data){
                table.ajax.reload( null, false );
              });


    })


    $(".clear").click(function (event) {
                 $('#form')[0].reset()
                 $('#id').val('')
                  $('.card-body > h5').text("Add New {{$data['name']}}");
           })



    table.on('click', '.update', function() {

        $('.card-body > h5').text("Update {{$data['name']}}");
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')) {
            $tr = $tr.prev('parent');
        }

        var data = table.row($tr).data();
        var tr_id = '#'+table.row($tr).data().id;

        var id = table.row($tr).data().id;

              $.get("{{route('ListInfo')}}", 
               {
                id: id,
              }, 
              function(data1){
                //console.log(data)
                if(data1.data.length > 0) {

                    $('#id').val(data1.data[0].id);
                    $('#name').val(data1.data[0].Text);
                    $('#Code').val(data1['data'][0].Code);
                    $('#activitytime').val(data1['data'][0].activitytime);
                    $('#type').val(data1['data'][0].ListType).trigger('change');
                   
                     for(var i=0;i<data1['getdata'].length;i++)
                     {
                      $("#"+data1['getdata'][i]).prop('checked', true);
                     }
                    if(data1[0].InUse == 1) {
                        $("#InUse1").prop("checked", true);
                    } else {
                        $("#InUse2").prop("checked", true);
                    }


                    if(data1[0].Default == 'Yes') {
                        $("#Default1").prop("checked", true);
                    } else {
                        $("#Default2").prop("checked", true);
                    }
                    


                }
              });
   })


    table.on('click', '.status', function()     {

           $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('parent');
            }

            var data = table.row($tr).data();
            var tr_id = table.row($tr).data().id; 

             $.post("{{ route('changeStatus') }}",
            {
                id: tr_id, 
                status: this.id,  
            },
             function(data){
                table.ajax.reload( null, false );
            });
             table.ajax.reload( null, false );         
          }) 



            //add and update js code

            $(".AddUpdatebtn").click(function (event) {

              v
                    //stop submit the form, we will post it manually.
                    event.preventDefault();

                    // Get form
                    var form = $('#form')[0];

                    // Create an FormData object
                    var data = new FormData(form);


                    // append account names to form 
                     var accountname = $(".accountname");
                     
                        for(var i = 0; i < accountname.length; i++){
                            
                             data.append("accountname[]", $(accountname[i]).text());

                        }
                        var arr=[];
                      
                      

                        
                        var val1= document.getElementById("view1");  
                        var val2= document.getElementById("view2"); 
                        var val3= document.getElementById("view3"); 
                        var val4= document.getElementById("view4");
                        var val5= document.getElementById("order1"); 
                        var val6= document.getElementById("order2"); 
                        var val7= document.getElementById("order3"); 
                        var val8= document.getElementById("order4"); 
                        var val9= document.getElementById("sign1"); 
                        var val10= document.getElementById("sign2"); 
                        var val11= document.getElementById("sign3"); 
                        var val12= document.getElementById("sign4"); 
                        var i=0;
                      
                    
                        
                        if(val1.checked)
                        {
                          arr[i]="view-1";
                          i++;
                        }
                        if(val2.checked)
                        {
                          arr[i]="view-2";
                          i++;
                        }
                        if(val3.checked)
                        {
                          arr[i]="view-3";
                          i++;
                        }
                        if(val4.checked)
                        {
                          arr[i]="view-4";
                          i++;
                        }
                        if(val5.checked)
                        {
                          arr[i]="order-1";
                          i++;
                        }
                        if(val6.checked)
                        {
                          arr[i]="order-2";
                          i++;
                        }
                        if(val7.checked)
                        {
                          arr[i]="order-3";
                          i++;
                        }
                        if(val8.checked)
                        {
                          arr[i]="order-4";
                          i++;
                        }
                        if(val9.checked)
                        {
                          arr[i]="sign-1";
                          i++;
                        }
                        if(val10.checked)
                        {
                          arr[i]="sign-2";
                          i++;
                        }
                        if(val11.checked)
                        {
                          arr[i]="sign-3";
                          i++;
                        }
                        if(val12.checked)
                        {
                          arr[i]="sign-4";
                          i++;
                        }
                        for (var i=0;i<arr.length;i++)
                        {
                          data.append("arr[]",arr[i]);
                        }
                      
               
                        

                        
                    var sendto=0;
                     
                    if($('#id').val() > 0 && UpdateFlag==1) {
                      sendto=1;
                        var url = "{{ route('updateList') }}";        
                       
                    } else if($('#id').val() <=0 && Addflag==1) {
                       sendto=1;
                        var url = "{{ route('addList') }}";   
           

                    }
                if(sendto==1)
                {

                

                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: url,
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function(data) {
                            //console.log(data);
                                if ($.isEmptyObject(data.error)){
                                     Lobibox.notify('success', {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: 'top right',
                                            msg: data.success,
                                            icon: 'bx bx-check-circle'
                                        });
                                      table.ajax.reload( null, false );
                                      
                                      $('#form')[0].reset()
                                      $('#id').val('')
                                       $('.card-body > h5').text("Add New {{$data['name']}}");

                                } else {
                                     Lobibox.notify('warning', {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: 'top right',
                                            msg: data.error,
                                            icon: 'bx bx-info-circle'
                                        });
                                }
                            }

                        });
                      }
                      else{
                        
                             Lobibox.notify('warning', {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: 'top right',
                                            msg: "You Don't have the permission.",
                                            icon: 'bx bx-info-circle'
                                        });
                      }
            });

            


    });

</script>
@endpush
