$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#productimages-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:  '/admin/get-list-productimage',
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'product', name: 'product' },
            {	
            	data: 'link',
            	name: 'link' ,
            	"render": function (data, type, full, meta) {
			        return "<img src=\"../storage/images/" + data + "\" width=\"50px\" height=\"50px\"/>";
			    },
			    "title": "link",
			    "orderable": true,
			    "searchable": true
         	},
            { data: 'action', name: 'action' }
        ]
    });
});

$(document).ready(function () {
	$(document).on('click', '.btn-show', function() {
	//hiện modal show lên
		$('#modal-show').modal('show');
		var url=$(this).attr('data-url');
		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				$('#product_id').text("Product: "+response.product_name);
				$('#link').html("<img src='../storage/images/"+response.data.link+"' name='link' alt='"+response.data.link+"' style='max-width: 100%'>");
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
		formdata = new FormData($(this)[0]);
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: formdata,
			contentType: false,
			processData: false,
			success: function (response) {
				toastr.success('Add new category success!');
				$('#modal-add').modal('hide')

				$('#productimages-table').DataTable().ajax.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.link[0]+ '</p>').insertAfter('#link_add')
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		var mytable = $('#productimages-table').DataTable();
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					toastr.success('Delete category success!');
					mytable.row($(this).parents('tr')).remove().draw();
					
				},
				error: function (error) {
					
				}
			})
		}
});

	//bắt sự kiện click vào nút edit
		$(document).on('click', '.btn-edit', function() {

		//mở modal edit lên
		$('#modal-edit').modal('show');
		//lấy data-url của nút edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function (response) {
				$('#product_id_edit').val(response.data.product_id)
				$('#link_edit').html(`<img src='../storage/images/` +response.data.link+ `' name='img' alt='` +response.data.link+ `' style='width:50px; height:50px'>`)
				$('#form-edit').attr('data-url',"/admin/productimage/"+response.data.id)
			},
			error: function (error) {
				
			}
		})
	})

	//bắt sự kiện submit form edit
	$('#form-edit').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		formdata = new FormData($("#form-edit")[0]);
		$.ajax({
			//phương thức put
			type: 'post',
			url: url,
			//lấy dữ liệu trong form
			data: formdata,
			contentType: false,
			processData: false,
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product image success!')
				//ẩn modal edit
				$('#modal-edit').modal('hide');
				
				$('#productimages-table').DataTable().ajax.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.link[0]+ '</p>').insertAfter('#link_edit')
			}
		})
	})
})