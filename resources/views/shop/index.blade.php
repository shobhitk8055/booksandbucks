@extends('layouts.app-self')

@section('content')
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