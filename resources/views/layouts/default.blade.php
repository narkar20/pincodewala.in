<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N7G3464');</script>
<!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N7G3464"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <!--header-->
    <header class="fix-nav">
        <nav class="navbar navbar-expand-md navbar-shrink navbar-light" id="mainNav">
            <div class="container">
                <a class="navbar-brand logo font-weight-bold"  href="{{url('/')}}">
                    <span class="logo">
                        <img alt="Pin Code Number Finder" src="{{asset('/images/logo.png')}}" class="img-fluid">
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsiveMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="responsiveMenu">
                    <!-- <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">
                                State
                            </a>
                        </li>
                        <li class="nav-item ">
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
                    </ul> -->
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

// $("#search").click(function () {
// var seo_url = $('#seo_url').find('option:selected').data('seo_url');
// var pin_code =  $('#pincode').find('option:selected').val();
// if(seo_url) {
//      var url = '{{url("/")}}/'+seo_url;
//      window.location.replace(url);
// }
// });
</script>
@stack('scripts')
</body>
</html>
