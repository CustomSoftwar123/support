@include('layouts.header')

    

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1 class="m-0">Bulk User Info Upload
                <a class="btn btn-primary btn-sm" href="{{route('Users')}}"><i class="fas fa-arrow-left"></i> GO BACK </a>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6  d-none d-sm-none d-md-block ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
                           

                   
                        <div class="card radius-10">
                            <div class="card-body">                  
                            
                                    <form class="g-3 mt-1">
                                              {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-xl-12 mx-auto">
                                                <h6 class="mb-0 text-uppercase">Upload New Users List</h6>
                                                <hr/>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <input id="file" type="file" name="file" accept=".csv">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </form>
           
                            </div>
                        </div> 

                        <div class="card radius-10" style="display: none;" id="Results">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mt-0">Results</h5>
                                        <p class="mb-0"><span id="counter"></span> Users found in database out of <span id="tcounter"></span> uploaded users.</p>
                                        
                                        <form class=" g-3 mt-1"  id="form">
                                        
                                              {{ csrf_field() }}
                                        
                                            <button type="button" class="btn btn-primary syncData">Sync Users Data</button>
                                                
                                         </form>
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
    <script src="{{ asset('assets/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
<script>

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('#file').FancyFileUpload({
    
            url : "{{ route('UploadUsersDataFile') }}",
            maxfilesize: 100000000,
            added : function(e, data) {
                this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
            },
            uploadcompleted : function(e, data) {
                  if ($.isEmptyObject(data.error)){
                         Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: data.result.success,
                                icon: 'bx bx-check-circle'
                            });
                         data.ff_info.RemoveFile();
                         // $('#Results').css('display','block');
                         // $('#counter').text(data.result.products);  
                         // $('#tcounter').text(data.result.tproducts);    

                         window.location="{{route('Users')}}";                     

                    } else {
                         Lobibox.notify('warning', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: data.result.error,
                                icon: 'bx bx-info-circle'
                            });
                         $('#Results').css('display','none')
                    }
            }
        });


   $(".syncData").click(function (event) { 

          $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: "{{ route('syncUsersData') }}",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(data) {
                  if ($.isEmptyObject(data.error)){
                         Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: data.success,
                                icon: 'bx bx-check-circle'
                            });

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

   })


</script>
@endpush




