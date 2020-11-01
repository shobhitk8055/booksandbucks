@extends('layouts.app-self')

@section('content')
    <div style="margin-top: 30px; padding-top: 30px;">
            <avored-layout inline-template>
                <shop-page product="{{\AvoRed\Framework\Database\Models\Product::all()}}"
                           image="{{$images}}"
                           csrf="{{csrf_token()}}"
                           genre="{{\AvoRed\Framework\Database\Models\Genre::all()}}"
                           genre_books="{{$book_genre}}"
                           selected="{{$category}}"
                           category ="{{\AvoRed\Framework\Database\Models\Category::all()}}"
                           category_product="{{$category_products}}"
                           are_book="{{0}}"
                ></shop-page>
            </avored-layout>
    </div>
@endsection