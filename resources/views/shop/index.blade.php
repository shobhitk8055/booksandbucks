@include('layouts.nav')
@extends('layouts.head')

@section('content')

        <shop-page product="{{$products}}"
                   image="{{$images}}"
                   csrf="{{csrf_token()}}"
                   category ="{{$categories}}"
                   category_product="{{$category_product}}"
        ></shop-page>

@endsection