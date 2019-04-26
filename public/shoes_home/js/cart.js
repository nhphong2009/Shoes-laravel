$(document).ready(function () {
	$('.changeQuantity').click(function(e) {
		e.preventDefault();
		var status = $(this).attr('status');
		var rowId = $(this).attr('data-id');
		$.ajax({
			type: 'get',
			url: 'changQuantity/'+rowId,
			data: {
				status: status,
			},
			success: function (response) {
				console.log(response)
				if(response.update == 1)
				{
					$('#checkout-'+ response.rowId).remove();
				}
				else
				{
					$('#qty-'+ response.update.rowId).text(response.update.qty);
					var subtotal = response.update.qty * response.update.price;
					var new_subtotal = numeral(subtotal).format('0,0');
					$('#subtotal-'+ response.update.rowId).text(new_subtotal);
				}
			},
			error: function (error) {
				
			}
		})
	});

	$('#add_order').submit(function(e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		formdata = new FormData($(this)[0]);
		$.ajax({
			type: 'post',
			url: url,
			data: formdata,
			contentType: false,
			processData: false,
			success: function(response) {
				$('.show_all_checkout').remove();
				$('.show_complete_checkout').append('<h3 style="margin: 100px auto"> THANK FOR BUYING PRODUCT IN MY WEBSITE </h3>');
			}
		});
	})

	$('#add_cart').submit(function (e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		formdata = new FormData($(this)[0]);
		$.ajax({
			type: "post",
			url: url,
			data: formdata,
			contentType: false,
			processData: false,
			success: function(response) {
				$('.show_items').append(`
				<tr id="`+ response.add_cart.rowId +`">
					<td><img src="../storage/images/`+ response.add_cart.options.image +`"></td>
					<td>`+ response.add_cart.name +`</td>
					<td>`+ response.add_cart.price +` VNĐ</td>
					<td>`+ response.add_cart.qty +`</td>
					<td>`+ response.add_cart.options.subtotal +` VNĐ</td>
					<td>
						<button class="remove_rowId" data-url="/removecart/`+ response.add_cart.rowId +`" type="button"> Xóa </button>
					</td>
				</tr>
				`);
				$('#cart_count').text(response.count);
				$('#cart_subtotal').text(response.subtotal);
			},
			error: function (jqXHR, textStatus, errorThrown) {

				$('#showQuantity').html('Số lượng vừa nhập vượt quá số lượng hiện có')
			}
		});
	});

	$('.remove_rowId').click(function(e){
		e.preventDefault();
		var url=$(this).attr('data-url');
		$.ajax({
			type: 'get',
			url: url,
			success: function (response) {
				$('tr#'+ response.rowId).remove();
		    	$('#cart_count').text(response.count);
		    	$('#cart_subtotal').text(response.subtotal);
			},
			error: function (error) {
				
			}
		})
	});

    $(document).on('change', '#color', function() {
    	var product_id = $('#product_id').val();
    	var color_id = $(this).val()
    	$.ajax({
    		type: 'get',
    		url: '/product/get-size-by-color?product_id=' + product_id +'&color_id=' + color_id,
    		success: function(response) {
    			$('#size').html('');
    			$('#showQuantity').html('');
    			if (response.size_ids.length > 0) {
    				$.each(response.size_ids, function( index, value ) {
    					$('#size').append('<option class="size_id" value="'+ value.id +'">' + value.name + '</option>')
					});
    			} else {
    				if(color_id == 0)
    				{
    					$('#showQuantity').html('');
    				}
    				else
    				{
    					$('#showQuantity').text('Hiện sản phẩm không có');
	    				$('#size').append('<option class="size_id" value="0"> -- Chọn --</option>')
    				}
    			}
    			
    		}
    	})
    })

    $(document).on('change', '#size', function() {
    	var product_id = $('#product_id').val();
    	var size_id = $(this).val();
    	$.ajax({
    		type: 'get',
    		url: '/product/get-quantity-by-productDetail?product_id=' + product_id +'&size_id=' + size_id,
    		success: function(response) {
    			$('#showQuantity').html('')

    			if (response.arr_ids.length > 0) {
	    			$.each(response.arr_ids, function( index, value ) {
	    				if(value.quantity == 0)
	    				{
	    					$('#showQuantity').text('Hiện sản phẩm không có')
	    				}
	    				else
	    				{
	    					$('#showQuantity').text(value.quantity +' sản phẩm có sẵn')
	    				}
					});
	    		}
	    		else
	    		{
	    			$('#showQuantity').text('Hiện sản phẩm không có!')
	    		}
    		}
    	})
    })

    $('#quantity').on('change', function(e) {
    	var product_id = $('#product_id').val();
    	var size_id = $('#size').val();
    	$.ajax({
    		type: 'get',
    		url: '/product/get-quantity-by-productDetail?product_id=' + product_id +'&size_id=' + size_id,
    		success: function(response) {
    			$('#showQuantity').html('')

    			if (response.arr_ids.length > 0) {
	    			$.each(response.arr_ids, function( index, value ) {
	    				if(value.quantity >= $('#quantity').val() && $('#quantity').val() >= 1)
	    				{
							$('#showQuantity').text(value.quantity +' sản phẩm có sẵn')
	    				}
	    				else
	    				{
	    					$('#showQuantity').text('Số lượng nhập sai')
	    				}
					});
	    		}
	    		else
	    		{
	    			$('#showQuantity').text('Hiện sản phẩm không có!')
	    		}
    		}
    	})
    })
})