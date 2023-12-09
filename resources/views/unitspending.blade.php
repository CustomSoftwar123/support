@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Issue A Single Product
               <a class="btn btn-info btn-sm" href="{{route('Clients')}}"><i class="fas fa-arrow-left"></i> Go Back </a>
             </h1>
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Clients</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


                  <form id="form" >
                                       {{ csrf_field() }}
                                                 
                         <div class="card card-primary card-outline">
                            <div class="card-body ">
                                
                            <!-- <div class="row">
                                <div class="col-md-5 justify-content-center">
                                  
                                </div>   
                            </div>   -->
                            
                            <div class="row">
                                <div class="col-9 m-auto justify-content-center">
                                    <label for="isbt128" class="ml-2 mt-1">ISBT128</label>
                                    <input type="text" name="isbt128" id="isbt128" class="ml-1 form-control d-inline w-25">
                                    <div class="input-group mt-2">
                                        <label for="product" class="ml-2 mt-1">Product</label>
                                        <input type="text" name="product" id="product" class="ml-1 form-control">
                                    </div>  
                                    <div class="input-group mt-2">
                                        <label for="expiry" class="ml-2 mt-1">Expiry</label>
                                        <input type="text" name="expiry" id="expiry" class="ml-1 form-control w-25">
                                        <label for="product" class="ml-2 mt-1">Group/Rh</label>
                                        <input type="text" name="product" id="product" class="ml-1 form-control w-25">
                                        <label for="product" class="ml-2 mt-1">Kel</label>
                                        <input type="text" name="product" id="product" class="ml-1 form-control w-25">
                                    </div>  
                                    <div class="input-group mt-2">
                                        <label for="screen" class="ml-2 mt-1">Screen</label>
                                        <input type="text" name="screen" id="screen" class="ml-1 form-control w-25">
                                    </div>  
                                    <div class="input-group mt-2 mb-3">
                                        <label for="status" class="ml-2 mt-1">Status</label>
                                        <input type="text" name="status" id="status" class="ml-1 form-control w-25">
                                    </div>  

                                    <div class="shadow p-3 bg-white rounded w-50 m-auto">
                                        <input type="text" name="blank" id="blank" class="form-control w-75">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9 mt-3">
                                    <table id="table">
                                        <thead>
                                            <tr>   
                                                <th>ISBT128</th>
                                                <th>Expiry Date</th>
                                                <th>Group Rh</th>
                                                <th>Latest</th>
                                                <th>Screen</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="form-check mt-2">
                                                <label class="form-check-label mr-4" for="roomtemp">Room Temp</label>
                                                <input class="form-check-input" type="checkbox" id="roomtemp" value="option1">
                                            </div>
                                            <div class="form-check mt-2">
                                                <label class="form-check-label mr-4" for="coombs">Coombs</label>
                                                <input class="form-check-input" type="checkbox" id="coombs" value="option2">
                                            </div>
                                            <div class="form-check mt-2">
                                                <label class="form-check-label mr-4" for="enzyme">Enzyme</label>
                                                <input class="form-check-input" type="checkbox" id="enzyme" value="option2">
                                            </div>
                                        </div>
                                        <div class="all-radio">

                                            <div class="d-flex">
                                                <div class="form-check mr-2">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        0
                                                    </label>
                                                    <input class="form-check-input ml-1" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                                                </div>
                                                <div class="form-check ml-3">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">

                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        &plus;
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="d-flex">
                                                <div class="form-check mr-2">
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        0
                                                    </label>
                                                    <input class="form-check-input ml-1" type="radio" name="flexRadioDefault1" id="flexRadioDefault3">
                                                </div>
                                                <div class="form-check ml-3">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault4">

                                                    <label class="form-check-label" for="flexRadioDefault4">
                                                        &plus;
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="d-flex">
                                                <div class="form-check mr-2">
                                                    <label class="form-check-label" for="flexRadioDefault5">
                                                        0
                                                    </label>
                                                    <input class="form-check-input ml-1" type="radio" name="flexRadioDefault1" id="flexRadioDefault5">
                                                </div>
                                                <div class="form-check ml-3">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault6">

                                                    <label class="form-check-label" for="flexRadioDefault6">
                                                        &plus;
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <button class="btn btn-warning">Issue</button>
                                            <button class="btn btn-primary">X-M</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary mt-3">Mark As Pending</button>
                                    <button class="btn btn-primary mt-4">Remove from pending list</button>
                                    <button class="btn btn-danger mt-3">Cancel</button>
                                </div>
                            </div>
         
             

             
         
               
             

   
                   

                   
           
                            </div>
                           </div>
                            <div id="result" class="text-danger"></div>

                  </form>        

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>



@extends('layouts.footer')

@push('script')
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
<script >
$(document).ready(function() {


   
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
var table=$('#table').DataTable({
 
// ajax: {
   
//     url: "{{ route('Clients') }}",
   
// },
 columns: [

    {data: 'isbt128', name: 'isbt128'},
{data: 'expirydate', name: 'expirydate'},
{data: 'grouprh', name: 'grouprh'},
{data: 'product', name: 'product'},
{data: 'screen', name: 'screen'},
    // {data: 'action', name: 'action', orderable: false, searchable: false},
],
"order":[[0, 'desc']],

  dom: "Blfrtip",
                buttons: [
               
                    {
                        title:'Users',
                        text: 'Excel',
                        footer: true,
                        extend: 'excelHtml5',
                        exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    },
                    {
                    title:'Users',
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
                        title:'Users',
                        extend: 'print',
                        footer: true,
                        exportOptions: {
                        columns: [':visible :not(:last-child)']
                        },
                    },
                    'colvis'  
                ],

                columnDefs: [{
                    orderable: false,
                    targets: -1,
                },
                { "visible": false, "targets": [] }
                ],

});


table.on('click', '.delete', function () {
     
     var id=this.id;
     
         swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,

}).then((willDelete) => {
  if (willDelete) {
                         $.ajax({
                        type: 'get',
                        url:"Cdelete/"+id,
                        //data: {'id':id},
                        dataType: '',                  
                       success: function(){
                           
                         table.ajax.reload(null, false);

                              }
                            });

   

  }
});

       
    });
     
   




   

});
</script>
@endpush
