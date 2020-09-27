@extends('layouts.app1')

@section('content')
    <main>
        <div class="container-fluid ml-5 mr-5 mt-5">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-70 text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-2" >
                    <p style="color: red">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    </p>
                </div>
                <div class="col-xl-8 col-lg-4 col-md-6" >
                    <div class="row">
                    @foreach($products as $product)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-popular-items mb-50 text-center">
                                <div class="popular-img">
                                    <img src="{{ $product->main_image_url }}" alt="">
                                    <div class="img-cap">
                                <span>
                                </span>
                                    </div>
                                </div>
                                <div class="popular-caption">
                                    <h4 style="padding-top: 15px;"><a style="color:#444444" href="{{ route('product.show', $product->slug) }}">{{$product->name}}</a></h4>
                                    <span>
                                {{ "₹ " . number_format($product->price, 2) }}
                            </span>
                                </div>
                                <form  method="post" action="{{ route('add.to.cart') }}">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{ $product->slug }}" />
                                    <input type="hidden" name="qty" value="1" />
                                    <button style="width: 100%; background-color: #0b0b0b; padding-top:10px; padding-bottom: 10px;" type="submit" >
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('partials.shop-method')
    </main>
@endsection