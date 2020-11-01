<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    {{--<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">

    <title>Books & Bucks</title>
</head>
<style>
    *{
        font-family: "Josefin Sans", sans-serif;
    }
    .to-hide{
        display: block;
    }
    .to-show{
        display: none;
    }
    .searchbar{
        margin-bottom: auto;
        margin-top: auto;
        height: 40px;
        background-color: #353b48;
        border-radius: 30px;
        padding: 10px;
    }

    .search_input{
        color: white;
        border: 0;
        outline: 0;
        background: none;
        width: 0;
        caret-color:transparent;
        /*line-height: 40px;*/
        transition: width 0.4s linear;
    }

    .searchbar:hover > .search_input{
        padding: 0 10px;
        width: 190px;
        caret-color:red;
        transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
        background: white;
        color: #e74c3c;
    }

    .search_icon{
        height: 20px;
        width: 20px;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        color:white;
        text-decoration:none;
    }

    body{
        font-family: 'Josefin Sans', sans-serif;
    }

    html {
        scroll-behavior: smooth;
    }
    .logo{
        margin-left: 50px;
    }
    .navbar-toggler{
        display:none;
    }
    @media (max-width:768px) {
        .navbar-toggler{
            display:block;
            padding: 0px;
            border:none;
        }
        .logo{
            margin-left: 30px;
        }
        .logo-img{
            /*width:270px;*/
            margin-left:-10px;
        }
        .to-hide{
            display: none;
        }
        .to-show{
            display: block;
        }
    }
    #side-drawer {
        height: 100vh;
        width: 336px;  /*Ideal width for sidebar accdg to https://forums.envato.com/t/standard-sidebar-width/75633*/
        top: 0;
        left: -336px;
        z-index: 1032;  /*z-index of standard bootstrap navbar is 1030 + 1 offset due to side-drawer-void*/
        transition: left 0.25s ease;
    }

    #side-drawer-void {
        height: 100%;
        width: 100%;
        top: 0;
        z-index: 1031;  /*z-index of standard bootstrap navbar is 1030*/
        background: rgba(0,0,0,.6);
    }

</style>
<body>
<div id="app">

@include('partials.header-self')
            @yield('content')
</div>

<!-- End Main Content -->
@if(file_exists(public_path('mix-manifest.json')))
    <script src="{{ mix('js/avored.js') }}"></script>
@else
    <script src="{{ asset('js/avored.js') }}"></script>
@endif

@stack('scripts')

@if(file_exists(public_path('mix-manifest.json')))
    <script src="{{ mix('js/app.js') }}"></script>
@else
    <script src="{{ asset('js/app.js') }}"></script>
@endif
@include('partials.footer-self')
<!-- Bootstrap JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Side Drawer JS -->
<script>

    function openSideDrawer() {
        document.getElementById("side-drawer").style.left = "0";
        document.getElementById("side-drawer-void").classList.add("d-block");
        document.getElementById("side-drawer-void").classList.remove("d-none");
    }

    function closeSideDrawer() {
        document.getElementById("side-drawer").style.left = "-336px";
        document.getElementById("side-drawer-void").classList.add("d-none");
        document.getElementById("side-drawer-void").classList.remove("d-block");
    }
    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
            return true;
        }).catch(function(e) {
            var carbonScript = document.createElement("script");
            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
            carbonScript.id = "_carbonads_js";
            document.getElementById("carbon-block").appendChild(carbonScript);
        });
    } catch (error) {
        console.log(error);
    }
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>

</body>
</html>