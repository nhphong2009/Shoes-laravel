$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#orderdetails-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:  '/admin/get-list-orderdetail',
        order: [[0, 'desc']],
        destroy:true,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'order', name: 'order' },
            { data: 'product', name: 'product' },
            { data: 'quantity', name: 'quantity' },
            { data: 'size', name: 'size' },
            { data: 'color', name: 'color' },
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
				$('#order_id').text("Color: "+response.order_code);
				$('#size_id').text("Color: "+response.size_name);
				$('#color_id').text("Color: "+response.color_description);
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
				order_id: $('#order_id_add').val(),
				quantity: $('#quantity_add').val(),
				size_id: $('#size_id_add').val(),
				color_id: $('#color_id_add').val(),
			},
			success: function (response) {
				toastr.success('Add new Order success!');
				$('#modal-add').modal('hide')

				$('#orderdetails-table').DataTable().ajax.reload();

				$('#quantity_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.quantity[0]+ '</p>').insertAfter('#quantity_add')
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete-orderdetail', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		var mytable = $('#orderdetails-table').DataTable();
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					toastr.success('Delete Order detail success!');
					mytable.row($(this).parents('tr')).remove().draw();
					
				},
				error: function (error) {
					
				}
			})
		}
});

	//bắt sự kiện click vào nút edit
	$(document).on('click', '.btn-edit-orderdetail', function() {

		//mở modal edit lên
		$('#modal-edit-orderdetail').modal('show');
		//lấy data-url của nút edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function (response) {
				$('#product_id_edit').val(response.data.product_id)
				$('#order_id_edit').val(response.data.order_id)
				$('#size_id_edit').val(response.data.size_id)
				$('#color_id_edit').val(response.data.color_id)
				$('#quantity_edit').val(response.data.quantity)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit-orderdetail').attr('data-url',"/admin/orderdetail/"+response.data.id)
			},
			error: function (error) {
				
			}
		})
	})

	//bắt sự kiện submit form edit
	$('#form-edit-orderdetail').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		$.ajax({
			type: 'post',
			url: url,
			data: {
				product_id: $('#product_id_edit').val(),
				order_id: $('#order_id_edit').val(),
				quantity: $('#quantity_edit').val(),
				size_id: $('#size_id_edit').val(),
				color_id: $('#color_id_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit order detail success!')
				//ẩn modal edit
				$('#modal-edit-orderdetail').modal('hide');
				
				$('#orderdetails-table').DataTable().ajax.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.quantity[0]+ '</p>').insertAfter('#quantity_edit')
			}
		})
	})
})