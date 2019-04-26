$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:  '/admin/get-list-product',
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            {	
            	data: 'thumbnail',
            	name: 'thumbnail' ,
            	"render": function (data, type, full, meta) {
			        return "<img src=\"../storage/images/" + data + "\" width=\"50px\" height=\"50px\"/>";
			    },
			    "title": "thumbnail",
			    "orderable": true,
			    "searchable": true
         	},
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },
            { data: 'sale_price', name: 'sale_price' },
            { data: 'category', name: 'category' },
            { data: 'brand', name: 'brand' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#price_add').keyup(function(){
		var price = numeral($(this).val()).format('0,0');
    	$(this).val(price)
    })
    $('#sale_price_add').keyup(function(){
		var sale_price = numeral($(this).val()).format('0,0');
    	$(this).val(sale_price)
    })
    $('#price_edit').keyup(function(){
		var price = numeral($(this).val()).format('0,0');
    	$(this).val(price)
    })
    $('#sale_price_edit').keyup(function(){
		var sale_price = numeral($(this).val()).format('0,0');
    	$(this).val(sale_price)
    })
});



$(document).ready(function () {
	$('#name_add').keyup(function(){
		var name, slug;
		name = $(this).val();
		slug = name.toLowerCase();
		slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        $('#slug_add').val(slug);
	})

	$('#name_edit').keyup(function(){
		var name, slug;
		name = $(this).val();
		slug = name.toLowerCase();
		slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        $('#slug_edit').val(slug);
	})

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
				var product_id = response.data.id;
				$('.btn-add-productdetail').attr('data-id',product_id)
			    var productdetails = response.productdetails;
				var a = '';
			    for (var i = 0; i < productdetails.length; i++){
				    var color = response.productdetails[i].color;
				    var size = response.productdetails[i].size;
				    var material = response.productdetails[i].material;
				    var style = response.productdetails[i].style;
				    var productdetail_id = response.productdetails[i].id;
				    var quantity = response.productdetails[i].quantity;
				    var id = response.productdetails[i].product_id;
				    a += i + `
							<tr id=`+productdetail_id+`>
		                        <td>`+color.name+`</td>
		                        <td>`+size.name+`</td>
		                        <td>`+material.name+`</td>
		                        <td>`+style.name+`</td>
		                        <td>`+quantity+`</td>
		                        <td>
		                            <button type="button" class="btn btn-warning btn-edit-productdetail" data-url="/admin/productdetail/`+productdetail_id+`" >Edit</button>
		                            <button type="button" class="btn btn-danger btn-delete-productdetail" data-url="/admin/productdetail/`+productdetail_id+`">Delete</button>
		                        </td>
		                    </tr>
						`;
				}
				$('#productdetail').html(a);
				
				    
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})
	//bắt sự kiện click vào nút add
	$('#add_product').click(function (e) {
		e.preventDefault();
		//hiện modal show
		$('#modal-add-product').modal('show');
	})

	$('#btn_add_productdetail').click(function(e){
		e.preventDefault();
		$('#modal-add-productdetail').modal('show');
	})

	$('#form-add-productdetail').submit(function (e) {
		e.preventDefault();
		//lấy attribute data-url của form lưu vào biến url
		var url=$(this).attr('data-url');
		var product_id = $('.btn-add-productdetail').attr('data-id');
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				product_id: product_id,
				color_id: $('#color_id_add').val(),
				size_id: $('#size_id_add').val(),
				style_id: $('#style_id_add').val(),
				material_id: $('#material_id_add').val(),
				quantity: $('#quantity_add').val(),
			},
			success: function (response) {
				toastr.success('Add new Product detail success!');
				$('#modal-add-productdetail').modal('hide')

				$('#productdetail').append(
					`
						<tr id=`+response.data.id+`>
		                    <td>`+response.color_name+`</td>
		                    <td>`+response.size_name+`</td>
		                    <td>`+response.style_name+`</td>
		                    <td>`+response.material_name+`</td>
		                    <td>`+response.data.quantity+`</td>
		                    <td>
		                        <button type="button" class="btn btn-warning btn-edit-productdetail" data-url="/admin/productdetail/`+response.data.id+`" >Edit</button>
		                        <button type="button" class="btn btn-danger btn-delete-productdetail" data-url="/admin/productdetail/`+response.data.id+`">Delete</button>
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

	//Xóa product detail
	$(document).on('click', '.btn-delete-productdetail', function(e) {
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
					toastr.success('Delete product detail success!');

					$('#'+ response.id).remove();
				},
				error: function (error) {
					
				}
			})
		}
});

	//bắt sự kiện click vào nút edit product detail
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

	//bắt sự kiện submit form edit product detail
	$('#form-edit-productdetail').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		var product_id = $('.btn-add-productdetail').attr('data-id');
		$.ajax({
			type: 'post',
			url: url,
			data: {
				product_id: product_id,
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

				$('#'+response.data.id).replaceWith(
					`
						<tr id=`+response.data.id+`>
		                    <td>`+response.color_name+`</td>
		                    <td>`+response.size_name+`</td>
		                    <td>`+response.style_name+`</td>
		                    <td>`+response.material_name+`</td>
		                    <td>`+response.data.quantity+`</td>
		                    <td>
		                        <button type="button" class="btn btn-warning btn-edit-productdetail" data-url="/admin/productdetail/`+response.data.id+`" >Edit</button>
		                        <button type="button" class="btn btn-danger btn-delete-productdetail" data-url="/admin/productdetail/`+response.data.id+`">Delete</button>
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
	$('#form-add-product').submit(function (e) {
		e.preventDefault();
		//lấy attribute data-url của form lưu vào biến url
		var url=$(this).attr('data-url');
		formdata = new FormData($(this)[0]);
		var content = tinymce.get('content_add').getContent();
		formdata.append("content", content);
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: formdata,
			contentType: false,
			processData: false,
			success: function (response) {
				toastr.success('Add new Product success!');
				$('#modal-add-product').modal('hide')

				$('#products-table').DataTable().ajax.reload();

				$('#code_add').val('')
				$('#name_add').val('')
				$('#slug_add').val('')
				$('#price_add').val('')
				$('#sale_price_add').val('')
				$('#content_add').val('')
				$('#description_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// console.log(jqXHR.responseJSON.errors.code[0])
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.code[0]+ '</p>').insertAfter('#code_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.name[0]+ '</p>').insertAfter('#name_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.slug[0]+ '</p>').insertAfter('#slug_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.price[0]+ '</p>').insertAfter('#price_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.content[0]+ '</p>').insertAfter('#content_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.description[0]+ '</p>').insertAfter('#description_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.thumbnail[0]+ '</p>').insertAfter('#thumbnail_add')
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete-product', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		var mytable = $('#products-table').DataTable();
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
		$(document).on('click', '.btn-edit-product', function() {

		//mở modal edit lên
		$('#modal-edit-product').modal('show');
		//lấy data-url của nút edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function (response) {
				$('#code_edit').val(response.data.code)
				$('#name_edit').val(response.data.name)
				$('#slug_edit').val(response.data.slug)
				$('#price_edit').val(numeral(response.data.price).format('0,0'))
				$('#sale_price_edit').val(response.data.sale_price)
				tinymce.get('content_edit').setContent(response.data.content)
				$('#thumbnail_edit').html(`<img src='../storage/images/` +response.data.thumbnail+ `' name='thumbnail' alt='` +response.data.thumbnail+ `' style='width:50px; height:50px'>`)
				$('#description_edit').val(response.data.description)
				$('#category_id_edit').val(response.data.category_id)
				$('#brand_id_edit').val(response.data.brand_id)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit-product').attr('data-url',"/admin/product/"+response.data.id)
			},
			error: function (error) {
				
			}
		})
	})

	//bắt sự kiện submit form edit
	$('#form-edit-product').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		formdata = new FormData($("#form-edit-product")[0]);
		var content = tinymce.get('content_edit').getContent()
		formdata.append("content", content)
		$.ajax({
			type: 'post',
			url: url,
			data: formdata,
			contentType: false,
			processData: false,
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product success!')
				//ẩn modal edit
				$('#modal-edit-product').modal('hide');
				
				$('#products-table').DataTable().ajax.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.code[0]+ '</p>').insertAfter('#code_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.name[0]+ '</p>').insertAfter('#name_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.slug[0]+ '</p>').insertAfter('#slug_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.price[0]+ '</p>').insertAfter('#price_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.content[0]+ '</p>').insertAfter('#content_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.description[0]+ '</p>').insertAfter('#description_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.thumbnail[0]+ '</p>').insertAfter('#thumbnail_edit')
			}
		})
	})
})