@extends('layouts.app-self')

@section('content')

@include('partials.slider-self')
<style>
    .icon-column{
        background-color: #E82323;
        border-right: white;
        border-top: white;
        border-style: solid;
        border-width: 1px;
    }
    .icon{
        text-align: center;
        color:white;
        font-size: 50px;
        margin-top:20px;
    }
    .icon-text{
        text-align: center;
        color:white;
    }
    .popular-items{
        padding-top: 90px;
    }
    @media (max-width: 700px) {
        .to-hide{
            display: none;
        }
        .popular-items{
            padding-top: 30px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-4 col-lg-2 icon-column">
            <p class="icon">
                <i class="fas fa-book" ></i>
            </p>
            <p class="icon-text">
                Best books {{ \Illuminate\Support\Facades\Session::get('modal') }}
            </p>
        </div>
        <div class="col-4 col-lg-2 icon-column">
            <p class="icon">
                <i class="fas fa-truck"></i>
            </p>
            <p class="icon-text">
                Best books
            </p>
        </div>
        <div class="col-4 col-lg-2 icon-column">
            <p class="icon">
                <i class="fas fa-truck-loading"></i>
            </p>
            <p class="icon-text">
                Best books
            </p>
        </div>
        <div class="col-4 col-lg-2 to-hide icon-column">
            <p class="icon">
                <i class="fas fa-coins"></i>
            </p>
            <p class="icon-text">
                Best books
            </p>
        </div>
        <div class="col-4 col-lg-2 to-hide icon-column">
            <p class="icon">
                <i class="fas fa-chart-line"></i>
            </p>
            <p class="icon-text">
                Best books
            </p>
        </div>
        <div class="col-4 col-lg-2 to-hide icon-column">
            <p class="icon">
                <i class="fas fa-book" ></i>
            </p>
            <p class="icon-text">
                Best books
            </p>
        </div>

    </div>
</div>
<!-- Begin Main Content -->
    <div class="popular-items">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-10 text-center">
                        <h2>Feature Collections</h2>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\AvoRed\Framework\Database\Models\Product::all() as $product)
                    <div class="col-4 col-lg-2 col-md-3">
                        <div class="single-popular-items mb-50 text-center">
                            <div class="popular-img">
                                <img src="{{ $product->main_image_url }}" alt="">
                                <div class="img-cap">
                                <span>
                                    <form  method="post" action="{{ route('add.to.cart') }}">
                                    @csrf
                                        <input type="hidden" name="slug" value="{{ $product->slug }}" />
                                        <input type="hidden" name="modal" value="1" />
                                    <input type="hidden" name="qty" value="1" />
                                    <button style="background-color: transparent; border: none;">
                                        Add to cart
                                    </button>
                                    </form>
                                </span>
                                </div>
                                <div class="favorit-items">
                                    <span class="flaticon-heart"></span>
                                </div>
                            </div>
                            <div class="popular-caption">
                                <h3><a href="{{ route('product.show', $product->slug) }}">{{$product->name}}</a></h3>
                                <span>
                                {{ "₹ " . number_format($product->price, 2) }}
                            </span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>


            <!-- Button -->
            {{--<div class="row justify-content-center">--}}
                {{--<div class="room-btn pt-70">--}}
                    {{--<a href="catagori.html" class="btn view-btn1 " style="background-color: black;">View More Books </a> <br>--}}
                    {{--<br><br><br>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 150px; padding-top: 100px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product added to the Cart!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><i class="fas fa-check-square" style="font-size: 100px; color: green;"></i></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('cart.show')}}" type="button" class="btn btn-primary">View Cart</a>
            </div>
        </div>
    </div>
</div>
@if( \Illuminate\Support\Facades\Session::get('modal'))
    <script>
        $(window).on('load',function(){
            $("#exampleModal").modal('show');
        });
    </script>
@endif
@include('partials.shop-method')

@endsection


