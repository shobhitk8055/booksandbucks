

<!--? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/logo.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->

<header>
    <!-- Header Start -->
    <div class="header-area  ">
        <div class="main-header header-sticky " style="background-color: black;">
            <div class="container-fluid  ">


                <div class="menu-wrapper   ">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="assets/img/logo/logo.png" alt=""></a>
                    </div>



                    <!-- Main-menu -->
                    <div class="main-menu d-none d-lg-block  ">
                        <nav class="nav1">
                            <ul id="navigation">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li class="hot"><a href="#">Categories</a>
                                    <ul class="submenu ">
                                        <li><a href="shop.html">Category 1</a></li>
                                        <li><a href="product_details.html">Category 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('contact') }}">Contact Us </a></li>
                                </li>


                                @auth('customer')
                                    <li> <a href="{{ route('account.dashboard') }}"><span class="flaticon-user"style="color: red;"></span></a></li>


                                    @else
                                    <li><a href="{{ route('login') }}">Login </a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endauth



                                <li><a href="{{ route('cart.show') }}"><span class="flaticon-shopping-cart"style="color: red;"></span></a> </li>


                            </ul>



                        </nav>




                    </div>
                    <!-- Header Right -->


                </div>
                <!-- Mobile Menu -->
                <div class="col-12 " >
                    <div class="mobile_menu d-block d-lg-none " ></div>
                </div>

            </div>



            <div class="input-group md-form form-sm form-1 pl-0" style="padding-bottom: 10px; padding-top: 10px;">
                <div class="input-group-prepend">
                      <span class="input-group-text pink lighten-3" style="background-color: red;" id="basic-text1"><i class="fas fa-search text-white"
                                                                                                                       aria-hidden="true"></i></span>
                </div>
                <input class="form-control my-0 py-1" type="text" placeholder="Search..." aria-label="Search">
            </div>


        </div>
    </div>


    <!-- Header End -->
</header>

<div class="icon-bar">
    <a href='#' class='facebook' target='_blank'>
        click here to visit <i class=" fab fa-facebook-square"></i>
    </a>
    <a href='#' class='twitter' target='_blank'>
        click here to visit<i class=" fab fa-twitter-square"></i>
    </a>

    <a href='#' class='instagram' target='_blank'>
        click here to visit<i class="fab fa-instagram"></i>
    </a>
    <a href='' class='linkedin' target='_blank'>
        click here to visit<i class=" fab fa-linkedin"></i>
    </a>
    <a href='#' class='whatsapp' target='_blank'>
        click here to visit<i class=" fab fa-whatsapp"></i></a>
</div>