@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.product')]) }}: Books and Bucks
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center mt-5">
        <div class="text-xl text-red-700 font-semibold">
            Add genre
        </div>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <form action="{{route('admin.genre.store')}}" method="post">
        @csrf
        <label for="name">Name</label>
        <input id="name" type="text" name="name" class="form-control" placeholder="name">
        <button type="submit" class="btn mt-4 btn-danger">Save</button>
    </form>
@endsection
