@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.product')]) }}: Books and Bucks
@endsection
<script>
    function deleteOffer(id){
        if(confirm("are you sure?")){
            window.location.href = window.location.origin+"/admin/offers/delete/"+id;
        }
    }
</script>
@section('page_title')
    <div class="text-gray-800 flex items-center mt-5">
        <div class="text-xl text-red-700 font-semibold">
            Offers
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.offer.create') }}"
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
            <th scope="col">slug</th>
            <th scope="col">Type</th>
            <th scope="col">Value</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr>
                <th scope="row">{{$offer->id}}</th>
                <td>
                    @if($offer->is_main)
                    <p class="badge badge-primary">highlight</p>
                    @endif
                    {{$offer->name}}</td>
                <td>{{$offer->slug}}</td>
                <td>{{$offer->type }}</td>
                <td>
                  {{$offer->type === "discount_percent" ? $offer->discount_percent ."% off" : ""}}
                  {{$offer->type === "discount_amount" ? $offer->discount_amount . " Rs. off" : ""}}
                  {{$offer->type === "fixed_amount" ? $offer->fixed_amount . " Rs. only" : ""}}
                </td>
                <td>
                    @if(!$offer->is_main)
                        <a href="{{route('admin.offer.highlight',['id'=>$offer->id,'remove'=>0])}}" class="btn btn-primary">highlight</a>
                    @else
                        <a href="{{route('admin.offer.highlight',['id'=>$offer->id,'remove'=>1])}}" class="btn btn-primary">Remove highlight</a>
                    @endif
                    <a href="{{route('admin.offer.edit',['offer_id'=>$offer->id])}}" class="btn btn-success">edit</a>
                    <a onclick="deleteOffer({{$offer->id}})" class="btn btn-danger text-white">delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
