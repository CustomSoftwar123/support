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
<form>
<div class="container">
<div class="row">
<div class="col-md-4">
<div class="row">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0" for="sampleid">Sample ID:</label>
<div>
<a class="btn " style="padding: 0px 10px ;"><span style='font-size:30px;'>&#8592;</span></a>
<a class="btn " style="padding: 0px 10px ;margin-left: 255px;"><span style='font-size:30px;'>&#8594;</span></a>
</div>
<input type="number" id="sampleid" class="form-control form-control" placeholder="80000196" />

</div>
</div>

</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0" for="mru">MRU</label>
<select id="sel" class="form-select form-control" aria-label="Default select example">
<option value="1"></option>
<option value="2"></option>
<option value="3"></option>
</select>
</div>    
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<a class="btn btn-secondary" style="width: 100%;">Add To Consultant List</a>
</div>
</div>
<div class="row pt-3">
<div class="col-md-7">
<input type="number" id="mru" class="form-control form-control" placeholder="" />
</div>
<div class="col-md-3">
<input type="number" id="mru" class="form-control form-control" placeholder="" />
</div>
<div class="col-md-2">
<a class="btn btn-secondary" style="margin-left: -18px;">Scan</a>
</div>
</div>

</div>
<div class="col-md-5">
<div class="row">
<div class="col-md-4">
<div class="form-outline">
<label class="form-label mb-0" for="chart">Cavan Chart#:</label>
<input type="number" id="chart" class="form-control form-control" placeholder="74625" />

</div>
</div>
<div class="col-md-4" style="margin-left:-10px;">
<div class="form-outline">
<label class="form-label mb-0" for="surname">SurName:</label>
<input type="text" id="surname" class="form-control form-control" placeholder="Boyle" />

</div>
</div>
<div class="col-md-3" style="margin-left:-10px;">
<div class="form-outline">
<label class="form-label mb-0" for="surname">ForeName:</label>
<input type="text" id="forename" class="form-control form-control" placeholder="Patrick Patsy" />

</div>
</div>
<div class="col-md-1">
<a class="btn btn-secondary mt-4" style="padding: 6px 3px; margin-left: -20px;">Search</a>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<input type="text" id="medical2" class="form-control form-control" placeholder="Lisawaun:Medical2" />
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<input type="text" id="lefteye" class="form-control form-control" placeholder="Wound Swab Left Eye" />
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<input type="text" id="blank" class="form-control form-control" placeholder="" />
</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
<div class="col-md-8">
<div class="form-outline datepicker w-100">
<label for="dob" class="form-label mb-0">D.O.B</label>
<div>
<input type="datetime-local" id="" name="dob" class="form-control">
</div>
</div>  
</div>
<div class="col-md-4">
<a class="btn btn-secondary mt-4">Search</a>
</div>

</div>
<div class="row pt-3">
<div class="col-md-8">
<div class="form-outline">
<label class="form-label mb-0" for="age">Age:</label>
<input type="text" id="age" class="form-control form-control" placeholder="86Y" />
</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-8">
<div class="form-outline">
<label class="form-label mb-0" for="mru">Sex</label>
<select id="sel" class="form-select" aria-label="Default select example">
<option value="1">Select Option</option>
<option value="2">Male</option>
<option value="3">Female</option>
</select>
</div>  
</div>
</div>
</div>
</div>
<div class="container border-top border-secondary mt-3">
</div>
<div class="buttons pt-3">
<a class="btn btn-secondary">B</a>
<a class="btn btn-secondary">M</a>
<a class="btn btn-secondary">H</a>
<a class="btn btn-secondary">Unlock Demographics</a>
</div>
</div>
</form>
<div class="tabs pt-3">
<div class="container">
<div class="row">
<div class="col-10">
   

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="demographics-tab" data-toggle="tab" href="#demographics" role="tab" aria-controls="demographics" aria-selected="true">Home</a>
      <a class="nav-item nav-link" id="cs-tab" data-toggle="tab" href="#cs" role="tab" aria-controls="cs" aria-selected="false">Profile</a>
      <a class="nav-item nav-link" id="Identification-tab" data-toggle="tab" href="#Identification" role="tab" aria-controls="Identification" aria-selected="false">Contact</a>
    </div>
  </nav>



