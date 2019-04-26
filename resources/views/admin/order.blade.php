@extends('layouts.index-admin')

@section('section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add-order">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="orders-table">
                <thead>
                    <tr class="order-row">
                        <th>#</th>
                        <th>Code</th>
                        <th>Customer_name</th>
                        <th>Customer_mobile</th>
                        <th>Customer_address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
            {{-- Modal show chi tiết order --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog"  style="width: 50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show product</h4>
                </div>
                <div class="modal-body">
                    <h2 style="text-align: center">Order detail:</h2>
                    <a href="#" id="btn_add_orderdetail" class="btn btn-success btn-add-orderdetail" >Add</a>
                    <table class="table table-hover">
                        <thead>
                            <tr class="orderdetail-row">
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderdetail">
                            <!-- Order detail -->                        
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal thêm mới order --}}
<div class="modal fade" id="modal-add-order">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="#" data-url="{{ route('orders.store') }}" id="form-add-order" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add order</h4>
			</div>
			<div class="modal-body">
					<div class="form-group">
                        <label for="">Code (*)</label>
                        <input type="text" name="code" class="form-control" id="code_add" placeholder="code">
                    </div>
                    <div class="form-group">
                        <label for="">Customer_name (*)</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name_add" placeholder="customer_name">
                    </div>
                    <div class="form-group">
                        <label for="">Customer_mobile (*)</label>
                        <input type="text" name="customer_mobile" class="form-control" id="customer_mobile_add" placeholder="customer_mobile">
                    </div>
                    <div class="form-group">
                        <label for="">Customer_address (*)</label>
                        <input type="text" name="customer_address" class="form-control" id="customer_address_add" placeholder="customer_address">
                    </div>
                    <div class="form-group">
                        <label for="">Status (*)</label>
                        <input type="text" name="status" class="form-control" id="status_add" placeholder="status">
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

{{-- Modal sửa order --}}
<div class="modal fade" id="modal-edit-order">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit-order" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit order</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Code (*)</label>
                        <input type="text" name="code" class="form-control" id="code_edit" placeholder="code">
                    </div>
                    <div class="form-group">
                        <label for="">Customer_name (*)</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name_edit" placeholder="customer_name">
                    </div>
                    <div class="form-group">
                        <label for="">Customer_mobile (*)</label>
                        <input type="text" name="customer_mobile" class="form-control" id="customer_mobile_edit" placeholder="customer_mobile">
                    </div>
                    <div class="form-group">
                        <label for="">Customer_address (*)</label>
                        <input type="text" name="customer_address" class="form-control" id="customer_address_edit" placeholder="customer_address">
                    </div>
                    <div class="form-group">
                        <label for="">Status (*)</label>
                        <input type="text" name="status" class="form-control" id="status_edit" placeholder="status">
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

{{-- Thêm mới order detail --}}
<div class="modal fade" id="modal-add-orderdetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" data-url="{{ route('orderdetails.store') }}" id="form-add-orderdetail" method="POST" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add order detail</h4>
            </div>
            <div class="modal-body">

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

{{-- Modal chốt, hủy order --}}
<div class="modal fade" id="modal-check-order">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">

            <form action="#" id="form-check-order" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Check order</h4>
            </div>
            <div class="modal-body">
                
                        <h2 style="text-align: center">Check order:</h2>
                        <table class="table table-hover">
                            <thead>
                                <tr class="checkorder-row">
                                    <th>Code</th>
                                    <th>Customer_name</th>
                                    <th>Customer_mobile</th>
                                    <th>Customer_address</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="checkorder">
                                <!-- Order detail -->                        
                            </tbody>
                        </table>
                
                    
                
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
            </form>
        </div>
    </div>
{{-- Modal sửa order detail --}}
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
                                <option value="{{ $size->id }}" {{ old('sizes') == $size->id ? 'selected="selected"' : '' }}> {{ $size->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Color (*)</label>
                        <select name="color_id" class="form-control" id="color_id_edit">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" {{ old('colors') == $color->id ? 'selected="selected"' : '' }}> {{ $color->description }} </option>
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
<script type="text/javascript" charset="utf-8" src="/shoes_admin/js/order.js"></script>
@endsection