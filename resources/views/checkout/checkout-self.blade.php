@extends('layouts.app-self')

@section('content')
<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .plus-icon{
        color: #E82323;
        font-size: 60px;
    }
    .plus-icon:hover{
        color: green;
    }
</style>
<script>
    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('exampleRadios')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }
    $(window).on('load',function() {
        let cartCount = "<?php echo count(Cart::toArray()) ?>"
        let addressCount = "<?php echo count($addresses) ?>"
        if (addressCount === "1"){
            $(".new_address_table").hide();
        }
        if (cartCount === "0"){
            $("#submit-button").prop('disabled', true);
        }
    });
        function showAddAddress() {
            $(".new_address_table").show();
    }
</script>
    <form method="post" action="{{route('order.place')}}">
        @csrf
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <table class="table" style="border-top: #E82323; border-right: #E82323; border-bottom: #E82323; border-left: #E82323; border-style: solid">
                    <thead style="background-color: #E82323; color:white;">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Line Total</th>
                    </tr>
                    </thead>
                    <tbody style="border-bottom: #E82323; border-right: #E82323; border-left: #E82323; border-style: solid; border-width: 2px;">
                    @if(count(Cart::toArray())===0)
                        <tr>
                            <td>
                                Your cart is empty
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                    @foreach(Cart::toArray() as $item)
                    <tr>
                        <td scope="row">
                            <img style="width:50px; height: 50px" src="{{$item['image']}}">
                        </td>
                        <td>
                            <a href="{{'/product/'. $item['slug']}}">{{$item['name']}}</a>
                            @foreach($item['attributes'] as $attributeInfo)
                            <p>
                                {{ $attributeInfo['attribute_name'] .':'. $attributeInfo['attribute_dropdown_text'] }}
                            </p>
                                @endforeach
                        </td>
                        <td>
                            ₹ {{ $item['price'] .' x '. $item['qty'] }}
                        </td>
                        <td>
                            ₹ {{ (int)$item['qty'] * (int)$item['price'] + (int)$item['tax'] }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td>Discount</td>
                        <td>₹ {{ Cart::discount() }}</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td>Total</td>
                        <td>₹ {{ Cart::total() }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="row mt-2">
            <div class="col-12 col-lg-6">
                <h4 style="color: #E82323;">
                    User Info
                </h4>
                @guest('customer')
                    <div class="row">
                        <div class="col">
                            <input type="text" name="fname" class="form-control" placeholder="First name">
                        </div>
                        <div class="col">
                            <input type="text" name="lname" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                    <input class="form-control mt-2" name="mail" type="email" placeholder="email">
                @else
                    <div style="border: black; border-width: 1px; border-style: solid; ">
                        <h5 style="margin-top: 15px; margin-left: 15px;">{{auth()->guard('customer')->user()->full_name}}</h5>
                    </div>
                @endguest

                <h4 class="mt-3" style="color: #E82323;">
                    Shipping Address
                </h4>
                @if(count($addresses))
                <div style="border: black; border-width: 1px; border-style: solid; ">
                    <h5 class="m-2">Saved Addresses</h5>
                    <div class="row">
                        @foreach($addresses as $address)
                        <div class="col-5">
                            <div class="address m-2 p-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="shipping_address_id" onclick="onlyOne(this)" id="exampleRadios1" value="{{$address->id}}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{$address->first_name." ".$address->last_name.', '. $address->phone}}<br>
                                        {{$address->address1}}<br>{{$address->address2 ?? ""}}
                                        {{$address->postcode.' '. $address->city.' '. $address->state.' '. $address->country->name}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-2">
                            <i onclick="showAddAddress()" class="far mt-2 plus-icon fa-plus-square"></i><br>
                        </div>
                    </div>
                </div>
                @endif
                <div class="new_address_table mt-3">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="shipping['first_name']" class="form-control" placeholder="First name">
                        </div>
                        <div class="col">
                            <input type="text" name="shipping['last_name']" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                    <input type="tel" name="shipping['phone']" class="form-control mt-2" placeholder="Phone">
                    <input type="hidden" name="country_id">
                    <input type="text" class="form-control mt-2" name="shipping['address1']" placeholder="address 1">
                    <input type="text" class="form-control mt-2" name="shipping['address2']" placeholder="address 2">
                    <div class="row mt-2">
                        <div class="col">
                            <select name="shipping['country_id']" class="form-control mt-2" placeholder="105">
                                @foreach($countryOptions as $countryId => $country)
                                    <option  value="{{$countryId}}"
                                             @if($countryId === 105)
                                             selected
                                            @endif
                                    >{{$country}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control mt-2" name="shipping['state']" placeholder="state">
                        </div>
                    </div>
                    <input type="hidden" name="use_different_address" value="0">
                    <div class="row mt-2">
                        <div class="col">
                            <input type="number" name="shipping['postcode']" class="form-control" placeholder="Postcode">
                            <input type="hidden" name="shipping['company_name']">
                        </div>
                        <div class="col">
                            <input type="city" name="shipping['city']" class="form-control" placeholder="City">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">

                <h4 style="color: #E82323;">
                    Payment Options
                </h4>
                <div class="row mt-4">
                    <div class="col-2">
                        <label class="switch">
                            <input type="checkbox" checked name="payment_option" value="a-cash-on-delivery">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-10">
                        <p style="font-size: 25px;">Cash on delivery</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-10">
                        <p style="font-size: 25px;">Net Banking</p>
                    </div>
                </div>
                <input type="hidden" name="shipping_option" value="pickup">
                <button type="submit"
                        class="px-3 py-2 mt-3 bg-red-500 text-white text-sm font-semibold rounded"
                        style="font-size: 25px;"
                        id="submit-button"
                >
                    Place Order
                </button>
            </div>
        </div>
    </div>
        </form>

@endsection