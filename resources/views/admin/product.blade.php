@extends('layouts.index-admin')

@section('section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add" id="add_product">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="products-table">
                <thead>
                    <tr class="product-row">
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale_price</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
            {{-- Modal show chi tiết product --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show product</h4>
                </div>
                <div class="modal-body">
                    <h2 style="text-align: center">Product detail:</h2>
                    <a href="#" id="btn_add_productdetail" class="btn btn-success btn-add-productdetail" >Add</a>
                    <table class="table table-hover">
                        <thead>
                            <tr class="productdetail-row">
                                <th>Color</th>
                                <th>Size</th>
                                <th>Style</th>
                                <th>Material</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productdetail">
                            <!-- Product detail -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- Modal thêm mới product --}}
<div class="modal fade" id="modal-add-product">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="#" data-url="{{ route('products.store') }}" id="form-add-product" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add product</h4>
			</div>
			<div class="modal-body">

                    <div class="form-group">
                        <label for="">Code (*)</label>
                        <input type="text" name="code" class="form-control" id="code_add" placeholder="code">
                    </div>
                    <div class="form-group">
                        <label for="">Name (*)</label>
                        <input type="text" name="name" class="form-control" id="name_add" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="">Slug (*)</label>
                        <input type="text" name="slug" class="form-control" id="slug_add" placeholder="slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Price (*)</label>
                        <input type="text" name="price" class="form-control" id="price_add" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="">Sale_price </label>
                        <input type="text" name="sale_price" class="form-control" id="sale_price_add" placeholder="sale_price">
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail </label>
                        <input type="file" name="thumbnail" class="form-control" id="thumbnail_add" placeholder="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="">Category_id </label>
                        <select name="category_id" class="form-control" id="category_id_add">
                            @foreach($categories as $cate)
                                <option value="{{ $cate->id }}"> {{ $cate->name }} </option>
                            @endforeach
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="">Brand_id </label>
                        <select name="brand_id" class="form-control" id="brand_id_add">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Content (*)</label>
                        <textarea name="content" class="form-control" id="content_add"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Description (*)</label>
                        <input type="text" name="description" class="form-control" id="description_add" placeholder="description">
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

{{-- Modal sửa product --}}
<div class="modal fade" id="modal-edit-product">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit-product" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit product</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Code (*)</label>
                        <input type="text" name="code" class="form-control" id="code_edit" placeholder="code">
                    </div>
                    <div class="form-group">
                        <label for="">Name (*)</label>
                        <input type="text" name="name" class="form-control" id="name_edit" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="">Slug (*)</label>
                        <input type="text" name="slug" class="form-control" id="slug_edit" placeholder="slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Price (*)</label>
                        <input type="text" name="price" class="form-control" id="price_edit" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="">Sale_price </label>
                        <input type="text" name="sale_price" class="form-control" id="sale_price_edit" placeholder="sale_price">
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail </label>
                        <input type="file" name="thumbnail" class="form-control" id="thumbnail_edit" placeholder="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="">Category_id </label>
                        <select name="category_id" class="form-control" id="category_id_edit">
                            @foreach($categories as $cate)
                                <option value="{{$cate->id}}" {{ old('categories') == $cate->id ? 'selected="selected"' : '' }}>{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="">Brand_id </label>
                        <select name="brand_id" class="form-control" id="brand_id_edit">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{ old('brands') == $brand->id ? 'selected="selected"' : '' }}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Content (*)</label>
                        <textarea name="content" class="form-control" id="content_edit"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Description (*)</label>
                        <input type="text" name="description" class="form-control" id="description_edit" placeholder="description">
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

<!-- add productdetail -->
<div class="modal fade" id="modal-add-productdetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" data-url="{{ route('productdetails.store') }}" id="form-add-productdetail" method="POST" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add product detail</h4>
            </div>
            <div class="modal-body">

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
                <input type="hidden" name="product_id" id="product_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal sửa productdetail --}}
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
<script type="text/javascript" charset="utf-8" src="/shoes_admin/js/product.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script type="text/javascript">
$(function() {
    tinymce.init({
        selector:'textarea',
        width: '100%',
        height: '150',
        forced_root_block : "",
    });
})
</script>
@endsection