<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
</head>
<body>
    <!--header-->
    <header class="fix-nav">
        <nav class="navbar navbar-expand-md navbar-shrink navbar-light" id="mainNav">
            <div class="container">
                <a class="navbar-brand logo font-weight-bold"  href="{{url('/')}}">
                    <span class="logo">
                        <img src="{{asset('/images/logo.png')}}" class="img-fluid">
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsiveMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="responsiveMenu">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">
                                State
                            </a>
                        </li>
                        <li class="nav-item ">
                            <!-- dropdown-->
                            <a class="nav-link " href="{{url('/district')}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                District
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/location')}}">Location</a>
                        </li>
                        <li class="nav-item">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
@yield('content')
<script src="{{asset('/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('/js/common.js')}}"></script>
<script src="{{asset('/js/select2.full.min.js')}}"></script>
<script>
$('#seo_url').select2();
$('#pincode').select2();

$("#search").click(function () {
var seo_url = $('#seo_url').find('option:selected').data('seo_url');
var pin_code =  $('#pincode').find('option:selected').val();
if(seo_url) {
     var url = '{{url("/")}}/'+seo_url;
     window.location.replace(url);
}
});
</script>
@stack('scripts')
</body>
</html>
