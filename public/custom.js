function SubmitContact(){
	var form = $('#contactForm')[0];
	var formData= new FormData(form);
	var url = $('#contactForm').attr('action');
	var type = $('#contactForm').attr('method');
	$.ajax
	({
		url:url,
		type:type,
		data:formData,
		cache : false,
       processData: false, 
       contentType:false,
      
	    success:function(data)
	    {
	    	 if($.isEmptyObject(data.error))
            { 

            	$('#message').css('display','block');
            	$('#message').empty();
            	$('#message').append('<div class="alert alert-success"><li>'+data.success+'</li></div>');
            	$("#contactForm")[0].reset();
            	setTimeout(function()
            	{
			        $("#message").hide();
			    }, 1000);
            }
            else
            {
            	$('#message').css('display','block');
            	$('#message').empty();
            	$('#message').append('<div class="alert alert-danger" id="alert"></div>');
            	$.each(data.error,function(key,value)
            	{   
            		$('#alert').append('<li>'+value+'</li>');
            	});
            	
            }
	    }
	});

}

function subscribe(){
var url = $('#subscribe').attr('action');
var type = $('#subscribe').attr('method');
var form = $('#subscribe')[0];
var formData = new FormData(form);
$.ajax({
	url:url,
	type:type,
	data:formData,
	cache : false,
   processData: false, 
   contentType:false,
	success:function(data)
	{
		if(data.error)
		{
			$('.subscribe').addClass('alert alert-danger');
			$.each(data.error,function(key,value){
				$('.subscribe').append('<li>'+value+'</li>');
			});
		}
		else{
			$('.subscribe').addClass('alert alert-success');
			$('.subscribe').append('<li>'+data.message+'</li>');
			$('#subscribe')[0].reset();
			setTimeout(function()
			{
				$('.subscribe').hide();
			},1000);
		}
	}
});

}

// Admin Funcitonality


function addcategory()
{
	var form = $('#addcategoryForm')[0];
	var url = $('#addcategoryForm').attr('action');
	var type = $('#addcategoryForm').attr('method');
	var formData= new FormData(form);
// alert(type);
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		processData:false,
		contentType:false,
		success:function(data)
		{
			console.log(data.html);
			if(data.errors)
			{
				$('#categoryMessage').empty();
				$('#categoryMessage').addClass('alert alert-danger');
				$.each(data.errors,function(key,value){
					$('#categoryMessage').append('<li>'+value+'</li>');
				});
			}
			else
			{
				$('#categoryMessageSuccess').addClass('alert alert-success');
				$('#categoryMessageSuccess').append('<li>'+data.success+'</li>');
				setTimeout(function(){
					$('#categoryMessageSuccess').hide();
				},2000);
				$('#dismissModel').click();
			
			$('#tbodyCategory').empty();
			$('#tbodyCategory').html(data.html);
		}
		}
	});
	
}



function deleteContactId(url,id)
{
	var id = id;
	var url = url;
	console.log(url); 
	if(id)
	{
		$.ajax(
		{
			url:url,
			type:"post",
			data:
			{
				id:id
				 
			},
			headers:
            {
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },	
			success:function(data)
			{
				if(data.message)
				{
					
			
					$('#message').append('<div class="alert alert-success">'+data.message+'</div>');
					setTimeout(function()
	            	{
				        $("#message").hide();
				         
				    }, 1000);
				    $('#tbodyContact').html(data.html);
						// window.location.reload(true);
				}
			}

		})
	}
}


function editCategory(url,categoryId)
{
	$.ajax({
		url:url,
		type:'get',
		data:{
			categoryId:categoryId
		},
		success:function(data)
		{
			// console.log(data);
			// console.log(data.category.name);
			$('#categoryId').val(data.category.id);
			$('#eCategory').val(data.category.name);
		}
	})
}


