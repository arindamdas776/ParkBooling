<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - @yield('product_title')</title>
    @include('common.backend.styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        @include('common.backend.header')
        @include('common.backend.sidebar')
        
        @stack('actions')
        @stack('style')
        <style>
            .printbtn {
                background: #000;
                color: #fff;
                padding: 5px 21px;
                border: 0px;
                outline: 0px;
            }
        </style>
        @yield('content')

        @include('common.backend.scripts')
        @stack('scripts')
</body>

</html>