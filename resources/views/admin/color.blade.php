@extends('layouts.index-admin')

@section('section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="colors-table">
                <thead>
                    <tr class="brand-row">
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
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
                    <h2>Color:</h2>
                    <h4 id="id"></h4>
                    <h4 id="name"></h4>
                    <h4 id="description"></h4>
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

			<form action="#" data-url="{{ route('colors.store') }}" id="form-add" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add color</h4>
			</div>
			<div class="modal-body">

					<div class="form-group">
						<label for="">Name (*)</label>
						<input type="text" name="name" class="form-control" id="name_add" placeholder="name">
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

{{-- Modal sửa brand --}}
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit color</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Name (*)</label>
                        <input type="text" class="form-control" id="name_edit" name="name" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="">Description (*)</label>
                        <input type="text" class="form-control" id="description_edit" name="description" placeholder="description">
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
<script type="text/javascript" charset="utf-8" src="/shoes_admin/js/color.js"></script>
@endsection