@extends('layouts.index')
@section('content')
	<div class="show_complete_checkout"></div>
	<table width="75%;"	 style="margin: 100px auto;" class="show_all_checkout">
		<thead>
			<tr>
				<td width="10%">Image</td>
				<td width="30%">Name</td>
				<td width="5%">Quantity</td>
				<td width="5%">Price</td>
				<td width="5%">Size</td>
				<td width="5%">Color</td>
				<td width="5%">Total</td>
				<td width="10%">Option</td>
			</tr>
		</thead>
		<tbody>
			@foreach ($datas as $data)
				<tr id="checkout-{{ $data->rowId }}">
					<td>
						<img src="/storage/images/{{$data->options->image}}">
					</td>
					<td class="checkout_show">
						{{ $data->name }}
					</td>
					<td class="checkout_show">
						<button type="button" class="changeQuantity" status="-1" data-id='{{ $data->rowId }}'>-</button>
						<span id="qty-{{ $data->rowId }}">{{ $data->qty }}</span>
						<button type="button" class="changeQuantity" status="1" data-id='{{ $data->rowId }}'>+</button>
					</td>
					<td class="checkout_show">
						<span id="price-{{$data->rowId}}">{{ number_format($data->price) }}</span>
					</td>
					<td class="checkout_show">
						{{ $data->options->size }}
					</td>
					<td class="checkout_show">
						{{ $data->options->color }}
					</td>
					<td class="checkout_show">
						 <span id="subtotal-{{$data->rowId}}">{{ $data->options->subtotal }}</span>
					</td>
					<td class="checkout_show">
						<a href="/removecart/{{ $data->rowId }}" title="">Xóa</a>
					</td>
				</tr>
			@endforeach
		</tbody>
		<tbody>
			<tr>
				<td colspan="7" class="checkout_show" style="text-align: right;">Total: </td>
				<td> {{ Cart::subtotal(0) }} VNĐ</td>
			</tr>
		</tbody>
	</table>
	<form method="POST" action="#" id="add_order" data-url='/checkout'>
		@csrf
		<div class="checkout">                              
	        <button type="submit" class="checkout_order">Check out</button>
	    </div>
	</form>
@endsection
@section('link')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
@endsection