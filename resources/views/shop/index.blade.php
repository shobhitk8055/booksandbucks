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
                padding-top: 0 10px;
                width: 250px;
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
@include('partials.header-self')
</body>

@extends('layouts.head')

@section('contents')
<div style="margin-top: 30px; padding-top: 30px;">
        <shop-page product="{{$products}}"
                   image="{{$images}}"
                   csrf="{{csrf_token()}}"
                   genre="{{$genres}}"
                   genre_books="{{$genre_books}}"
                   category ="{{$categories}}"
                   category_product="{{$category_product}}"
                   are_book="0"
        ></shop-page>
</div>
@endsection