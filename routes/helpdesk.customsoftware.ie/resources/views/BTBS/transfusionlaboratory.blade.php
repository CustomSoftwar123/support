@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Sample Info
               <a class="btn btn-info btn-sm" href="{{route('home')}}"><i class="fas fa-arrow-left"></i> Go Back </a>
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
                            <div class="row">
                                <div class="col-md-5 border-right">
                                
                                <div class="d-flex">
                                <div id="side_one">
                                    <div class="ch d-flex justify-content-between align-items-center">
                                        <button class="btn btn-warning">C/H</button>
                                        <div class="ch2 d-flex">
                                            <h6 class="mt-2 mr-3">CAVAN Chart#</h6>
                                            <button class="btn btn-danger">Unlock</button>
                                        </div>
                                    </div>
                                    <div class="input-group chart my-2">
                                        <button class="btn btn-secondary">&plus;</button>
                                        <button class="btn btn-secondary ml-1">&#8722;</button>
                                            <label for="chart" class="ml-2 mt-1">Chart</label>
                                            <input type="text" name="chart" id="chart" class="ml-1 form-control">
                                            <label for="chart" class="ml-2 mt-1">A/E</label>
                                            <input type="text" name="chart" id="chart"  class="ml-1 form-control">
                                    </div>
                                    <div class="input-group my-2">
                                        <label for="samplenum" class="ml-2 mt-1">Sample#</label>
                                        <input type="text" name="samplenum" id="samplenum" class="ml-1 form-control">
                                        <label for="typenex" class="ml-2 mt-1">TYPENEX</label>
                                        <input type="text" name="typenex" id="typenex"  class="ml-1 form-control">
                                    </div>
                                    <input type="text" name="reportres" id="reportres" class="form-control mb-2">
                                </div>
                                    <div class="sidebtns ml-2">
                                        <button class="searchbtn btn btn-secondary mt-4">Search <span id="num_search">(3)</span></button>
                                        <button class="historybtn btn btn-secondary mt-4">History</button>
                                    </div>
                                </div>

                                <div>
                                <div class="row">
                                    <div class="col-md-8 p-0">
                                        <div class="input-group mt-2">
                                            <label for="namepat" class="ml-2 mt-1">Name</label>
                                            <input type="text" name="namepat" id="namepat" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="mname" class="ml-2 mt-1">M.Name</label>
                                            <input type="text" name="mname" id="mname" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="address1" class="ml-2 mt-1">Addr 1</label>
                                            <input type="text" name="address1" id="address1" class="ml-1 form-control">
                                        </div>

                                        <div class="input-group mt-2">
                                            <label for="address2" class="ml-2 mt-1">Addr 2</label>
                                            <input type="text" name="address2" id="address2" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="address3" class="ml-2 mt-1">Addr 3</label>
                                            <input type="text" name="address3" id="address3" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="address4" class="ml-2 mt-1">Addr 4</label>
                                            <input type="text" name="address4" id="address4" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="remark" class="ml-2 mt-1">Remark</label>
                                            <input type="text" name="remark" id="remark" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="selectward" class="ml-2 mt-1">Ward</label>
                                            <select id="selectward" name="selectward" class="ml-1 form-select form-control">
                                                <option value="maternity">Maternity</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="selectdr" class="ml-2 mt-1">Clin</label>
                                            <select id="selectdr" name="selectdr" class="ml-1 form-select form-control">
                                                <option value="dr1">Dr Ann Leahy</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="selectgp" class="ml-2 mt-1">GP</label>
                                            <select id="selectgp" name="selectgp" class="ml-1 form-select form-control">
                                                <option value="gp1">GP 1</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="selectcond" class="ml-2 mt-1">Cond</label>
                                            <select id="selectcond" name="selectcond" class="ml-1 form-select form-control">
                                                <option value="cond1">Cond 1</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="selectproc" class="ml-2 mt-1">Proc</label>
                                            <select id="selectproc" name="selectproc" class="ml-1 form-select form-control">
                                                <option value="proc1">Proc 1</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="selectspec" class="ml-2 mt-1">Spec</label>
                                            <select id="selectspec" name="selectspec" class="ml-1 form-select form-control">
                                                <option value="spec1">Spec 1</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="samplecomment" class="ml-2 mt-1">Sample Comment</label>
                                            <input type="text" name="samplecomment" id="samplecomment" class="ml-1 form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mt-2">
                                            <label for="dob" class="ml-2 mt-1">D.O.B</label>
                                            <input type="date" name="dob" id="dob" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="age" class="ml-2 mt-1">Age</label>
                                            <input type="text" name="age" id="age" class="ml-1 form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <label for="sex" class="ml-2 mt-1">Sex</label>
                                            <input type="text" name="sex" id="sex" class="ml-1 form-control">
                                        </div>

                                        <div>
                                        <img src="" alt="" width="100" height="100" class="m-3 d-none">        
                                        </div>
                                        <div class="mt-5">
                                            <label for="checkby">Checked By</label>
                                            <input type="text" name="checkby" id="checkby" class="ml-1 form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label for="sampledate">Sample Date</label>
                                            <input type="date" name="sampledate" id="sampledate" class="ml-1 form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label for="sampletime">Sample Time</label>
                                            <input type="date" name="sampletime" id="sampletime" class="ml-1 form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label for="datetime">Date/Time Recieved</label>
                                            <input type="date" name="datetime" id="datetime" class="ml-1 form-control">
                                            <input type="time" name="time1" id="time1" class="ml-1 mt-2 form-control">
                                        </div>

                                    </div>
                                    </div>
                                    </div>

                            
                                                            
                            
                                </div>          
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-8 pr-0">
                                            <div class="shadow p-3 mb-3 bg-white rounded">
                                                <h5 class="mb-3">Grouping</h5>
                                                <div class="input-group mt-2">
                                                    <label for="suggest" class="ml-2 mt-1">Suggest</label>
                                                    <input type="text" name="suggest" id="suggest" class="ml-2 form-control">
                                                </div>
                                                <div class="input-group mt-2">
                                                    <label for="report" class="ml-2 mt-1">Report</label>
                                                    <select name="report" id="report" class="ml-2 form-select form-control">
                                                        <option value="apos">A Pos</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mt-2">
                                                    <label for="kel" class="ml-2 mt-1">kel</label>
                                                    <select name="kel" id="kel" class="ml-2 form-select form-control">
                                                        <option value="K-">K-</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="shadow p-3 mb-3 bg-white rounded">
                                                <h5 class="mt-3">Electronic X-Matching</h5>
                                                <div>
                                                    <div class="form-check form-check-inline mt-2">
                                                        <label class="form-check-label mr-1" for="prevsample">Previous Samples</label>
                                                        <input class="form-check-input" type="checkbox" id="prevsample" value="option1">
                                                        <input class="form-check-input" type="checkbox" id="prevscreen" value="option2">
                                                        <label class="form-check-label" for="prevscreen">Previous A/B Screens</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mt-2">
                                                        <label class="form-check-label mr-1" for="prevgroup">Previous Group agreement</label>
                                                        <input class="form-check-input" type="checkbox" id="prevgroup" value="option1">
                                                        <input class="form-check-input" type="checkbox" id="noadverse" value="option2">
                                                        <label class="form-check-label" for="noadverse">No Adverse Reactions</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mt-2">
                                                        <label class="form-check-label mr-1" for="currscreen">Current A/B Screen</label>
                                                        <input class="form-check-input" type="checkbox" id="currscreen" value="option1">
                                                        <input class="form-check-input" type="checkbox" id="prevelig" value="option2">
                                                        <label class="form-check-label" for="prevelig">Previously Eligible</label>
                                                    </div>
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="checkbox" id="visiondata" value="option1">
                                                        <label class="form-check-label mr-1" for="visiondata">Vision Data</label>
                                                    </div>
                                                    <div class="mt-3 d-flex text-center">
                                                        <h6 class="mt-2">Not Eligible</h6>
                                                        <button class="btn btn-primary mx-1">View</button>
                                                    </div>
                                                    <div>
                                                        <h6 class="mt-3">Expired</h6>
                                                    </div>
                                                    <div>
                                                        <h6>AB Report</h6>
                                                        <textarea name="abreport" id="abreport" width="100" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-6 pr-0">
                                                    <button class="btn btn-primary mx-1">Print Label</button>
                                                    <button class="btn btn-primary m-1">Phone Results</button>
                                                </div>
                                                <div class="col-md-6 p-0">
                                                    <button class="btn btn-primary w-100 mx-1">Print Form</button>
                                                    <button class="btn btn-primary w-100 m-1">Work Lists</button>
                                                    <button class="btn btn-primary w-100 m-1">Lab</button>
                                                    <button class="btn btn-primary w-100 m-1">Genotype</button>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary w-100 m-1">Request Details</button>
                                                    <button class="btn btn-primary w-100 m-1">Print DAT</button>

                                                    <div class="mt-3">
                                                        <table class="my-3 table-striped tableDAT">
                                                            <thead>
                                                                <tr>   
                                                                    <th>DAT</th>
                                                                    <th>POS</th>
                                                                    <th>NEG</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="d-flex ml-2"> -->
                                            <!-- </div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary mt-1">Enter External Notes</button>
                                            <button class="btn btn-primary mt-1">View Reports</button>
                                            <button class="btn btn-primary mt-1">Cancel</button>
                                            <button class="btn btn-primary mt-1">Save F2</button>
                                            <button class="btn btn-primary mt-1">Save & Hold</button>
                                            <button class="btn btn-primary mt-1">Order</button>
                                           
                                      </div>
                                    </div>
                                </div> 
                                
                            <div class="col-md-12">
                                <h5 class="mt-5">Cross Match</h5>
                                <button class="btn btn-primary mt-1 ml-5">Hide Current</button>
                                <button class="btn btn-primary mt-1 ml-3">Issue Batch Product</button>
                                <button class="btn btn-primary mt-1 ml-3">Manual Prepare</button>
                                <button class="btn btn-primary mt-1 ml-2">Electronic Issue</button>
                                <button class="btn btn-primary mt-1 ml-2">Issue to Unknown</button>
                                <button class="btn btn-primary mt-1 ml-2">Suggest Units</button>

                                <div class="mt-3">
                                    <table class="my-3 table-striped tableLast">
                                        <thead>
                                            <tr>   
                                                <th>Unit</th>
                                                <th>Group</th>
                                                <th>Expiry</th>
                                                <th>Type</th>
                                                <th>Latest</th>
                                                <th>R</th>
                                                <th>C</th>
                                                <th>E</th>
                                                <th>Product</th>
                                                <th>Op</th>
                                                <th>Date</th>
                                                <th>Event Start</th>
                                                <th>Event End</th>
                                                <th>Identity</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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

   