function updateCategory()
{
		var form = $('#editCategoryForm')[0];
		var url = $('#editCategoryForm').attr('action');
		var type = $('#editCategoryForm').attr('method');
		var formData = new FormData(form);		
		$.ajax({
			url:url,
			type:type,
			data:formData,
			cache:false,
			processData:false,
			contentType:false,

			success:function(data)
			{
				console.log(data.html);
				if(data.errors)
				{


					$('#editCategoryMessage').empty();
					$('#editCategoryMessage').addClass('alert alert-danger');
					$.each(data.errors,function(key,value)
					{
						$('#editCategoryMessage').append('<li>'+value+'</li>');
					});
				
					
				}
				else
				{
					$('#categoryMessageSuccess').show();
					$('#categoryMessageSuccess').empty();
					$('#categoryMessageSuccess').addClass('alert alert-success');
					$('#categoryMessageSuccess').append('<li>'+data.message+'</li>');
					setTimeout(function(){
						$('#categoryMessageSuccess').hide();
					},1000);
					$('#EditDismissModel').click();
					$('#tbodyCategory').empty();
					$('#tbodyCategory').append(data.html);
				}
			}
		});
}


function deleteCategory(url,categoryId)
{
	if(categoryId)
	{
		$.ajax({
			url:url,
			type:'get',
			data:{
				categoryId:categoryId
			},
			success:function(data)
			{
				console.log(data.html);
				if(data.success)
				{

					$('#categoryMessageSuccess').addClass('alert alert-success');
				$('#categoryMessageSuccess').append('<li>'+data.success+'</li>');
				setTimeout(function(){
					$('#categoryMessageSuccess').hide();
				},2000);
				$('#tbodyCategory').empty();
					$('#tbodyCategory').html(data.html);				
			
				}
			}

		});
	}
}


function addSubCategory()
{
	var form = $('#addSubCategoryForm')[0];
	var url = $('#addSubCategoryForm').attr('action');
	var type = $('#addSubCategoryForm').attr('method');
	var formData = new FormData(form);
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		contentType:false,
		processData:false,
		success:function(data)
		{
			// console.log(data.errors);
			if(data.errors)
			{
				$('#subCategoryErrorMessage').empty();
				$('#subCategoryErrorMessage').addClass('alert alert-danger');
				$.each(data.errors,function(key,value){
					$('#subCategoryErrorMessage').append('<li>'+value+'</li');
				});
			}
			else
			{
				$('#subCategoryMessage').empty();
				$('#subCategoryMessage').show();
				$('#subCategoryMessage').addClass('alert alert-success');
				$('#subCategoryMessage').append('<li>'+data.message+'</li>');
				setTimeout(function(){
					$('#subCategoryMessage').hide();
				},2000);
				$('#dismissModelAddSubCategory').click();
				$('#tbodySubCategory').empty();
				$('#tbodySubCategory').html(data.html);
				

			}
		}
	});
}


function editSubCategory(url,subCategoryId)
{
	$.ajax({
		url:url,
		type:'get',
		data:
		{
			subCategoryId:subCategoryId
		},
		success:function(data)
		{
			// console.log(data.subCategory.category.name);
			$('#eSubCategoryName').val(data.subCategory.name);
			$('#subCategoryId').val(data.subCategory.id);
			$('#mainCategoryName').val(data.subCategory.cat_id).change();

		}
	})
}


function updateSubCategory()
{
	var form = $('#updateSubCategoryForm')[0];
	var url = $('#updateSubCategoryForm').attr('action');
	var type = $('#updateSubCategoryForm').attr('method');
	var formData = new FormData(form);
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		contentType:false,
		processData:false,
		success:function(data)
		{
			console.log(data);
			if(data.errors)
			{
				$('#subCategoryEditErrorMessage').empty();
				$('#subCategoryEditErrorMessage').addClass('alert alert-danger');
				$.each(data.errors,function(key,value)
				{
					$('#subCategoryEditErrorMessage').append('<li>'+value+'</li>');
				});
			}
			else
			{
				$('#subCategoryMessage').empty();
				$('#subCategoryMessage').show();
				$('#subCategoryMessage').addClass('alert alert-success');
				$('#subCategoryMessage').append('<li>'+data.message+'</li>');
				setTimeout(function(){
					$('#subCategoryMessage').hide();
				},2000);
				$('#tbodySubCategory').empty();
				$('#tbodySubCategory').html(data.html);
				$('#dismissModelEditSubCategory').click();
				

			}
		}
	})
}



