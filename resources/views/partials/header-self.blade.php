<!-- Begin Side Drawer -->
<div id="side-drawer" class="position-fixed">
    <div class="h-100 bg-white">
        <!-- Side Drawer Title -->
        <div class="p-4 bg-dark">
            <a href="#">
                <h1 class="text-white">Home</h1>
            </a>
        </div>
        <!-- Side Drawer Links -->
        <ul id="links" class="list-group" onclick="closeSideDrawer()">
            <a id="link-structure" href="#" class="list-group-item list-group-item-action border-0 rounded-0">jQuery</a>
            <a id="link-css" href="#" class="list-group-item list-group-item-action border-0 rounded-0 active">Script</a>
            <a id="link-javascript" href="#" class="list-group-item list-group-item-action border-0 rounded-0">.Net</a>
            <a id="link-customization" href="#" class="list-group-item list-group-item-action border-0 rounded-0">Demo Page</a>
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
                <i class="fas fa-shopping-cart" style="font-size: 25px; color: red;"></i></a>
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
                    <div class="col-3">
                        <a>Fantasy</a>
                    </div>
                    <div class="col-3">
                        Thriller
                    </div>
                    <div class="col-3">
                        Romantic
                    </div>
                    <div class="col-3">
                        Drama
                    </div>
                </div>
            </div>
            <div class="col-3 to-hide">
                <div class="d-flex justify-content-center h-100">
                    <div class="searchbar">
                        <input class="search_input" type="text" name="" placeholder="Search...">
                        <a href="#" class="search_icon mr-3"><i class="fas fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-2 to-hide">
                <a style="width: max-content;" href="{{ route('cart.show') }}"><i class="fas fa-shopping-cart mt-2" style="font-size: 25px; color: #E12323;"></i></a>
                @auth('customer')
                <a  style="width: max-content;" href="{{ route('account.dashboard') }}"><i class="far fa-user mt-2 ml-3" style="font-size: 25px; color: #E12323;"></i></a>
                @else
                <a  style="width: max-content;" href="{{ route('login') }}"><i class="far fa-user mt-2 ml-3" style="font-size: 25px; color: #E12323;"></i></a>
                @endauth
            </div>
        </div>
    </div>

</div>