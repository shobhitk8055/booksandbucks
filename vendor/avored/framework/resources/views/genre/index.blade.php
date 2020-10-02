@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.product')]) }}: Books and Bucks
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center mt-5">
        <div class="text-xl text-red-700 font-semibold">
            Genres
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.genre.create') }}"
               class="py-2 px-3 font-semibold text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
               style="font-size: 15px;"
            >
                <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                </svg>
                {{ __('avored::system.btn.create') }}
            </a>
        </div>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <table class="table">
        <thead style="background-color: #4A5568; color: white;">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($genres as $genre)
        <tr>
            <th scope="row">{{$genre->id}}</th>
            <td>{{$genre->name}}</td>
            <td>
                <a href="delete" class="btn btn-danger">delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
