@extends('layouts.app-self')

@section('content')
<style>

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
        console.log(typeof parseInt(addressCount));
        if (parseInt(addressCount)){
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
            <div class="col-12 col-lg-4">
                <h4 style="color: #E82323;">
                    User Info
                </h4>
                @guest('customer')
                    <div class="row">
                        <div class="col">
                            <input type="text" name="first_name" class="form-control" placeholder="First name">
                        </div>
                        <div class="col">
                            <input type="text" name="last_name" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                    <input class="form-control mt-2" name="email" type="email" placeholder="email">
                    <div class="row mt-2">
                        <div class="col">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" name="confirm_password" class="form-control" placeholder="confirm_password">
                        </div>
                    </div>
                @else
                    <div style="border: black; border-width: 1px; border-style: solid; ">
                        <h5 style="margin-top: 15px; margin-left: 15px;">{{auth()->guard('customer')->user()->full_name}}</h5>
                    </div>
                @endguest
            </div>
            <div class="col-12 col-lg-8">
                <h4 class="" style="color: #E82323;">
                    Shipping Address
                </h4>
                @if(count($addresses))
                <div style="border: black; border-width: 1px; border-style: solid; ">
                    <h5 class="m-2">Saved Addresses</h5>
                    <div class="row">
                        @foreach($addresses as $address)
                        <div class="col-4">
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
                <input type="hidden" name="shipping_option" value="pickup">
                <button type="submit"
                        class="px-3 py-3 my-3 bg-red-500 text-white text-sm font-semibold button rounded"
                        style="font-size: 25px;"
                        id="submit-button"
                >
                    Continue to Payment
                </button>
        </div>
    </div>
        </form>

@endsection