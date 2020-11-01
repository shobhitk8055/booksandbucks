<!-- Begin Side Drawer -->
<div id="side-drawer" class="position-fixed">
    <div class="h-100 bg-white">
        <!-- Side Drawer Title -->
        <div class="p-4 bg-white">
            <a href="#">
                <img src="/assets/img/logo/logo.png">
            </a>
        </div>
        <!-- Side Drawer Links -->
        <ul id="links" class="list-group" onclick="closeSideDrawer()">
            <h5 class="ml-3 mt-2">Latest Offers</h5>
        @foreach(\AvoRed\Framework\Database\Models\Offer::where('is_main',1)->get() as $offer)
                <a id="link-structure" href="#" class="list-group-item list-group-item-action border-0 rounded-0">{{$offer->name}}</a>
            @endforeach
            <h5 class="ml-3 mt-2">Customer Area</h5>
                @auth('customer')
                    <a id="link-structure" href="{{ route('account.dashboard') }}" class="list-group-item list-group-item-action border-0 rounded-0">Dashboard</a>
                    <a id="link-structure" href="{{ route('logout')  }}" class="list-group-item list-group-item-action border-0 rounded-0">Logout</a>
                @else
                    <a id="link-structure" href="{{ route('login') }}" class="list-group-item list-group-item-action border-0 rounded-0">Login</a>
                    <a id="link-structure" href="{{ route('register')  }}" class="list-group-item list-group-item-action border-0 rounded-0">Register</a>

                @endauth
        </ul>
    </div>
</div>
<div id="side-drawer-void" class="position-fixed d-none" onclick="closeSideDrawer()"></div>
<!-- End Side Drawer -->

<div class="py-3 px-2 fixed-top navbar-dark" style="background-color: #000; color: white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 navbar-toggler">
                <button class="navbar-toggler"  type="button" onclick="openSideDrawer()">
                    <span style="color: red;" class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-3"><a href="/">
                <img style="max-width: 316%;" class="logo-img" src="/assets/img/logo/logo.png"></a>
            </div>
            <div class="col-1 offset-3 to-show"><a>
                    <i class="fas fa-search" style="font-size: 25px; color: red;"></i></a>
            </div>
            <div class="col-1 ml-2 to-show"><a href="{{ route('cart.show') }}">
                <i class="fas fa-shopping-cart text-large" style="color: red;"></i></a>
                <span style="position: absolute;" class="badge ml-5 badge-light">{{Cart::all()->count() === 0 ? "" : Cart::all()->count()}}</span>

            </div>
            @auth('customer')
            <div class="col-1 ml-2 to-show"><a href="{{ route('account.dashboard') }}">
                    <i class="far fa-user" style="font-size: 25px; color: red;"></i></a>
            </div>
            @else
            <div class="col-1 ml-2 to-show"><a href="{{ route('login') }}">
                    <i class="far fa-user" style="font-size: 25px; color: red;"></i></a>
            </div>
            @endauth
            <div class="col-4 mt-2 to-hide" style="font-size: 15px; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">
                <div class="row">
                    @foreach(\AvoRed\Framework\Database\Models\Offer::where('is_main',1)->take(4)->get() as $offer)
                    <div class="col-3">
                        <a class="text-white" href="{{'/offer/'.$offer->slug}}">{{$offer->name}} </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-3 to-hide">
                <div id="app">
                    <avored-layout inline-template>
                        <search-bar products="{{AvoRed\Framework\Database\Models\Product::all()}}"
                                    images="{{\AvoRed\Framework\Database\Models\ProductImage::all()}}"
                                    books="{{\AvoRed\Framework\Database\Models\Book::all()}}"
                        ></search-bar>
                    </avored-layout>
                </div>
            </div>
            {{--<div class="col-3 to-hide">--}}
                {{--<div class="d-flex justify-content-center h-100">--}}
                    {{--<div class="searchbar">--}}
                        {{--<input class="search_input" type="text" name="" placeholder="Search...">--}}
                        {{--<a href="#" class="search_icon pr-3 pt-1"><i class="fas fa-search"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="col-2 to-hide">
                <a style="width: max-content;" href="{{ route('cart.show') }}">
                    <i class="fas fa-shopping-cart mt-2" style="font-size: 25px; color: #E12323;"></i>
                    <span class="badge badge-light">{{Cart::all()->count() === 0 ? "" : Cart::all()->count()}}</span>
                </a>
                @auth('customer')
                <a  style="width: max-content;" href="{{ route('account.dashboard') }}"><i class="far fa-user mt-2 ml-3" style="font-size: 25px; color: #E12323;"></i></a>
                @else
                <a  style="width: max-content;" href="{{ route('login') }}"><i class="far fa-user mt-2 ml-3" style="font-size: 25px; color: #E12323;"></i></a>
                @endauth
            </div>
        </div>
    </div>

</div>