@include('layouts.header')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Net Acquire Dashboard
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
                 <div class="col-md-12">
                   
                 </div>           
          
                 <div class="row">
                   <div class="col-md-4">
                     <label class="form-label">Show Details According to Days</label>
                     <input type="number" name="showdetails" class="form-control">
                   </div>
                     <div class="col-md-4 mt-2">
                     <label class="form-label"> </label>
                     <input type="number" name="showdetails" class="form-control">
                   </div>
                     <div class="col-md-4 mt-4">
                   
                    <a class="btn btn-primary mt-1" href="#">Auto-Refresh</a>
                   </div>
                 </div>
                 <div class="row ">
                   <div class="col-md-3">
                     <div class="row  mt-4">
                       <div class="col-md-12 mt-1">
                         <h6 class="text-center">Outstanding</h6>
                                             <table >
                         <thead>
                           <tr>
                             <th>Analyser</th>
                             <th>Sample ID</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                     </div>
                         <div class="row mt-4">
                       <div class="col-md-12">
                        <label class="form-label">BIO</label>
                       <table >
                         <thead>
                           <tr>
                             <th>Analyser</th>
                             <th>Sample ID</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                     <div class="col-md-12">
                        <label class="form-label">HEAM</label>
                       <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Date</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                      <div class="col-md-12">
                        <label class="form-label">COAG</label>
                                              <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Date</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                     </div>
                   </div>
                     <div class="col-md-3 mt-4">
                        <div class="col-md-12">
                        <label class="form-label">Not Validated</label>
                       <table >
                         <thead>
                           <tr>
                             <th>Analyser</th>
                             <th>Sample ID</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                      <div class="col-md-12 mt-4">
                        <label class="form-label"></label>
                         <textarea class="form-control" rows="2"></textarea>
                       </div>
                           <div class="col-md-12 mt-4">
                        <label class="form-label"></label>
                         <textarea class="form-control" rows="2"></textarea>
                       </div>
                        <div class="col-md-12 mt-5">
                       <a href="#" class="btn btn-primary w-100 p-3 mt-1">Print</a>
                       </div>
  
                   </div>
                     <div class="col-md-3 mt-4">
                      <div class="col-md-12">
                        <label class="form-label">Not Printed</label>
                       <table >
                         <thead>
                           <tr>
                             <th>Analyser</th>
                             <th>Sample ID</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                        <div class="col-md-12 mt-4">
                        <label class="form-label"></label>
                         <textarea class="form-control" rows="2"></textarea>
                       </div>
                        <div class="col-md-12 mt-4">
                        <label class="form-label"></label>
                         <textarea class="form-control" rows="2"></textarea>
                       </div>
                       <div class="col-md-12 mt-2 mt-4">
                         <label class="form-check-label mt-2">Select For Order</label>
                       </div>
                       <div class="col-md-12  mx-3 mt-2">
                         <input type="checkbox" name="true" class="form-check-input"><label class="form-check-label">✔</label>
                       </div>
                       <div class="col-md-12 mx-3">
                         <input type="checkbox" name="false" class="form-check-input"><label class="form-check-label">✕</label>
                       </div>
                   </div>
                     <div class="col-md-3">
                      <div class="col-md-12 mt-4">
                        <h6 class="text-center mt-1">Addons Test</h6>
                      </div>
                        <div class="col-md-12">
                        <label class="form-label">BIO</label>
                       <table>
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Sample Date</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                      <div class="col-md-12">
                        <label class="form-label">HEAM</label>
                       <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Sample Date</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                        <div class="col-md-12">
                        <label class="form-label">COAG</label>
                       <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Sample Date</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
                       </div>
                   </div>
                 </div>

                <div class="row mt-3">
                  <div class="col-md-12 mt-3">
                    <h4 class="text-center">Caution Test System</h4>
                   
                  </div>
              
                </div>
                <div class="row">
                      <div class="col-md-12">
                     <a href="#" class="btn btn-warning "  >Reset Lab No</a>
                    <a href="#" class="btn btn-success float-right">Transfer -> Test</a>
                  </div>
                </div>
         <div class="row mt-4">
           <div class="col-md-4">
             <div class="row">
               <div class="col-md-12">
                 <label class="form-label">Phone Alerts</label>
                      <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Parameter</th>
                             <th>Ward</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
               </div>
             </div>
           </div>
            <div class="col-md-4">
              <div class="row mt-2">
               <div class="col-md-12">
                 <label class="form-label"></label>
                      <table class="">
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Parameter</th>
                             <th>Ward</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
               </div>
             </div>
           </div>
            <div class="col-md-4">
              <div class="row mt-2">
               <div class="col-md-12">
                 <label class="form-label"></label>
                      <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>Parameter</th>
                             <th>Ward</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
               </div>
             </div>
           </div>
         </div>
                
              
      <div class="row mt-4">
        <div class="col-md-6">
          <label class="form-label">Auto Validation Failures</label>
                    <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>D</th>
                             <th>V</th>
                             <th>O</th>
                             <th>R</th>
                             <th>D</th>
                             <th>F</th>
                             <th>A</th>
                             <th>24</th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                          </tr>
                         </tbody>
                       </table>
        </div>
        <div class="col-md-6">
           <label class="form-label">Urgent Samples</label>
                               <table >
                         <thead>
                           <tr>
                             <th>Sample ID</th>
                             <th>H</th>
                             <th>B</th>
                             <th>C</th>
                             <th>E</th>
                             <th>G</th>
                             <th>I</th>
                        
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                           
                          </tr>
                         </tbody>
                       </table>
        </div>
      </div>
   
         <div class="row mt-4">
           <div class="col-md-12">
             <a href="#" class="btn btn-danger">View Unvalidate/Not Printed</a>
             <a href="#" class="btn btn-primary">Microbiology Unvalidate Sample</a>
             <a href="#" class="btn btn-warning">Demographic Validation</a>
             <a href="#" class="btn btn-primary">Order AddOns</a>
             <a href="#" class="btn btn-secondary">Scan Samples</a>
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

@endpush