function deleteSubCategory(url,subCategoryId)
{
	var x = confirm('Do You Want Delete This Item');
	if(x)
	{
		$.ajax({
			url:url,
			type:'get',
			data:
			{
				subCategoryId:subCategoryId
			},
			success:function(data)
			{
				$('#subCategoryMessage').empty();
				$('#subCategoryMessage').show();
				$('#subCategoryMessage').addClass('alert alert-success');
				$('#subCategoryMessage').append('<li>'+data.message+'</li>');
				setTimeout(function(){
					$('#subCategoryMessage').hide();
				},2000);
				$('#tbodySubCategory').empty();
				$('#tbodySubCategory').html(data.html);
			}
		})
	}
}


    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function (e) {
    //             alert(e.target.result);
    //             $('#imgLogo').attr('src', e.target.result);
    //         }

    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }

  function readURL(input) {
        

           var total_file=document.getElementById("productImage").files.length;            
              $('.productImages').html("");
             for(var i=0;i<total_file;i++)
     		  {
     			 $('.productImages').append("<img width='70' height='70' src='"+URL.createObjectURL(event.target.files[i])+"'>");
   			  }
           
          
        
    }   

    function mainReadUrl(input)
    {
    	 // var main_file=document.getElementById("productMainImages").files.length;
             $('.productMainImages').html("");
              $('.productMainImages').append("<img width='70' height='70' src='"+URL.createObjectURL(event.target.files[0])+"'><br>");
    }



function addProduct()
{
	var form = $('#addProductForm')[0];
	var formData = new FormData(form);
	var url = $('#addProductForm').attr('action');
	var type = $('#addProductForm').attr('method');
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		contentType:false,
		processData:false,
		success:function(data)
		{
			// console.log(data);
			if(data.errors)
			{
				$('#productErrorMessage').empty();
				$('#productErrorMessage').addClass('alert alert-danger');
				$.each(data.errors,function(key,value){
					$('#productErrorMessage').append('<li>'+value+'</li>');
				});

			}
			else
			{
				$('#productMessage').empty();
				$('#productMessage').show();
				$('#productMessage').addClass('alert alert-success');
				$('#productMessage').append('<li>'+data.message+'</li>');
				setTimeout(function(){
					$('#productMessage').hide();
				},2000);
				$('#tbodyProduct').empty();
				$('#tbodyProduct').html(data.html);
				$('#dismissModelProduct').click();

			}
		}
	})
	// console.log(form);
}



