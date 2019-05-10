@extends('layouts.index')
@section('content')
	<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
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
						 <span id="subtotal-{{$data->rowId}}">{{ number_format($data->qty * $data->price) }}</span> VNĐ
					</td>
					<td class="checkout_show">
						<a class="remove_cart_rowId" href="#" data-url="/removecart/{{ $data->rowId }}" title="">Xóa</a>
					</td>
				</tr>
			@endforeach
		</tbody>
		<tbody>
			<tr>
				<td colspan="7" class="checkout_show" style="text-align: right;">Total: </td>
				<td>
					<span class="cart_subtotal">{{ Cart::subtotal(0) }}</span> VNĐ
				</td>
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>
@endsection