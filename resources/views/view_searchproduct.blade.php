@extends('layouts.index')
@section('content')
	<div class="section group">
		@foreach($products as $product)
			<div class="grid_1_of_4 images_1_of_4" style="height:400px; margin: 0; box-shadow: none; -webkit-box-shadow: none">
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
@endsection