function editProduct(url,productId)
{
	if(productId)
	{
		console.log('h');

		$('#editProductModal').modal('show');

	$.ajax({
		url:url,
		type:'get',
		data:{
			productId:productId
		},
		success:function(data)
		{

			// console.log(data.productData);
			$('#eProductImages').empty();
			$.each(data.productData.product_image,function(key,value){
				// console.log(value.image);
$('#eProductImages').append('<img  src="'+ window.document.location.origin +'/eshop/public/uploads/'+value.image +'" width="100" height="100" /> <a href="javascript:void(0)"><i onclick="removeImage('+value.id+','+value.product_id +')" class="fas fa-times text-danger"></i></a>');
		

// $('#eProductImages').append('<img src="'+ window.document.location.origin +'/eshop/public/uploads/'+value.image +'" width="100" height="100" /> <a href="javascript:void(0)"><i onclick="removeImage('+value.id +','+ window.location+'/removeImage)" class="fas fa-times text-danger"></i></a>');


			});


			// console.log(window.location.origin);
			$('#eProductId').val(data.productData.id);
			$('#eProductName').val(data.productData.name);
			$('#eProductTitle').val(data.productData.title);
			$('#eProductPrice').val(data.productData.price);
			$('#eProductMainImage').attr('src',window.document.location.origin+'/eshop/public/uploads/'+data.productData.image);

			$('#eProductDescription').val(data.productData.description);
			$('#eProductSubcategory').val(data.productData.sub_cat_id);
			// $.each(data.productData.product_image,function(key,value1){
			// 	$('#eProductImage').val(value1.image);
			// });
			
			
		}

	});
}
}

	function removeImage(imgId,productId)
	{
		var imgId = imgId;
		var productId = productId;
	    var url = window.location+'/removeImage'
	    if(imgId)
	    {
	    	$.ajax({ 
	    	url:url,
	    	type:'post',
	    	data:
	    	{
	    		imgId:imgId,
	    		productId:productId
	    	},
	    	headers:
	    	{
	    		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
	    	},
	    	success:function(data)
	    	{
	    		
	    		if(data){
	    			console.log(data);
	    			$('#eProductImages').empty();
	    		$.each(data.productData.product_image,function(key,value){
				
$('#eProductImages').append('<img src="'+ window.document.location.origin +'/eshop/public/uploads/'+value.image +'" width="100" height="100" /> <a href="javascript:void(0)"><i onclick="removeImage('+value.id+','+value.product_id +')" class="fas fa-times text-danger"></i></a>');
		

	    		})

	    	}

	    }


	    });

	    }
	}


function updateProduct()
{
	var form = $('#updateProductForm')[0];
	var formData = new FormData(form);
	var url = $('#updateProductForm').attr('action');
	var type = $('#updateProductForm').attr('method');
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		contentType:false,
		processData:false,
		success:function(data)
		{
			if(data.errors)
			{
				$('#editProductErrorMessage').empty();
				$('#editProductErrorMessage').show();
				$('#editProductErrorMessage').addClass('alert alert-danger');
				$.each(data.errors,function(key,value)
				{
					$('#editProductErrorMessage').append('<li>'+value+'</li>');
				});
				
			}
			else
			{
				$('#productMessage').empty();
				$('#productMessage').addClass('alert alert-success');
				$('#productMessage').show();
				$('#productMessage').append('<li>'+data.message+'</li>');
				setTimeout(function(){
					$('#productMessage').hide();
				},2000);
				$('#tbodyProduct').empty();
				$('#tbodyProduct').html(data.html);
				$('#dismissModelEditProduct').click();
			}
		}
	});
}


 function deleteProduct(url,productId)
 {
 	var x = confirm('Are You Sure You Want To Delete This Item ?');
 	if(x)
 	{
 		$.ajax({
 			url:url,
 			type:'get',
 			data:{
 				productId:productId
 			},
 			success:function(data)
 			{
 				if(data.message)
 				{
 					$('#productMessage').empty();
 					$('#productMessage').addClass('alert alert-success');
 					$('#productMessage').show();
 					$('#productMessage').append('<li>'+data.message+'</li>');
 					setTimeout(function(){
 						$('#productMessage').hide();
 					},2000);
 					$('#tbodyProduct').empty();
 					$('#tbodyProduct').html(data.html);
 				}
 			}
 		})
 	}
 }


 function transactionUserDetail(url,orderId)
 {
 	var orderId = orderId;
  	var url = url;
  	if(orderId)
  	{
  		$.ajax({
 			url:url,
 			type:'post',
 			data:{
 				orderId:orderId
 			},
 			headers:
 			{
 				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
 			},
 			success:function(data)
 			{
 				if(data.order)
 				{
 					// console.log(data.order);
 					// console.log(data.order.name);
 					$('#username').val(data.order.name);
 					$('#email').val(data.order.email);
 					$('#phone').val(data.order.phone);
 					$('#mobile').val(data.order.mobile);
 					$('#address').val(data.order.address);
 					$('#pincode').val(data.order.pincode);
 					// $('#city').val(data.order.city);
 					$('#state').val(data.order.state);
 					$('#country').val(data.order.country);
 				}
 			}
 		});
  	}
 }


