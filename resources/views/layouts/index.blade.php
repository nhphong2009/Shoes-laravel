<!DOCTYPE HTML5>
<head>
<title>Free Home Shoppe Website Template | Home :: w3layouts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="{{ asset('shoes_home/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ asset('shoes_home/css/slider.css') }}" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="{{ asset('shoes_home/js/jquery-1.7.2.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('shoes_home/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('shoes_home/js/easing.js') }}"></script>
<script type="text/javascript" src="{{ asset('shoes_home/js/startstop-slider.js') }}"></script>
<script src="{{ asset('shoes_home/js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
<link href="{{ asset('shoes_home/css/easy-responsive-tabs.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="{{ asset('shoes_home/css/global.css') }}">
<script type="text/javascript" src="{{ asset('shoes_home/js/cart.js') }}"></script>
<script src="{{ asset('shoes_home/js/slides.min.jquery.js') }}"></script>
@yield('link')
<script>
    $(function(){
      $('#products').slides({
        preload: true,
        preloadImage: '/shoes_home/images/giphy.gif',
        effect: 'slide, fade',
        crossfade: true,
        slideSpeed: 350,
        fadeSpeed: 500,
        generateNextPrev: true,
        generatePagination: false
      });
    });
  </script>
</head>
<body>
  <div class="wrap">
   <div class="header">
        <div class="headertop_desc">
            <div class="call">
                 <p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
            </div>
            <div class="account_desc">
                <ul>
                    @guest
                        <li><a href="/login">Login</a></li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="#"> {{ Auth::user()->name }} </a>
                        </li>
                        <li class="user-footer">
                            <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </li>
                        <li><a href="/checkout">Checkout</a></li>
                    @endguest
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_top">
            <div class="logo">
                <a href="{{ route('index') }}"><img src="{{ asset('shoes_home/images/logo.png') }}" alt="" /></a>
            </div>
              <div class="cart">
                   <p>Welcome to our Online Store! <span>Cart:</span><div id="dd" class="wrapper-dropdown-2"> <span id="cart_count">{{ Cart::count() }}</span> item(s) - <span id="cart_subtotal" class="cart_price_subtotal">{{ Cart::subtotal(0) }}</span> VNĐ
                    <ul class="dropdown">
                        <table id="show_add_cart">
                            <tr>
                                <td class="show_cart">Ảnh sản phẩm</td>
                                <td class="show_cart">Tên sản phẩm</td>
                                <td class="show_cart">Giá</td>
                                <td class="show_cart">Số lượng</td>
                                <td class="show_cart">Tổng tiền</td>
                                <td class="show_cart">Tùy chọn</td>
                            </tr>
                                <tbody class="show_items">
                                    <tr id="show_nonecart">
                                        <td colspan="6"> Bạn chưa add cart nào</td>
                                    </tr>
                                    @foreach(Cart::content() as $cart)
                                        <tr id="{{ $cart->rowId }}">
                                            <td>
                                                <img src="/storage/images/{{ $cart->options->image }}">
                                            </td>
                                            <td>{{ $cart->name }}</td>
                                            <td>{{ number_format($cart->price) }} VNĐ</td>
                                            <td>
                                                <span id="cart_qty_{{ $cart->rowId }}">{{ $cart->qty }}</span>
                                            </td>
                                            <td>
                                                <span id="cart_qty_subtotal_{{ $cart->rowId }}">{{ number_format($cart->subtotal) }}</span> VNĐ
                                            </td>
                                            <td>
                                                <button class="remove_rowId" data-url="/removecart/{{ $cart->rowId }}" type="button"> Xóa </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tr id="button_checkout">
                                    <td colspan="4"></td>
                                    <td colspan="2" align="center">
                                        <a href="/checkout" title="">Check out</a>
                                    </td>
                                </tr>
                            </table>
                    </ul></div></p>
              </div>
     <div class="clear"></div>
  </div>
    <div class="header_bottom">
            <div class="menu">
                <ul>
                    @foreach($categories as $cate)
                        @if($cate->parent_id == 0)
                            @if($cate->id == 1)
                                <li class="active">
                                    <a href="/category/{{ $cate->slug }}"> {{ $cate->name }} </a>
                                </li>
                            @else
                                <li>
                                    <a href="/category/{{ $cate->slug }}"> {{ $cate->name }} </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="search_box">
                <form method="POST" action="/search">
                    @csrf
                    <input type="text" value="Search" name="search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
                </form>
            </div>
            <div class="clear"></div>
         </div>
    @yield('header_slide')
    
  </div>
 <div class="main">
    @yield('content')
 </div>
</div>
   <div class="footer">
      <div class="wrap">    
         <div class="section group">
                <div class="col_1_of_4 span_1_of_4">
                        <h4>Information</h4>
                        <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Customer Service</a></li>
                        <li><a href="#">Advanced Search</a></li>
                        <li><a href="delivery.html">Orders and Returns</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Why buy from us</h4>
                        <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Customer Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="contact.html">Site Map</a></li>
                        <li><a href="#">Search Terms</a></li>
                        </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>My account</h4>
                        <ul>
                            <li><a href="contact.html">Sign In</a></li>
                            <li><a href="index.html">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="contact.html">Help</a></li>
                        </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Contact</h4>
                        <ul>
                            <li><span>+91-123-456789</span></li>
                            <li><span>+00-123-000000</span></li>
                        </ul>
                        <div class="social-icons">
                            <h4>Follow Us</h4>
                              <ul>
                                  <li><a href="#" target="_blank"><img src="{{ asset('shoes_home/images/facebook.png') }}" alt="" /></a></li>
                                  <li><a href="#" target="_blank"><img src="{{ asset('shoes_home/images/twitter.png') }}" alt="" /></a></li>
                                  <li><a href="#" target="_blank"><img src="{{ asset('shoes_home/images/skype.png') }}" alt="" /> </a></li>
                                  <li><a href="#" target="_blank"> <img src="{{ asset('shoes_home/images/dribbble.png') }}" alt="" /></a></li>
                                  <li><a href="#" target="_blank"> <img src="{{ asset('shoes_home/images/linkedin.png') }}" alt="" /></a></li>
                                  <div class="clear"></div>
                             </ul>
                        </div>
                </div>
            </div>          
        </div>
        <div class="copy_right">
                <p>&copy; 2013 home_shoppe. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
           </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {          
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

