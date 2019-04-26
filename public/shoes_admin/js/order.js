$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:  '/admin/get-list-order',
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'customer_mobile', name: 'customer_mobile' },
            { data: 'customer_address', name: 'customer_address' },
            { data: 'status', name: 'status' },
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
				var order_id = response.data.id;
				$('.btn-add-orderdetail').attr('data-id',order_id)
			    var orderdetails = response.orderdetails;
				var a = '';
			    for (var i = 0; i < orderdetails.length; i++){
				    var product = response.orderdetails[i].product;
				    var orderdetail_id = response.orderdetails[i].id;
				    var quantity = response.orderdetails[i].quantity;
				    var id = response.orderdetails[i].product_id;
				    a += i + `
							<tr id=`+orderdetail_id+`>
		                        <td>`+product.name+`</td>
		                        <td>`+response.size_name+`</td>
		                        <td>`+response.color_description+`</td>
		                        <td>`+quantity+`</td>
		                        <td>
		                            <button type="button" class="btn btn-warning btn-edit-orderdetail" data-url="/admin/orderdetail/`+orderdetail_id+`" >Edit</button>
		                            <button type="button" class="btn btn-danger btn-delete-orderdetail" data-url="/admin/orderdetail/`+orderdetail_id+`">Delete</button>
		                        </td>
		                    </tr>
						`;
				}
				$('#orderdetail').html(a);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})
	//bắt sự kiện click vào nút add
	$('.btn-add-order').click(function (e) {
		e.preventDefault();
		//hiện modal show
		$('#modal-add-order').modal('show');
	})

	$('#btn_add_orderdetail').click(function(e){
		e.preventDefault();
		$('#modal-add-orderdetail').modal('show');
	})

	$('#form-add-orderdetail').submit(function (e) {
		e.preventDefault();
		//lấy attribute data-url của form lưu vào biến url
		var url=$(this).attr('data-url');
		var order_id = $('.btn-add-orderdetail').attr('data-id');
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				product_id: $('#product_id_add').val(),
				size_id: $('#size_id_add').val(),
				color_id: $('#color_id_add').val(),
				order_id: order_id,
				quantity: $('#quantity_add').val(),
			},
			success: function (response) {
				toastr.success('Add new Order detail success!');
				$('#modal-add-orderdetail').modal('hide')

				$('#orderdetail').append(
					`
						<tr id=`+response.data.id+`>
		                    <td>`+response.product_name+`</td>
		                    <td>`+response.size_name+`</td>
		                    <td>`+response.color_description+`</td>
		                    <td>`+response.data.quantity+`</td>
		                    <td>
		                        <button type="button" class="btn btn-warning btn-edit-orderdetail" data-url="/admin/orderdetail/`+response.data.id+`" >Edit</button>
		                        <button type="button" class="btn btn-danger btn-delete-orderdetail" data-url="/admin/orderdetail/`+response.data.id+`">Delete</button>
		                    </td>
		                </tr>
					`
				);

				$('#quantity_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.quantity[0]+ '</p>').insertAfter('#quantity_add')
			}
		})
	});

	$(document).on('click', '.btn-delete-orderdetail', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					toastr.success('Delete Order detail success!');

					$('#'+ response.id).remove();
					
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
		var order_id = $('.btn-add-orderdetail').attr('data-id');
		$.ajax({
			type: 'post',
			url: url,
			data: {
				product_id: $('#product_id_edit').val(),
				size_id: $('#size_id_edit').val(),
				color_id: $('#color_id_edit').val(),
				order_id: order_id,
				quantity: $('#quantity_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit order detail success!')
				//ẩn modal edit
				$('#modal-edit-orderdetail').modal('hide');
				
				$('#'+response.data.id).replaceWith(
					`
						<tr id=`+response.data.id+`>
		                    <td>`+response.product_name+`</td>
		                    <td>`+response.size_name+`</td>
		                    <td>`+response.color_description+`</td>
		                    <td>`+response.data.quantity+`</td>
		                    <td>
		                        <button type="button" class="btn btn-warning btn-edit-orderdetail" data-url="/admin/orderdetail/`+response.data.id+`" >Edit</button>
		                        <button type="button" class="btn btn-danger btn-delete-orderdetail" data-url="/admin/orderdetail/`+response.data.id+`">Delete</button>
		                    </td>
		                </tr>
					`
				);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.quantity[0]+ '</p>').insertAfter('#quantity_edit')
			}
		})
	})

	//bắt sự kiện submit form thêm mới
	$('#form-add-order').submit(function (e) {
		e.preventDefault();
		//lấy attribute data-url của form lưu vào biến url
		var url=$(this).attr('data-url');
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				code: $('#code_add').val(),
				customer_name: $('#customer_name_add').val(),
				customer_mobile: $('#customer_mobile_add').val(),
				customer_address: $('#customer_address_add').val(),
				status: $('#status_add').val(),
			},
			success: function (response) {
				toastr.success('Add new order success!');
				$('#modal-add-order').modal('hide')

				$('#orders-table').DataTable().ajax.reload();

				$('#code_add').val('')
				$('#customer_name_add').val('')
				$('#customer_mobile_add').val('')
				$('#customer_address_add').val('')
				$('#status_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.code[0]+ '</p>').insertAfter('#code_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.customer_name[0]+ '</p>').insertAfter('#customer_name_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.customer_mobile[0]+ '</p>').insertAfter('#customer_mobile_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.customer_address[0]+ '</p>').insertAfter('#customer_address_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.status[0]+ '</p>').insertAfter('#status_add')
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete-order', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		var mytable = $('#orders-table').DataTable();
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					toastr.success('Delete order success!');
					mytable.row($(this).parents('tr')).remove().draw();
					
				},
				error: function (error) {
					
				}
			})
		}
	});

	//check order
	$(document).on('click', '.btn-check-order', function(e) {
		var url = $(this).attr('data-url');
		$('#modal-check-order').modal('show');
		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				var order_id = response.order.id;
				var order_code = response.order.code;
				var customer_name = response.order.customer_name;
				var customer_mobile = response.order.customer_mobile;
				var customer_address = response.order.customer_address;
			    var orderdetails = response.order.orderdetails;
				var a = '';
			    for (var i = 0; i < orderdetails.length; i++){
				    var product_name = response.order.orderdetails[i].product.name;
				    var orderdetail_id = response.order.orderdetails[i].id;
				    var quantity = response.order.orderdetails[i].quantity;
				    var color_description = response.order.orderdetails[i].color.description;
				    var size_name = response.order.orderdetails[i].size.name;
				    a += i + `
							<tr id=`+orderdetail_id+`>
		                        <td>`+order_code+`</td>
		                        <td>`+customer_name+`</td>
		                        <td>`+customer_mobile+`</td>
		                        <td>`+customer_address+`</td>
		                        <td>`+product_name+`</td>
		                        <td>`+size_name+`</td>
		                        <td>`+color_description+`</td>
		                        <td>`+quantity+`</td>
		                        <td>
		                            <button type="button" class="btn btn-info btn-apply-checkorder" data-url="/admin/check/`+orderdetail_id+`" > Apply order</button>
		                            <button type="button" class="btn btn-danger btn-cancel-checkorder" data-url="/admin/check/`+orderdetail_id+`"> Cancel order</button>
		                        </td>
		                    </tr>
						`;
				}
				$('#checkorder').html(a);
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	});

	//bắt sự kiện click vào nút edit
		$(document).on('click', '.btn-edit-order', function() {

		//mở modal edit lên
		$('#modal-edit-order').modal('show');
		//lấy data-url của nút edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function (response) {
				$('#code_edit').val(response.data.code)
				$('#customer_name_edit').val(response.data.customer_name)
				$('#customer_mobile_edit').val(response.data.customer_mobile)
				$('#customer_address_edit').val(response.data.customer_address)
				$('#status_edit').val(response.data.status)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit-order').attr('data-url',"/admin/order/"+response.data.id)
			},
			error: function (error) {
				
			}
		})
	})

	//bắt sự kiện submit form edit
	$('#form-edit-order').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức put
			type: 'post',
			url: url,
			//lấy dữ liệu trong form
			data: {
				code: $('#code_edit').val(),
				customer_name: $('#customer_name_edit').val(),
				customer_mobile: $('#customer_mobile_edit').val(),
				customer_address: $('#customer_address_edit').val(),
				status: $('#status_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit category success!')
				//ẩn modal edit
				$('#modal-edit-order').modal('hide');
				
				$('#orders-table').DataTable().ajax.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.code[0]+ '</p>').insertAfter('#code_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.customer_name[0]+ '</p>').insertAfter('#customer_name_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.customer_mobile[0]+ '</p>').insertAfter('#customer_mobile_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.customer_address[0]+ '</p>').insertAfter('#customer_address_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.status[0]+ '</p>').insertAfter('#status_edit')
			}
		})
	})
})