function prodcutDetail(url,orderId)
  {
   $('#modalBody').append(productTable);
   $('#productTable').show();
   var orderId = orderId;
    var url = url;
    console.log(url);
    if(orderId)
    {
      $.ajax({
      url:url,
      type:'post',
      data:{
        orderId:orderId
      },
      headers:
      {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      },
      success:function(data)
      {
        if(data.productDetail)
        {
           var i = 0; 
            $('#tbodyProductDetail').empty();
         $.each(data.productDetail,function(key,value)
         {
          i++;
          if(value.price <= 0)
          {
            value.price = 1;
          }
          $('#tbodyProductDetail').append('<tr><td>'+i+'</td><td><img src="'+ window.document.location.origin +'/eshop/public/uploads/'+value.product_image +'" alt="" width="50" height="50"</td><td>'+value.name+'</td><td>'+value.price+'</td><td>'+value.qty+'</td></tr>')
         })
        }
      }
    });
    }  
  }



function downloadOrder(url,orderId)
{
	if(orderId)
	{
		$.ajax({
			url:url,
			type:'get',
			data:
			{
				orderId:orderId
			},
			success:function(data)
			{
				if(data)
				{
				console.log(data);
				}
			}
		})
	}
}

  function deleteOrder(url,orderId)
  {
  	var orderId = orderId;
  	var url = url;
  	if(orderId)
  	{
  		$.ajax({
 			url:url,
 			type:'get',
 			data:{
 				orderId:orderId
 			},
 			success:function(data)
 			{
 				if(data.message)
 				{
 					console.log(data.html);
 					$('#message').addClass('alert alert-success');
 					$('#message').append('<li>'+data.message+'</li>');
 					setTimeout(function(){
 						$('#message').hide();
 					},2000);
 					$('#tbodyOrder').empty();
 					$('#tbodyOrder').html(data.html);
 				}
 			}
 		});
  	}
  }

function editUserStatus(userId,status,url)
{
	console.log(userId);
	console.log(status);
	console.log(url);
	if(userId)
	{
		$.ajax({
			url:url,
			type:'get',
			data:
			{
				userId:userId,
				status:status
			},
			success:function(data)
			{
				if(data.html)
				{
					if(data.message==1)
					{
						$('#messageUser').show();
						$('#messageUser').addClass('alert alert-danger');
						$('#messageUser').append('<li>User Deactive </li>');
												
					}
					else{
						$('#messageUser').show();
						
						$('#messageUser').addClass('alert alert-success');
						$('#messageUser').append('<li>User Active </li>');
						
					}
					setTimeout(function(){
						$('#messageUser').hide();
						$('#messageUser').removeClass();
						$('#messageUser').empty();

					},500);
					$('#tbodyUsers').empty();
					$('#tbodyUsers').html(data.html);
						
				}
			}

		});
	}
}


// Website Function

function deleteSubscribeId(url,id)
{
	var id = id;
	var url = url;
	console.log(url); 
	if(id)
	{
		$.ajax(
		{
			url:url,
			type:"post",
			data:
			{
				id:id
				 
			},
			headers:
            {
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },	
			success:function(data)
			{
				if(data.message)
				{
					
			
					$('#message').append('<div class="alert alert-success">'+data.message+'</div>');
					setTimeout(function()
	            	{
				        $("#message").hide();
				         
				    }, 1000);
				    $('#tbodyContact').html(data.html);
						// window.location.reload(true);
				}
			}

		})
	}
}


function viewproduct(url,id){
  if(id){
  	$.ajax({

  		url:url,
  		type:'get',
  		data:{
  			id:id
  		},
  		success:function(data){
  			if(data){
  				$('#AllProduct').empty();
  				// console.log(data.html);
  				$('#AllProduct').html(data.html);
  			}
  		}
  	});
  }
}

