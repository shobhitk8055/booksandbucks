@extends('layouts.app1')

@section('content')

    <main>
        <!--================Single Product Area =================-->
        <div class="product_image_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="product_img_slide owl-carousel">
                            @foreach($images as $image)
                            <div class="single_product_img">
                                <img src="{{'/storage/'.$image->path}}" alt="#" class="img-fluid">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="single_product_text text-center">
                            <h3>{{ $product->name }}</h3>
                            <p>
                                {!! $product->description !!}                            </p>

                            @php
                                $properties = $product->getProperties();
                            @endphp
                            @if ($properties !== null && $properties->count() > 0)
                                @foreach ($properties as $property)
                                    <p>{{ $property->name }}: {{ $property->getPropertyDisplayTextByProductId($product->id) }}</p>
                                    @endforeach
                                    @endif
                            <div class="card_area">
                                <div class="product_count_area">
                                    <p>Quantity</p>
                                    <div class="product_count d-inline-block">
                                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                        <input class="product_count_item input-number" type="text" value="1" min="0" max="10">
                                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                    </div>
                                    <p>{{ session()->get('default_currency')->symbol . number_format($product->price, 2) }}</p>
                                </div>
                                <div class="add_to_cart">
                                    <form  method="post" action="{{ route('add.to.cart') }}">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $product->slug }}" />
                                        <input type="hidden" name="qty" value="1" />
                                        <button type="submit" class="btn_3">add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection