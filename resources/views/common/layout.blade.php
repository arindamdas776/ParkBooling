<?php
   session_start();
   $sess_user = Auth::guard('org')->user();
   // $_SESSION['ann'] = 'asasas';
   // print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>EEAA - @yield('title')</title>
   <base href="{{url('/')}}">
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta name="title" content="@yield('title', 'Title')">
   <meta name="description" content="@yield('description', '')">
   <meta name="keywords" content="@yield('keywords', '')">

   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}" />

   <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
   <link rel="stylesheet" href="https://ulurn.in/assets/css/slick.css"/>
   <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
   @stack('styles')
   <style>
      .best-staff-nav{
         width: 100%;
         position: absolute;
         top: 45%;
         left: 0%;
      }

      .best-staff-left{

         width: 25px;
         height: 25px;
         cursor: pointer;
         float: left;
         border: 1px solid rgb(129, 129, 135);
         float: left;
         margin-left: -13px;
         border-radius: 50%;

      }
      .best-staff-right {
         width: 25px;
         height: 25px;
         cursor: pointer;
         float: right;
         border: 1px solid     rgb(129, 129, 135);
         margin-right: -13px;
         border-radius: 50%;
      }
      .best-staff-nav i {
         text-align: center;
         line-height: 23px;
         font-size: 19px;
         width: 100%;
         color: rgb(129, 129, 135);
      }
   </style>
   <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script></head>


   <body class="fix-header fix-sidebar card-no-border">
      <div id="main-wrapper">
         <header>
            <div class="top-header">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8">
                        <ul>
                           <li><i class="far fa-envelope"></i> eeaa@eeaa.gov.eg </li>
                           <li><i class="fas fa-phone-volume"></i> 19808</li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                      <ul class="float-right">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="dropdown language-selector">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                              <i class="fas fa-globe"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                           <li class="{{(session('lang')=='en') ? 'active':''}}"><a href='javascript:(0);' onclick="changeLang('en')">English</a></li>
                            <li class="{{(session('lang')=='ar') ? 'active':''}}"><a href='javascript:(0);' onclick="changeLang('ar')">Arabic</a></li>
                         </ul>
                      </li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
      </form>
       <div class="container">
          <nav class="navbar navbar-expand-lg  ">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('/storage/logo/logo.png')}}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                     <a href="{{url('/')}}" class="nav-link">
                     {{__('HOME')}}
                  </a>
               </li>
               <li class="nav-item ">
                  <a href="{{url('/about-us')}}" class="nav-link">
                  {{__('ABOUT US')}}
                  </a>
               </li>
               <li class="nav-item ">
                  <a href="{{url('/news-events')}}" class="nav-link">
                  {{__('NEWS & EVENTS')}}
                  </a>
               </li>
            @if (isset(Auth::guard('org')->user()->id))
               <li class="nav-item ">
                  <a class="nav-link " href="{{url('/my-company')}}">{{ __('MY COMPANY') }}</a>
               </li>
            @else
               <li class="nav-item ">
                  <a class="nav-link " href="{{url('/sign-up')}}">{{ __('SIGN UP') }}</a>
               </li>
            @endif
            @if (!isset(Auth::guard('org')->user()->id))
               <li class="nav-item ">
                  <a class="nav-link " href="{{url('/sign-in')}}">{{ __('SIGN IN') }}</a>
               </li>
            @endif
            @if (isset(Auth::guard('org')->user()->id))
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ $sess_user->photo ? asset('storage/'.$sess_user->photo) : asset('assets/images/dummy-avatar.png') }}" width="35" alt="user" class="profile-pic"></a>
               <div class="dropdown-menu dropdown-menu-right scale-up" style="top: 68% !important;">
                  <ul class="dropdown-user" style="padding: 0px 25px;">
                     
                     
                     <li role="separator" class="divider"></li>
                     <li><a href="{{ route('profile.index') }}"><i class="ti-user"></i> My Profile</a></li>
                     <li><a href="{{ url('sign-in') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a></li>
                  </ul>
               </div>
            </li>
           @endif
      </ul>
   </div>
</nav>
</div>
</header>

