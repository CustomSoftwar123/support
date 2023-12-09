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