<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="demographics-tab" data-bs-toggle="tab" data-bs-target="#demographics-tab-pane" type="button" role="tab" aria-controls="demographics-tab-pane" aria-selected="true">Demographics</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab" data-bs-toggle="tab" onclick="myfunction()" data-bs-target="#cs-tab-pane" type="button" role="tab" aria-controls="cs-tab-pane" aria-selected="false">C&S</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="Identification-tab" data-bs-toggle="tab" data-bs-target="#identification-tab-pane" type="button" role="tab" aria-controls="Identification-tab-pane" aria-selected="false">Contact</button>
  </li>
 
</ul> -->





<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="demographics" role="tabpanel" aria-labelledby="nav-home-tab">
  <form>
  <div class="container">
  <div class="row">
  <div class="col-md-6">
<div class="row">  
<div class="col-md-6">
  <div class="form-outline">
<label class="form-label mb-0" for="chart">Chart#:</label>
<input type="number" id="chart" class="form-control form-control" placeholder="74625" />

</div>
</div>
<div class="col-md-6">
<div class="form-outline">
<label class="form-label  mb-0" for="sample">EXT Sample ID:</label>
<input type="number" id="sample" class="form-control form-control" placeholder="" />

</div>
</div>

</div>
<div class="wrapper pt-3">
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="pregnent" id="pregnent"value="option1"  />
<label class="form-check-label" for="pregnent">Pregnent</label>

</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="penecilin" id="penecilin"value="option1" />
<label class="form-check-label" for="penecilin">Penecilin Allergy</label>

</div>
<div class="row pt-3">
<div class="col-md-4">
<div class="form-outline datepicker w-100">
<label for="dob" class="form-label  mb-0">D.O.B</label>
<div>
<input id="inp1" type="date" name="dob" class="form-control">
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-outline">
<label class="form-label  mb-0" for="age">Age</label>
<input type="text" id="age" class="form-control form-control" placeholder="" />

</div>
</div>
<div class="col-md-4">
<div class="form-outline">
<label class="form-label  mb-0" for="sex">Sex</label>
<input type="text" id="sex" class="form-control form-control" placeholder="Male" />

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="address">Address</label>
<textarea class="form-control"placeholder="Lisawaun" id="address" rows="1"></textarea>

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="hospital">Hospital</label>
<textarea class="form-control"placeholder="Cavan" id="cootihill" rows="1"></textarea>

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="ward">Ward</label>
<textarea class="form-control"placeholder="Medical2" id="ward" rows="1"></textarea>

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="clinician">Clinician</label>
<textarea class="form-control"placeholder="Dr James Hayee" id="clinician" rows="1"></textarea>

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="gp">GP</label>
<textarea class="form-control"placeholder="" id="GP" rows="1"></textarea>

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="comments">Comments</label>
<textarea class="form-control"placeholder="" id="comments" rows="1"></textarea>

</div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-12">
<div class="form-outline">
<label class="form-label mb-0 " for="blank"></label>
<textarea class="form-control"placeholder="" id="blank" rows="5"></textarea>

</div>
</div>
</div>

</div>








</div>
  <div class="col-md-6">
  <div class="row">
  <div class="col-md-6">
  <div class="form-outline datepicker w-100">
<label for="rundate" class="form-label mb-0">Run Date</label>
<div>
<input id="inp1" type="date" name="rundate" class="form-control">
</div>
</div>    
  </div>
  <div class="col-md-6">
  <div class="form-outline datepicker w-100">
<label for="sampledate" class="form-label  mb-0">Sample Date</label>
<div>
<input id="inp1" type="date" name="sampledate" class="form-control">
</div>
</div>    
  </div>    
  </div>
  <div class="wrapper pt-3">
    <div class="row">
      <div class="col-md-12 ">
<input class="form-check-input" type="radio" name="routine" id="pregnent"value="option1"  />
<label class="form-check-label" for="pregnent">Routine</label>

