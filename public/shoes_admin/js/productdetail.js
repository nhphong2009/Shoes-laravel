$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#product_details-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:  '/admin/get-list-productdetail',
        order: [[0, 'desc']],
        destroy:true,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'product', name: 'product' },
            { data: 'color', name: 'color' },
            { data: 'size', name: 'size' },
            { data: 'style', name: 'style' },
            { data: 'material', name: 'material' },
            { data: 'quantity', name: 'quantity' },
            { data: 'action', name: 'action' }
        ]
    });
});

$(document).ready(function () {
	$(document).on('click', '.btn-show', function() {
	//hiện modal show lên
		$('#modal-show').modal('show');
		//lấy dữ liệu từ attribute data-url lưu vào biến url
		var url=$(this).attr('data-url');
		$.ajax({
			//sử dụng phương thức get
			type: 'get',
			url: url,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#product_id').text("Product: "+response.product_name);
				$('#id').text("ID: "+response.data.id);
				$('#color_id').text("Color: "+response.color_name);
				$('#size_id').text("Size: "+response.size_name);
				$('#style_id').text("Style: "+response.style_name);
				$('#material_id').text("Material: "+response.material_name);
				$('#quantity').text("Quantity: "+response.data.quantity);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})
	//bắt sự kiện click vào nút add
	$('.btn-add').click(function (e) {
		e.preventDefault();
		//hiện modal show
		$('#modal-add').modal('show');
	})

	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {
		e.preventDefault();
		//lấy attribute data-url của form lưu vào biến url
		var url=$(this).attr('data-url');
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				product_id: $('#product_id_add').val(),
				color_id: $('#color_id_add').val(),
				size_id: $('#size_id_add').val(),
				style_id: $('#style_id_add').val(),
				material_id: $('#material_id_add').val(),
				quantity: $('#quantity_add').val(),
			},
			success: function (response) {
				toastr.success('Add new Product success!');
				$('#modal-add').modal('hide')

				$('#product_details-table').DataTable().ajax.reload();

				$('#quantity_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.quantity[0]+ '</p>').insertAfter('#quantity_add')
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete-productdetail', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		var mytable = $('#product_details-table').DataTable();
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					toastr.success('Delete product success!');
					mytable.row($(this).parents('tr')).remove().draw();
					
				},
				error: function (error) {
					
				}
			})
		}
});

	//bắt sự kiện click vào nút edit
		$(document).on('click', '.btn-edit-productdetail', function() {

		//mở modal edit lên
		$('#modal-edit-productdetail').modal('show');
		//lấy data-url của nút edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function (response) {
				$('#product_id_edit').val(response.data.product_id)
				$('#color_id_edit').val(response.data.color_id)
				$('#size_id_edit').val(response.data.size_id)
				$('#style_id_edit').val(response.data.style_id)
				$('#material_id_edit').val(response.data.material_id)
				$('#quantity_edit').val(response.data.quantity)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit-productdetail').attr('data-url',"/admin/productdetail/"+response.data.id)
			},
			error: function (error) {
				
			}
		})
	})

	//bắt sự kiện submit form edit
	$('#form-edit-productdetail').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		$.ajax({
			type: 'post',
			url: url,
			data: {
				product_id: $('#product_id_edit').val(),
				color_id: $('#color_id_edit').val(),
				size_id: $('#size_id_edit').val(),
				style_id: $('#style_id_edit').val(),
				material_id: $('#material_id_edit').val(),
				quantity: $('#quantity_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product detail success!')
				//ẩn modal edit
				$('#modal-edit-productdetail').modal('hide');
				
				$('#product_details-table').DataTable().ajax.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.quantity[0]+ '</p>').insertAfter('#quantity_edit')
			}
		})
	})
})