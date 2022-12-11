<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Spanis</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            @if(!Auth::check())
                            <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>  
                            @else
                            <div class="header__top__right__language">
                               
                                <div>{{ Auth::user()->name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">My order</a></li>
                                    <form action="{{ route('logout') }}" method="post" id="formLogout">
                                        @csrf
                                        <li><a href="#" onclick="document.getElementById('formLogout').submit();">Logout</a></li>
                                    </form>
                                    
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->route()->getName()=='home'?'active':'' }}"><a href="{{ route('home') }}">Home</a></li>
                        <li class="{{ request()->route()->getName()=='shop'?'active':'' }}"><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="#">Shop Details</a></li>
                                <li class="{{ request()->route()->getName()=='shopping.cart'?'active':'' }}"><a href="{{ route('shopping.cart') }}">Shoping Cart</a></li>
                                <li><a href="{{ route('checkout.cart') }}">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    @php
                    $cart=session()->get('cart')??[];
                    $total=0;
                    foreach ($cart as $item) {
                        $total+=$item['price']*$item['qty'];
                    }
                    @endphp
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="{{ route('shopping.cart') }}"><i class="fa fa-shopping-bag"></i> <span id="amount">{{ is_array(session()->get('cart'))?count(session()->get('cart')):0 }}</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span id="total-price-cart">${{ number_format($total,2) }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>