// var table=$('.tableDAT').DataTable({
 

//  columns: [

//     {data: 'dat', name: 'dat'},
//       {data: 'pos', name: 'pos'},
//       {data: 'neg', name: 'neg'},

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
                //     {
                //         text: 'Print',
                //         title:'Users',
                //         extend: 'print',
                //         footer: true,
                //         exportOptions: {
                //         columns: [':visible :not(:last-child)']
                //         },
                //     },
                //     'colvis'  
//                 ],

//                 columnDefs: [{
//                     orderable: false,
//                     targets: -1,
//                 },
//                 { "visible": false, "targets": [] }
//                 ],

// });
var table=$('.tableLast').DataTable({
 

 columns: [
    
    {data: 'unitnum', name: 'unitnum'},
{data: 'group', name: 'group'},
{data: 'expiry', name: 'expiry'},
{data: 'type', name: 'type'},
{data: 'latest', name: 'latest'},
{data: 'r', name: 'r'},
{data: 'c', name: 'c'},
{data: 'e', name: 'e'},
{data: 'product', name: 'product'},
{data: 'op', name: 'op'},
{data: 'date', name: 'date'},
{data: 'eventstart', name: 'eventstart'},
{data: 'eventend', name: 'eventend'},
{data: 'identity', name: 'identity'},
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
