@extends('layouts.index')
@section('header_slide')
  <div class="header_slide">
            <div class="header_bottom_left">                
                <div class="categories">
                  <ul>
                    <h3>Brands</h3>
                        @foreach($brands as $bra)
                            <li>
                                <a href="/brand/{{ $bra->slug }}"> {{ $bra->name }} </a>
                            </li>
                        @endforeach
                  </ul>
                </div>                  
             </div>
                     <div class="header_bottom_right">                   
                         <div class="slider">                        
                             <div id="slider">
                                <div id="mover">
                                    <div id="slide-1" class="slide">                                
                                     <div class="slider-img">
                                         <a href="preview.html"><img src="{{ asset('shoes_home/images/slide-1-image.png') }}" alt="learn more" /></a>                                     
                                      </div>
                                        <div class="slider-text">
                                         <h1>Clearance<br><span>SALE</span></h1>
                                         <h2>UPTo 20% OFF</h2>
                                       <div class="features_list">
                                        <h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>                                        
                                        </div>
                                         <a href="preview.html" class="button">Shop Now</a>
                                       </div>                          
                                      <div class="clear"></div>             
                                  </div>    
                                        <div class="slide">
                                            <div class="slider-text">
                                         <h1>Clearance<br><span>SALE</span></h1>
                                         <h2>UPTo 40% OFF</h2>
                                       <div class="features_list">
                                        <h4>Get to Know More About Our Memorable Services</h4>                                         
                                        </div>
                                         <a href="preview.html" class="button">Shop Now</a>
                                       </div>       
                                         <div class="slider-img">
                                         <a href="preview.html"><img src="{{ asset('shoes_home/images/slide-3-image.jpg') }}" alt="learn more" /></a>
                                      </div>                                                                         
                                      <div class="clear"></div>             
                                  </div>
                                  <div class="slide">                                       
                                      <div class="slider-img">
                                         <a href="preview.html"><img src="{{ asset('shoes_home/images/slide-2-image.jpg') }}" alt="learn more" /></a>
                                      </div>
                                      <div class="slider-text">
                                         <h1>Clearance<br><span>SALE</span></h1>
                                         <h2>UPTo 10% OFF</h2>
                                       <div class="features_list">
                                        <h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>                                        
                                        </div>
                                         <a href="preview.html" class="button">Shop Now</a>
                                       </div>   
                                      <div class="clear"></div>             
                                  </div>                                                
                             </div>     
                        </div>
                     <div class="clear"></div>                         
                 </div>
              </div>
           <div class="clear"></div>
        </div>
@endsection
@section('content')
<div class="content">
        <div class="content_top">
            <div class="heading">
            <h3>New Products</h3>
            </div>
            <div class="see">
                <p><a href="/product">See all Products</a></p>
            </div>
            <div class="clear"></div>
        </div>
          <div class="section group">
                @foreach($new_products as $product)
                    <div class="grid_1_of_4 images_1_of_4" style="height:400px">
                        <a href="/product/{{ $product->slug }}"><img src="/storage/images/{{ $product->thumbnail }}" alt="" style="height: 68%"/></a>
                        <h2> {{ $product->name }} </h2>
                        <div class="price-details">
                            <div class="price-number">
                                <p><span class="rupees"> {{ number_format($product->price) }} VNĐ </span></p>
                            </div>
                            <div class="add-cart">                              
                                <h4>
                                    <a href="/product/{{ $product->slug }}">Add to Cart</a>
                                </h4>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="content_bottom">
            <div class="heading">
            <h3>Latest Products</h3>
            </div>
            <div class="see">
                <p><a href="/product">See all Products</a></p>
            </div>
            <div class="clear"></div>
        </div>
            <div class="section group">
                @foreach($old_products as $product)
                    <div class="grid_1_of_4 images_1_of_4" style="height:400px">
                        <a href="/product/{{ $product->slug }}"><img src="/storage/images/{{ $product->thumbnail }}" alt="" style="height: 68%"/></a>
                        <h2> {{ $product->name }} </h2>
                        <div class="price-details">
                            <div class="price-number">
                                <p><span class="rupees"> {{ number_format($product->price) }} VNĐ </span></p>
                            </div>
                            <div class="add-cart">                              
                                <h4>
                                    <a href="/product/{{ $product->slug }}">Add to Cart</a>
                                </h4>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection