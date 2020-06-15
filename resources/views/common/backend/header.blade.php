<?php
    $sess_user = Auth::user();
    // dd($sess_user);
?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('my-company')}}">
                <b>
                    <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                    <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                </b>
                <span>
                    <img src="{{ url('/storage/logo/logo.png') }}" alt="homepage" class="dark-logo" style="width:35px;">
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0">
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-white waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-white waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown" data-close-others="true">
                            <i class="fas fa-globe" style="color: white;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right scale-up">
                            <ul class="dropdown-user">
                                <li class='active'><a href='javascript:(0);' onclick="changeLang('en')">English</a></li>
                                <li><a href='javascript:(0);' onclick="changeLang('ar')">Arabic</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ $sess_user->photo ? asset('storage/'.$sess_user->photo) : asset('assets/images/dummy-avatar.png') }}" alt="user" class="profile-pic"></a>
                        <div class="dropdown-menu dropdown-menu-right scale-up">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="{{ $sess_user->photo ? asset('storage/'.$sess_user->photo) : asset('assets/images/dummy-avatar.png') }}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>
                                                <?php
                                                echo ($sess_user->name != null) ? $sess_user->name : 'N/A';
                                                ?>
                                            </h4>
                                            <p class="text-muted">
                                                <?php
                                                    echo ($sess_user->email != null) ? $sess_user->email : '';
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('profile.index') }}"><i class="ti-user"></i> My Profile</a></li>
                                <li><a href="{{ url('sign-in') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <script>

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
