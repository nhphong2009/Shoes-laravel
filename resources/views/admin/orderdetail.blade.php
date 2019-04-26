@extends('layouts.index-admin')

@section('section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="orderdetails-table">
                <thead>
                    <tr class="orderdetails-row">
                        <th>#</th>
                        <th>Order</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
            {{-- Modal show chi tiết nrand --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show product</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h2>Order detail:</h2>
                    <h4 id="id"></h4>
                    <h4 id="product_id"></h4>
                    <h4 id="order_id"></h4>
                    <h4 id="size_id"></h4>
                    <h4 id="color_id"></h4>
                    <h4 id="quantity"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal thêm mới brand --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="#" data-url="{{ route('orderdetails.store') }}" id="form-add" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add order detail</h4>
			</div>
			<div class="modal-body">

                    <div class="form-group">
                        <label for="">Order (*)</label>
                        <select name="order_id" class="form-control" id="order_id_add">
                            @foreach($orders as $ord)
                                <option value="{{ $ord->id }}"> {{ $ord->code }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product (*)</label>
                        <select name="product_id" class="form-control" id="product_id_add">
                            @foreach($products as $pro)
                                <option value="{{ $pro->id }}"> {{ $pro->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Size (*)</label>
                        <select name="size_id" class="form-control" id="size_id_add">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}"> {{ $size->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Color (*)</label>
                        <select name="color_id" class="form-control" id="color_id_add">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}"> {{ $color->description }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Quantity (*)</label>
                        <input type="text" name="quantity" class="form-control" id="quantity_add" placeholder="quantity">
                    </div>
				
					
				
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
			</div>
			</form>
		</div>
	</div>
</div>

{{-- Modal sửa brand --}}
<div class="modal fade" id="modal-edit-orderdetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit-orderdetail" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit order details</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Order (*)</label>
                        <select name="order_id" class="form-control" id="order_id_edit">
                            @foreach($orders as $ord)
                                <option value="{{ $ord->id }}" {{ old('orders') == $ord->id ? 'selected="selected"' : '' }}> {{ $ord->code }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product (*)</label>
                        <select name="product_id" class="form-control" id="product_id_edit">
                            @foreach($products as $pro)
                                <option value="{{$pro->id}}" {{ old('products') == $pro->id ? 'selected="selected"' : '' }}>{{$pro->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Size (*)</label>
                        <select name="size_id" class="form-control" id="size_id_edit">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }} {{ old('sizes') == $size->id ? 'selected="selected"' : '' }}"> {{ $size->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Color (*)</label>
                        <select name="color_id" class="form-control" id="color_id_edit">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }} {{ old('colors') == $color->id ? 'selected="selected"' : '' }}"> {{ $color->description }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Quantity (*)</label>
                        <input type="text" name="quantity" class="form-control" id="quantity_edit" placeholder="quantity">
                    </div>
                
                    
                
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                
            </div>
            </form>
        </div>
    </div>
</div>
        </div>
    </div>
@endsection

@section('footer')
<script type="text/javascript" charset="utf-8" src="/shoes_admin/js/orderdetail.js"></script>
@endsection