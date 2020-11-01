@extends('layouts.app-self')

@section('content')
    <style>
        .button {
            margin:auto;
            display:block;
        }
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
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
            height: 16px;
            width: 16px;
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
    </style>
    <script>
        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('payment_option')
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }
        $(window).on('load',function() {
        });
    </script>
    <div class="container" style="margin-top:80px;">
        <form method="post" action="{{route('payment.place')}}">
            @csrf
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
             <div class="col-12 offset-lg-7 col-lg-5 mt-3" >
                 <div style="border: 2px solid red;">
                <h4 style="color: #E82323; text-align: center; margin-top: 15px;">
                    Payment Options
                </h4>
                     <div class="toggle_buttons ml-3">

                <div class="row mt-3">
                    <div class="col-2">
                        <label class="switch">
                            <input type="checkbox" onclick="onlyOne(this)" checked name="payment_option" value="a-cash-on-delivery">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-10">
                        <p style="font-size: 20px;">Cash on delivery</p>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <label class="switch">
                            <input type="checkbox" onclick="onlyOne(this)" name="payment_option" value="card">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-10">
                        <p style="font-size: 20px;">Credit/Debit Card</p>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <label class="switch">
                            <input type="checkbox" onclick="onlyOne(this)" name="payment_option" value="upi">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-10">
                        <p style="font-size: 20px;">Upi/Google Pay/Phone Pay</p>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <label class="switch">
                            <input type="checkbox" onclick="onlyOne(this)" name="payment_option" value="paytm">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-10">
                        <p style="font-size: 20px;">Paytm</p>
                    </div>
                </div>
                         <input type="hidden" name="orderId" value="{{$orderId}}">
                 <div class="wrapper">
                     <button type="submit"
                            class="px-3 py-3 my-3 bg-red-500 text-white text-sm font-semibold button rounded"
                            style="font-size: 25px;"
                            id="submit-button"
                    >
                        Place Order
                    </button>
                 </div>
                     </div>

                 </div>
             </div>
        </div>
        </form>
    </div>
    @endsection