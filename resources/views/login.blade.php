<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ \App\Http\Controllers\business::businessinfo()[0]->name }}</title>

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/' . \App\Http\Controllers\business::businessinfo()[0]->file) }}"/>
   
  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link id="currentLink" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('plugins/notifications/css/lobibox.min.css') }}" />
    <!-- Select2 -->
  <link href="{{ asset('plugins/select2/css/select2.min.css?1112') }}" rel="stylesheet" >
  <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css?1112') }}" rel="stylesheet" >

<style type="text/css">
      
      :root {
       --main-color:#6c757d; 
       --main-font:inherit;
       --main-font_weight:400; 
      }

      .login-box, .register-box {
      width: 450px;
      }

      .lobibox-notify.lobibox-notify-success{
          border-color: var(--main-color);
          background-color: var(--main-color);
          color: #FFF;
      }

  .card-header {
     background-color: transparent;
     border-bottom: 0px solid rgba(0,0,0,.125);
     padding: 20px; 
     position: relative; 
     border-top-left-radius: 0; 
     border-top-right-radius: 0; 
}

.card-body {
    padding-top: 0;
}
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: auto;
    user-select: none;
    -webkit-user-select: none;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    left: 50%;
    margin-left: -4px;
    margin-top: -2px;
    position: absolute;
    top: 20px;
    width: 0;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    display: block;
    padding-left: 0px;
    padding-right: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

  </style>

</head>
<script>

if({{Auth::check()}}){
window.location="home";

}


</script>
<!-- <body class="hold-transition login-page"> -->

<div class="container-fluid">
    <div class="row mh-100vh"> 
   <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block" style="">
        <div class="m-auto w-lg-75 w-md-75">
          <img class="img-fluid d-block mx-auto" src="{{asset('/images/6398865d68122.jpg')}}" width="30%">
          <div class=""> <h3 class=" "  style="color:#01313F; width: 100%; " >
          </i> <b>OCM Support </b></h3></div>
         <br>
         <form id="form">
          {{csrf_field()}}
    <div class="form-group mb-3">
        <label class="form-label text-secondary">Email</label>
        <input class="form-control" type="text" name="email" id="email" required="" autocomplete="off">
    </div>
    <div class="form-group mb-3">
        <label class="form-label text-secondary">Password</label>
        <input class="form-control" type="password" required="" id="password" name="password">
    </div>
    <button class="btn mt-2 text-light" style="background-color:#01313F;" type="button" id="submit">Login</button>
</form>

          <p class="mt-3 mb-0"><a class="text-PRIMAEY small" href="#">Forgot your email or password?</a></p>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-end" id="bg-block" style=".jpg?h=6f710c555d3760316048f4d8794f11de&quot;);background-size:cover;background-position:center center;">
        <dotlottie-player src="https://lottie.host/143513f7-0484-4e9d-8956-0eeae49d0e9b/sZXyl5NJyx.lottie" background="transparent" speed="1" style="width: 100%; height: 100%;" loop="" autoplay=""></dotlottie-player>
      </div>
    </div>
  </div>
<!-- /.login-box -->


<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- toastr notifications / alerts --> 
<script src="{{ ('plugins/notifications/js/notifications.min.js') }}"></script>
<script src="{{ ('plugins/notifications/js/notification-custom-script.js') }}"></script> 


<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://andreivictor.ro/select2-searchInputPlaceholder.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>


    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 $(document).ready(function () {

  //  $('#email').select2({
  //     minimumInputLength:3
  //  });

  // $(document).on('select2:select', '#email', function () { 

      
      loadInfo()
      $('#password').focus();

  //     })

  //   $(document).on('select2:open', '#email', function () { 

  //                   $(".select2-search__field")[0].focus();
  //              })


  $("#password").keyup(function(e) {
          
              $("#password").attr('type','password')
        });
 

   function loadInfo() { 


        let email = $('#email').val();
        // let position = email.search("@");

        // if(position <= 0) {

        //   return false;
        // }

        $.ajax({
          type: 'get',
          url:"{{ route( 'getUserTheme') }}",
          data: {'email' : email},
          dataType: 'json',                   
          success: function(response){

              // if ($.isEmptyObject(response.error)){
                       
              //         //  console.log(response);
                       
              //          $("body").get(0).style.setProperty("--main-color",'#'+response.data[0].colorscheme);

              //          $("#submit").css('background','#'+response.data[0].colorscheme);
              //          $("#submit").css('border-color','#'+response.data[0].colorscheme);
              //          $(".forgotPassword").attr('style','color:#'+response.data[0].colorscheme+' !important;');
              //          $('.card-outline').attr('style','border-top:3px solid #'+response.data[0].colorscheme+' !important;');
              //          $('body').css('font-weight',response.data[0].font_weight);
              //          $('body').css('font-family',response.data[0].font);
              //          $("body").get(0).style.setProperty("--main-color", '#'+response.data[0].colorscheme+' !important;');
              //          $('#currentLink').attr('href',response.data[0].font_link);
              //         $('#logo').attr('style', '');    
                         
              //       }

           }
         })  


 }

   $(document).on('click', '#password', function () { 

          loadInfo();

   })
   function login(){

//     $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
        event.preventDefault();

        // Get form
        // var data = $('#form').serialize();

        // Create an FormData object
        // var data = new FormData(form);

        //$("#login").prop("disabled", true);
        // data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        var form = $('#form')[0];
        var data =new FormData(form)
        console.log(data)
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "login",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(data) {
              // console.log(data)
                    if ($.isEmptyObject(data.error)){
                         Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: data.success,
                                icon: 'bx bx-check-circle',
                                delay:1000000
                            });

                         if(data.new == 1) {

                         window.location.replace("{{route('MyProfile')}}");

                         } else {

                          window.location.replace("{{route('home')}}");
                        
                         }
                         
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

var wage = document.getElementById("password");
//  console,log
// $("#password").keypress(function(e){

wage.addEventListener("keydown", function (e) {
 
   //checks whether the pressed key is "Enter"

    if (e.code === "Enter") { 
  //stop submit the form, we will post it manually.
login();
// console.log("ss");
    }


    
});
$("#submit").click(function (event) {


        
        login();

        
});

});

window.localStorage.setItem('openOnePage', Date.now());
 var onLocalStorageEvent = function(e){
    
   if(e.key == "openOnePage"){
  
        window.localStorage.setItem('pageAlreadyOpen', Date.now());
        }
        
        if(e.key == "pageAlreadyOpen"){
          var getcurrent  = window.location.href;
          console.log(getcurrent);
         
            window.location.href="/Error";
        
            return false;
          
        }
    
    };     
        window.addEventListener('storage', onLocalStorageEvent, false);
    </script>


</body>
</html>