<script type="text/javascript">
  function resetLang(new_lang) {
    var referer = "{{url('/')}}";
    var form = document.createElement("form");
    var element1 = document.createElement("input");
    var element2 = document.createElement("input");

    form.method = "POST";
    form.action = "{{url('/language')}}";

    element1.value = new_lang;
    element1.name = "lang";
    form.appendChild(element1);

    element2.value = referer;
    element2.name = "referer";
    form.appendChild(element2);

    document.body.appendChild(form);

    form.submit();
 }
</script>
@yield('content')

<footer>
  <div class="container">
    <form action="" method="post" accept-charset="utf-8">
      <div class="row justify-content-center">
      <h2 class="text-center" style="color: #fff;">{{__('Contact With Us')}}</h2>
     </div>
     <div class="row mt-4">
        <div class="col-md-3" style="color: #fff;">
        <h3 style="color: #fff;">{{__('Primary Address')}}</h3>
          <p style="font-size: 14px; text-align: left;">
            875 Fairfield St.<br>
            Piscataway, Briarwood Ave.<br>
            NJ 08854<br>
            Call: +00 8888 88888
         </p>
      </div>
      <div class="col-md-3" style="color: #fff;">
      <h3 style="color: #fff;">{{__('Alternate Address')}}</h3>
       <p style="font-size: 14px; text-align: left;">
         355 Riverview St.<br>
         Piscataway, New Haven Ave.<br>
         NJ 08647<br>
         Call: +00 8888 88888
      </p>
   </div>
   <div class="col-md-6">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="{{__('Enter Your Name')}}">
       </div>
       <div class="form-group">
       <input type="email" name="email" class="form-control" placeholder="{{__('Enter Your Email')}}">
       </div>
    </div>
    <div class="col-md-6">
     <div class="form-group">
     <textarea name="msg" rows="3" class="form-control" placeholder="{{__('Enter Your Message')}}"></textarea>
    </div>
 </div>
</div>
<div class="row justify-content-center">
   <div class="col-md-12">
   <button type="submit" class="btn btn-info btn-block">{{__('Submit')}}</button>
  </div>
</div>
</div>
</div>
</form>
<div class="row mt-2">
   <div class="col-md-12 col-lg-6">
        <ul>
            <li><a href="{{url('/')}}">{{__('HOME')}}</a></li>
            <li><a href="{{url('/about-us')}}">{{__('ABOUT US')}}</a></li>
            <li><a href="{{url('/my-company')}}">{{ __('MY COMPANY') }}</a></li>
            <li><a href="javascript:;">{{__('Privacy & Policy')}}</a></li>
            <li><a href="{{url('/contact-us')}}">{{__('Contact Us')}}</a></li>
        </ul>
    </div>
    <div class="col-md-12 col-lg-6">
    <p>© {{date('Y')}} {{__('EEAA')}}</p>
    </div>
 </div>
</div>
</footer>
</div>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>

<script src="{{ asset('http://malsup.github.com/jquery.form.js') }}"></script>
<script>
  if ($(".best-staff").length) {
    $(".best-staff").slick({
      dots: false,

      autoplay: true,

      arrows: false,

      autoplaySpeed: 5000,

      slidesToShow: 3,

      slidesToScroll: 2,
      responsive: [
      {
        breakpoint: 1400,

        settings: {
          slidesToShow: 3,

          slidesToScroll: 2,

          infinite: true,

          dots: true
       }
    },

    {
     breakpoint: 1024,

     settings: {
       slidesToShow: 1,

       slidesToScroll: 1,

       infinite: true,

       dots: true
    }
 },

 {
  breakpoint: 800,

  settings: {
    slidesToShow: 1,

    slidesToScroll: 1
 }
},

{
  breakpoint: 639,

  settings: {
    slidesToShow: 1,

    slidesToScroll: 1
 }
}
]
});
    $(".best-staff-left").click(function () {
      $(".best-staff").slick("slickPrev");
   });

    $(".best-staff-right").click(function () {
      $(".best-staff").slick("slickNext");
   });
 }

 function changeLang(lang) {
    $.ajax({
      type: "post",
      url: "{{route('lang.setlang')}}",
      data: {
         lang: lang,
         _token: "{{ csrf_token() }}"
      },
      success: function (response) {
         if(response.status == true){
            location.reload();
         }else{
            alert("Invalid language");
         }

      }
   });
 }
</script>
@stack('scripts')
</body>

</html>
