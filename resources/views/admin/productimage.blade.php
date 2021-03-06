@extends('layouts.index-admin')

@section('section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="productimages-table">
                <thead>
                    <tr class="productimages-row">
                        <th>#</th>
                        <th>Product</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
            {{-- Modal show chi tiết nrand --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show product</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h2>Product Image:</h2>
                    <h4 id="id"></h4>
                    <h4 id="product_id"></h4>
                    <h4 id="link"></h4>
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

			<form action="#" data-url="{{ route('productimages.store') }}" id="form-add" enctype="multipart/form-data" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add productimage</h4>
			</div>
			<div class="modal-body">
					<div class="form-group">
                        <label for="">Product (*)</label>
                        <select name="product_id" class="form-control" id="product_id_add">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{$product->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Link (*)</label>
                        <input type="file" id="link_add" class="form-control" name="link[]" multiple/>
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit" enctype="multipart/form-data" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit category</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Product (*)</label>
                        <select name="product_id" class="form-control" id="product_id_edit">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('products') == $product->id ? 'selected="selected"' : '' }}>
                                    {{$product->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Link (*)</label>
                        <input type="file" id="link_edit" class="form-control" name="link" multiple/>
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
<script type="text/javascript" charset="utf-8" src="/shoes_admin/js/productimage.js"></script>
@endsection