@extends('layouts.index-admin')

@section('section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="product_details-table">
                <thead>
                    <tr class="product_details-row">
                        <th>#</th>
                        <th>Product</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Style</th>
                        <th>Material</th>
                        <th>Quantity</th>
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
                    <h2>Product detail:</h2>
                    <h4 id="id"></h4>
                    <h4 id="product_id"></h4>
                    <h4 id="color_id"></h4>
                    <h4 id="size_id"></h4>
                    <h4 id="style_id"></h4>
                    <h4 id="material_id"></h4>
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

			<form action="#" data-url="{{ route('productdetails.store') }}" id="form-add" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add product detail</h4>
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
                        <label for="">Color (*)</label>
                        <select name="color_id" class="form-control" id="color_id_add">
                            @foreach($colors as $col)
                                <option value="{{ $col->id }}"> {{ $col->description }} </option>
                            @endforeach
                        </select>
                    </div><div class="form-group">
                        <label for="">Size (*)</label>
                        <select name="size_id" class="form-control" id="size_id_add">
                            @foreach($sizes as $siz)
                                <option value="{{ $siz->id }}"> {{ $siz->name }} </option>
                            @endforeach
                        </select>
                    </div><div class="form-group">
                        <label for="">Style (*)</label>
                        <select name="style_id" class="form-control" id="style_id_add">
                            @foreach($styles as $styl)
                                <option value="{{ $styl->id }}"> {{ $styl->name }} </option>
                            @endforeach
                        </select>
                    </div><div class="form-group">
                        <label for="">Material (*)</label>
                        <select name="material_id" class="form-control" id="material_id_add">
                            @foreach($materials as $mater)
                                <option value="{{ $mater->id }}"> {{ $mater->name }} </option>
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
<div class="modal fade" id="modal-edit-productdetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit-productdetail" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit product details</h4>
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
                        <label for="">Color (*)</label>
                        <select name="color_id" class="form-control" id="color_id_edit">
                            @foreach($colors as $col)
                                <option value="{{ $col->id }}" {{ old('colors') == $col->id ? 'selected="selected"' : '' }}> {{ $col->description }} </option>
                            @endforeach
                        </select>
                    </div><div class="form-group">
                        <label for="">Size (*)</label>
                        <select name="size_id" class="form-control" id="size_id_edit">
                            @foreach($sizes as $siz)
                                <option value="{{ $siz->id }}" {{ old('sizes') == $siz->id ? 'selected="selected"' : '' }}> {{ $siz->name }} </option>
                            @endforeach
                        </select>
                    </div><div class="form-group">
                        <label for="">Style (*)</label>
                        <select name="style_id" class="form-control" id="style_id_edit">
                            @foreach($styles as $styl)
                                <option value="{{ $styl->id }}" {{ old('styles') == $styl->id ? 'selected="selected"' : '' }}> {{ $styl->name }} </option>
                            @endforeach
                        </select>
                    </div><div class="form-group">
                        <label for="">Material (*)</label>
                        <select name="material_id" class="form-control" id="material_id_edit">
                            @foreach($materials as $mater)
                                <option value="{{ $mater->id }}" {{ old('materials') == $mater->id ? 'selected="selected"' : '' }}> {{ $mater->name }} </option>
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
<script type="text/javascript" charset="utf-8" src="/shoes_admin/js/productdetail.js"></script>
@endsection