function addtocart(url,product_id,product_image,product_name,product_price){
	var quantity = $('#ProductQuantity').val();
	var product_id = product_id;
	var product_image = product_image;
	var product_name = product_name;
	var product_price = product_price;
	if(product_id){
		$.ajax({
			url:url,
			type:'get',
			data:{
				product_id:product_id,
				product_image:product_image,
				product_name:product_name,
				product_price:product_price,
				quantity:quantity
			},
			success:function(data){			
				// console.log(data);
				if(data.message){
					$('#showMessage').addClass('alert alert-success');
					$('#showMessage').append('<li>'+data.message+'</li>');
					setTimeout(function(){
						$('#showMessage').hide();
					},1000);
				}


			}
		})
	}
}

function showCart(){
	
	$.ajax({
		url:'cart',
		type:'get',
		success:function(data){
			// $('#tbodyCart').html(data);
			// console.log('data.html');
				$('#tbodyCart').empty();
				$('#tbodyCart').html(data.html);
				$('#tax').text('$'+data.tax);
				$('#subtotal').text('$'+data.subtotal);
				$('#total').text('$'+data.total);
		}
	})
}

function removeCartItem(url,rowId){
	if(rowId){
		$.ajax({
			url:url,
			type:'get',
			data:{
				rowId:rowId
			},
			success:function(data){
				// console.log(data);
				if(data.message){
					$('#showMessage').addClass('alert alert-danger');
					$('#showMessage').append('<li>'+data.message+'</li>');
					setTimeout(function(){
						$('#showMessage').hide();
					},1000);
					showCart();
					// alert('product Deleted Successfully');
					// location.reload();
						// $('#tbodyCart').empty();
					// showCart();
				}
			}
		})
	}
}


 function addQty(rowId){
 var qty = $('#cartQty_'+rowId).val();
 if(qty){
 	$.ajax({
 		url:'addQty',
 		type:'get',
 		data:{
 			qty:qty,
 			rowId:rowId
 		},
 		success:function(data){
 			if(data.message){
 				// $('#showMessage').show();

 				// $('#showMessage').addClass('alert alert-success');
					// $('#showMessage').append('<li>'+data.message+'</li>');
					// setTimeout(function(){

					// 	$('#showMessage').hide();
					// 	$('#showMessage').empty();
					// },1000);
					// console.log(showCart(data.html));
				showCart();
					
					// $('#tbodyCart').empty();
					// $('#tbodyCart').html(data.html);

 			}
 		}
 	})
 }

}


function minusQty(rowId){
	 var qty = $('#cartQty_'+rowId).val();

	 if(qty){
	 	$.ajax({
	 		url:'minusQty',
	 		type:'get',
	 		data:{
	 			qty:qty,
	 			rowId:rowId
	 		},
	 		success:function(data){
	 			// $('#showMessage').show();
	 			// $('#showMessage').addClass('alert alert-success');
	 			// $('#showMessage').append('<li>'+data.message+'</li>');
	 			// setTimeout(function(){
	 			// 	$('#showMessage').hide();
					// 	$('#showMessage').empty();
	 			// },1000);
	 			showCart();
	 		}
	 	})
	 }
}


function registration(){
	var form = $('#registration')[0];
	var formData = new FormData(form);
	var url = $('#registration').attr('action');
	var type = $('#registration').attr('method');
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache : false,
       processData: false, 
       contentType:false,
		success:function(data){
			if(data.error){
				$('#message').empty();
				$('#message').addClass('alert alert-danger');
				$.each(data.error,function(key,value){
					$('#message').append('<li>'+value+'</li>');
					
				});
			}
			else{
				$('#message').empty();
				$('#message').removeClass('alert alert-danger');
				$('#message').addClass('alert alert-success');
				$('#message').append('<li>'+data.message+'</li>');
			}
		}
	});
}