</div>
<div class="col-md-12">
<input class="form-check-input" type="radio" name="routine" id="penecilin"value="option1" />
<label class="form-check-label" for="penecilin">Out Of Hours</label>

</div>
    </div>
 <div class="row pt-3">
     <div class="col-md-6">
       <label class="form-label">Recieved In Lab</label>
       <input type="datetime-local" name="recieved" class="form-control">
     </div>
   </div>
 <div class="row pt-3">
     <div class="col-md-6">
              <label class="form-label">Site</label>
       <input type="text" name="site" class="form-control">
     </div>
          <div class="col-md-6">
              <label class="form-label">Site Details</label>
       <input type="text" name="sitedet" class="form-control">
     </div>
   </div>
<div class="row pt-3">
     <div class="col-md-12 text-center pt-3">
       <h4>Patient AntiBiotics/Intended AntiBiotics</h4>
     </div>

   </div>
   <div class="row pt-3">
     <div class="col-md-6">
        <label class="form-label">Anti Biotics</label>
       <input type="text" name="anti" class="form-control" value="Doxycycline Cipofloaxain">
     </div>
         <div class="col-md-6">
        <label class="form-label">Int.Anti Biotics</label>
       <input type="text" name="intanti" class="form-control"  value="Doxycycline Cipofloaxain">
     </div>
   </div>

   <div class="row pt-3">
     <div class="col-md-12">
        <label class="form-label">Clinical Details</label>
       <input type="text" name="clinical" class="form-control"  >
     </div>
       <div class="col-md-12">
        <label class="form-label"> </label>
       <textarea class="form-control" name="text" ></textarea>
     </div>
   </div>

 <div class="col-md-12 pt-3 mt-2">
  <a href="#" class="btn btn-primary">Order External Tests</a>
    <a href="#" class="btn btn-success">Order Tests</a>
      <a href="#" class="btn btn-warning">Save & Hold</a>
        <a href="#" class="btn btn-secondary">Save</a>
</div>

</div>
   
   
   
   

  </div>
 
</div>


</div>
 </form>  
</div>


<div class="tab-pane fade" id="cs" role="tabpanel" aria-labelledby="nav-profile-tab">

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
 <div class="tab-pane fade" id="Identification" role="tabpanel" aria-labelledby="nav-contact-tab">

  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="select_organism1" class="form-label">Organism 1</label>
                            <select name="select_organism1" id="select_organism1" class="form-select form-control">
                                <option value="1"></option>
                            </select>
                            <textarea name="text_organism1" id="text_organism1" class="w-100 form-control mt-3" rows="15"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="select_organism2" class="form-label">Organism 2</label>
                            <select name="select_organism2" id="select_organism2" class="form-select form-control">
                                <option value="1"></option>
                            </select>
                            <textarea name="text_organism2" id="text_organism2" class="w-100 form-control mt-3" rows="15"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="select_organism3" class="form-label">Organism 3</label>
                            <select name="select_organism3" id="select_organism3" class="form-select form-control">
                                <option value="1"></option>
                            </select>
                            <textarea name="text_organism3" id="text_organism3" class="w-100 form-control mt-3" rows="15"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="select_organism4" class="form-label">Organism 4</label>
                            <select name="select_organism4" id="select_organism4" class="form-select form-control">
                                <option value="1"></option>
                            </select>
                            <textarea name="text_organism4" id="text_organism4" class="w-100 form-control mt-3" rows="15"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" id="gramstainsbtn">Gram Stains Wet Prep</button>
                 </div>   

  </div>
</div>
  </div>
  <div class="col-md-2">
    <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-primary w-100">Interim</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-secondary w-100">Print</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-primary w-100">Phone Results</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-warning w-100">Print ?</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-primary w-100">Set Valid Date</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-secondary w-100">Save & Hold</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-success w-100">Save Details</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-warning w-100">History</a>
      </div>
    </div>
        <div class="row pt-4">
      <div class="col-md-12 text-center">
        <a href="#" class="btn btn-danger w-100">Cancel</a>
      </div>
    </div>
  </div>
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