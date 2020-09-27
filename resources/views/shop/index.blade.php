@include('layouts.nav')
@extends('layouts.head')

@section('content')

        <shop-page product="{{$products}}"
                   image="{{$images}}"
                   csrf="{{csrf_token()}}"
        ></shop-page>

@endsection