@extends('layouts.index')
@section('content')
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
				  <div class="product-details">				
					<div class="grid images_3_of_2">
						<div id="container">
						   <div id="products_example">
							   <div id="products">
								<div class="slides_container">
									@foreach($getProductimages as $productimage)
										<a href="#" target="_blank"><img src="/storage/images/{{ $productimage->link }}" alt=" " /></a>
									@endforeach
								</div>
								<ul class="pagination">
									@foreach($getProductimages as $productimage)
										<li><a href="#" target="_blank"><img style="height: 40px" src="/storage/images/{{ $productimage->link }}" alt=" " /></a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="desc span_3_of_2">
					<h2>{{ $getProduct->name }}</h2>
					<p>{{ $getProduct->description }}</p>					
					<div class="price">
						<p>Price: <span>{{ number_format($getProduct->price) }} VNĐ</span></p>
					</div>
					<div class="available">
						<p>Available Options :</p>

					<form method="POST" action="#" id="add_cart" data-url="{{ route('index.addcart') }}">
						 <input type="hidden" id="product_id" name="id" value="{{ $getProduct->id }}">
						 @csrf
						<ul>
							<li>
								<span>Color: </span>
								<select id="color" name="color">
									<option value="0">-- Chọn màu --</option>
									@foreach($colors as $color)
										<option value="{{ $color->id }}">{{ $color->description }}</option>
									@endforeach
								</select>
							</li>
							<li>
								<span>Size: </span>
								<select id="size" name="size">
									<option value="0">-- Chọn size -- </option>
								</select>
							</li>
						</ul>
						</div>
						<div>
							Quantity
							<input id="quantity" type="number" name="quantity" value="1" min="0">
						</div>
						<div id="showQuantity"></div>
						@if(Auth::check())
							<button type="submit" class="button">Add to Cart</button>
						@else
							<a href="{{ route('login') }}" id="show_form_login" class="button">Add to Cart</a>
						@endif
					</form>				
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		<div class="product_desc">	
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Product Details</li>
					<li>Product Reviews</li>
					<div class="clear"></div>
				</ul>
				<div class="resp-tabs-container">
					<div class="product-desc">
						{{ $getProduct->content }}
					</div>

				<div class="review">
					<h4>{{ $getProduct->name }} by <a href="#">{{ $getProduct->admin->name }}</a></h4>
					 <ul>
					 	<li>Price :<a href="#"><img src="{{ asset('shoes_home/images/price-rating.png') }}" alt="" /></a></li>
					 	<li>Value :<a href="#"><img src="{{ asset('shoes_home/images/value-rating.png') }}" alt="" /></a></li>
					 	<li>Quality :<a href="#"><img src="{{ asset('shoes_home/images/quality-rating.png') }}" alt="" /></a></li>
					 </ul>
					 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				  <div class="your-review">
				  	 <h3>How Do You Rate This Product?</h3>
				  	  <p>Write Your Own Review?</p>
				  	  <form>
					    	<div>
						    	<span><label>Nickname<span class="red">*</span></label></span>
						    	<span><input type="text" value=""></span>
						    </div>
						    <div><span><label>Summary of Your Review<span class="red">*</span></label></span>
						    	<span><input type="text" value=""></span>
						    </div>						
						    <div>
						    	<span><label>Review<span class="red">*</span></label></span>
						    	<span><textarea> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT REVIEW"></span>
						  </div>
					    </form>
				  	 </div>				
				</div>
			</div>
		 </div>
	 </div>
	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   <div class="content_bottom">
    		<div class="heading">
    		<h3>SAME Products</h3>
    		</div>
    		<div class="see">
    			<p><a href="/product">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>
   <div class="section group">
   			@foreach($getRandoms as $getRandom)
				<div class="grid_1_of_4 images_1_of_4">
					<a href="/product/{{ $getRandom->slug }}"><img src="/storage/images/{{ $getRandom->thumbnail }}" alt=""></a>					
					<div class="price" style="border:none">
						<div class="add-cart" style="float:none">								
							<h4><a href="#">Add to Cart</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
   			@endforeach
			</div>
		</div>
				<div class="rightsidebar span_3_of_1">
					<h2>BRANDS</h2>
					<ul class="side-w3ls">
						@foreach($brands as $brand)
							<li><a href="#">{{ $brand->name }}</a></li>
						@endforeach
    				</ul>
 				</div>
 		</div>
 	</div>
    </div>
 @endsection