function loginUser(){
	var form = $('#loginUser')[0];
	var url = $('#loginUser').attr('action');
	var type = $('#loginUser').attr('method');
	var formData = new FormData(form);
	console.log(url);
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		processData:false,
		contentType:false,
		success:function(data){
			if(data.error){
				$('#loginMessage').empty();
				$('#loginMessage').addClass('alert alert-danger');
				$.each(data.error,function(key,value){
					$('#loginMessage').append('<li>'+value+'<li>');
				});

				
			}else if(data.customError){
				$('#loginMessage').empty();
				$('#loginMessage').addClass('alert alert-danger');
				$('#loginMessage').append('<li>'+data.customError+'</li>');
			}
			else if(data.success)
			{
				alert(data.success);
				// $('#loginMessage').empty();
				// $('#loginMessage').removeClass('alert alert-danger');
				// $('#loginMessage').addClass('alert alert-success');
				// $('#loginMessage').append('<li>'+data.success+'</li>');
				window.location.href="user/profile";
			
			}

		}
	});
}

function paynow()
{
	var form = $('#payNow')[0];
	var formData = new FormData(form);

	var url=$('#payNow').attr('action');
	var type=$('#payNow').attr('method');
	// console.log(form);
	$.ajax({
		url:url,
		type:type,
		data:formData,
		cache:false,
		processData:false,
		contentType:false,
		success:function(data)
		{
			if(data.errors)
			{
				$('#message').empty();
				$('#message').removeClass('hidden');
				$('#message').addClass('alert alert-danger d-block');
				$.each(data.errors,function(kay,value){
					$('#message').append('<li>'+value+'</li>');
				})
			}

			else
			{
				// console.log('yes');
				if(data.paymentType=='cod'){
					window.location.href="../thankyou";
				// $('#message').empty();
				// $('#message').removeClass('hidden');
				// $('#message').addClass('alert alert-success d-block');
				// $('#message').append('<li>'+data.message+'</li>');
				// setTimeout(function(){
				// 	$('#message').hide();
				// },2000);
				// $('#paypalSubmit').click();
				// window.location.reload(true);
				
				// $('#cart_items').empty();
				// $('#cart_items').html(data.html)
			}
			
			if(data.paymentType=='paypal')
			{
				$('#payByPaypal').click();
				$('#payWithPaypal').click();
 
			}

			if(data.paymentType=='stripe')
			{
				$('#payTyepeButton').hide();
				$('#stripeForm').show();

			}

			}
		}
	});

}


function stripeFun(url)
	{

		var cardName = $('#cardName').val()
		var cardNumber = $('#cardNumber').val()
		var cvc = $('#cvc').val()
		var month = $('#month').val()
		var year = $('#year').val()
		var amount = $('#amount').val()
		
		$.ajax({
			url:url,
			type:'get',
			data:{
				cardName:cardName,
				cardNumber:cardNumber,
				cvc:cvc,
				month:month,
				year:year,
				amount:amount

			},
			headers:
			{				
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
			success:function()
			{
				console.log(data);
			}
		})
	}


function seachBySubcategory(subCategoryId,url){
 console.log(subCategoryId);
 $.ajax({

 	url:url,
 	type:'get',
 	data:{
 		subCategoryId:subCategoryId
 	},
 	headers:
            {
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },	
 	success:function(data)
 	{
 		if(data)
 		{
 			$('#productBySubcategory').empty();
 			$('#productBySubcategory').append(data.html);
 		}
 	}


 })
	
}

function searchProduct(url)
{
	// console.log($('#searchProduct').val());

	var searchProduct = $('#searchProduct').val();
	// console.log(searchProduct);
	if(searchProduct)
	{
		$.ajax({
			url:url,
			type:'get',
			data:{
				searchProduct:searchProduct
			},
			success:function(data)
			{
				// console.log(data.html);
				if(data.html)
				{
					$('#productBySubcategory').empty();
					$('#productBySubcategory').html(data.html);
				}
			}
		});
	}
}


