@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Clients
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
                 <div class="col-md-12">
                   
                 </div>          
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="d-flex align-items-center">
                                <label>1</label>
                                <select name="select_c11" id="select_c11" class="form-select form-control ml-2">
                                    <option value="1"></option>
                                </select>
                            </div>
                            <select name="select_c12" id="select_c12" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>
                            <select name="select_c13" id="select_c13" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                            <div class="mt-3">
                                <table id="table">
                                    <thead>
                                        <tr>   
                                            <th>Antibiotic</th>
                                            <th>S/R</th>
                                            <th>Rprt</th>
                                            <th>Res</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            
                            <div class="mt-5">
                                <button class="btn btn-warning">&#8599;</button><br>
                                <button class="btn btn-warning mt-2">&#8600;</button><br>

                                <button class="btn btn-danger mt-2">R</button><br>
                                <button class="btn btn-secondary mt-2">S</button>
                            </div>

                            <select name="select_c14" id="select_c14" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center">
                                <label>2</label>
                                <select name="select_c21" id="select_c21" class="form-select form-control ml-2">
                                    <option value="1"></option>
                                </select>
                            </div>
                            <select name="select_c22" id="select_c22" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>
                            <select name="select_c23" id="select_c23" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                            <div class="mt-3">
                                <table  id="table2">
                                    <thead>
                                        <tr>   
                                            <th>Antibiotic</th>
                                            <th>S/R</th>
                                            <th>Rprt</th>
                                            <th>Res</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-warning">&#8599;</button><br>
                                <button class="btn btn-warning mt-2">&#8600;</button><br>

                                <button class="btn btn-danger mt-2">R</button><br>
                                <button class="btn btn-secondary mt-2">S</button>
                            </div>

                            <select name="select_c24" id="select_c24" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center">
                                <label>3</label>
                                <select name="select_c31" id="select_c31" class="form-select form-control ml-2">
                                    <option value="1"></option>
                                </select>
                            </div>
                            <select name="select_c32" id="select_c32" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>
                            <select name="select_c33" id="select_c33" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                            <div class="mt-3">
                                <table id="table3">
                                    <thead>
                                        <tr>   
                                            <th>Antibiotic</th>
                                            <th>S/R</th>
                                            <th>Rprt</th>
                                            <th>Res</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-warning">&#8599;</button><br>
                                <button class="btn btn-warning mt-2">&#8600;</button><br>

                                <button class="btn btn-danger mt-2">R</button><br>
                                <button class="btn btn-secondary mt-2">S</button>
                            </div>

                            <select name="select_c34" id="select_c34" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center">
                                <label>4</label>
                                <select name="select_c41" id="select_c41" class="form-select form-control ml-2">
                                    <option value="1"></option>
                                </select>
                            </div>
                            <select name="select_c42" id="select_c42" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>
                            <select name="select_c43" id="select_c43" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                            <div class="mt-3">
                                <table id="table4">
                                    <thead>
                                        <tr>   
                                            <th>Antibiotic</th>
                                            <th>S/R</th>
                                            <th>Rprt</th>
                                            <th>Res</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-warning">&#8599;</button><br>
                                <button class="btn btn-warning mt-2">&#8600;</button><br>

                                <button class="btn btn-danger mt-2">R</button><br>
                                <button class="btn btn-secondary mt-2">S</button>
                            </div>

                            <select name="select_c44" id="select_c44" class="form-select form-control mt-2">
                                <option value="1"></option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <textarea name="c_textarea1" id="c_textarea1" rows="5" class="mt-2 form-control w-100" placeholder="Medical Scientist Comments"></textarea>
                        </div>
                        <div class="col-6">
                            <textarea name="c_textarea2" id="c_textarea2" rows="5" class="mt-2 form-control w-100" placeholder="Consultant Comments"></textarea>
                        </div>
                    </div>

                    <button class="btn btn-primary w-25 mt-3">Lock Results</button>
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
<script >
$(document).ready(function() {


   
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
// var table=$('#table').DataTable({
 
// // ajax: {
   
// //     url: "{{ route('Clients') }}",
   
// // },
//  columns: [

//     {data: 'antibiotic', name: 'antibiotic'},
//     {data: 'sr', name: 'sr'},
//    {data: 'rprt', name: 'rprt'},
//    {data: 'res', name: 'res'},
//     // {data: 'action', name: 'action', orderable: false, searchable: false},
// ],
// "order":[[0, 'desc']],

//   dom: "Blfrtip",
//                 buttons: [
               
                    // {
                    //     title:'Users',
                    //     text: 'Excel',
                    //     footer: true,
                    //     extend: 'excelHtml5',
                    //     exportOptions: {
                    //     columns: [':visible :not(:last-child)']
                    //     },
                    // },
                    // {
                    // title:'Users',
                    // text: 'PDF',
                    // extend: 'pdfHtml5',
                    // exportOptions: {
                    //     columns: [':visible :not(:last-child)']
                    //     },
                    // footer: true,
                    // orientation: 'landscape',
                    // pageSize: 'LEGAL',
                    // customize: function (doc) {
                    // doc.content[1].table.widths =
                    //           Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    //       doc.styles.tableBodyEven.alignment = 'center';
                    //       doc.styles.tableBodyOdd.alignment = 'center';
                               
                    //     }
                    // },
                    // {
                    //     text: 'Print',
                    //     title:'Users',
                    //     extend: 'print',
                    //     footer: true,
                    //     exportOptions: {
                    //     columns: [':visible :not(:last-child)']
                    //     },
                    // },
                    // 'colvis'  
//                 ],

//                 columnDefs: [{
//                     orderable: false,
//                     targets: -1,
//                 },
//                 { "visible": false, "targets": [] }
//                 ],

// });


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