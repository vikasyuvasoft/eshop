@extends('layouts.admin.app')
@section('title','All Product List')
@section('content')
<section class="content">
		<div id="message"></div>
	<div class="container-fluid">
		<div class="row m-1">
			<div class="col-md-12" id="productMessage">

			</div>
			<div class="col-md-6 ">
				<a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#addProductModal" class="btn btn-primary">Add</a>
			</div>	
		</div>
		<div class="row">
			<table class="table">
				<tr>
					<td>S.No.</td>
					<td>Product Image</td>
					<td>Product</td>
					<td>Title</td>
					<td>Description</td>
					<td>Sub Category</td>
					<td>Price</td>
					<td>Action</td>
				</tr>
				<tbody id="tbodyProduct">
				@include('admin.include.product')
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductModalTitle">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="contianer">
        <div class="offset-md-1 col-md-10 offset-md-1" id="editProductErrorMessage">

        </div>
      </div>
      <form action="{{url('admin/updateProduct')}}" method="post" id="updateProductForm" enctype="multipart/form-data">
      <div class="modal-body">
        <div id="categoryMessage"></div>
        @csrf
        <input type="hidden" name="productId" id="eProductId">
        <div class="form-group">
          <label>Product Name</label><br>
          <input type="text" name="productName" id="eProductName" class="form-control">
        </div>

      <div class="form-group">
          <label>Product Title</label><br>
          <input type="text" name="productTitle" id="eProductTitle" class="form-control">
        </div>

      <div class="form-group">
          <label>Product Description</label><br>
          <textarea name="productDescription" required="" id="eProductDescription" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <label>Product Price</label><br>
          <input type="text" name="productPrice" id="eProductPrice" class="form-control">
        </div>

        <div class="form-group">
          <label> SubCategory</label><br>
          <select name="productSubcategory" id="eProductSubcategory" class="form-control">
            <option value="" selected="" disabled="">--Please Select Category--</option>
            @if($subcategory)
            @foreach($subcategory as $c)
              <option value="{{$c->id }}">{{ $c->name }}(<small style="font-size:10px;,font-weight:20px;">{{ $c->category->name }}</small>)</option>
            @endforeach
            @endif
          </select>
        </div>



              <div class="form-group">
              <label> Product Main Image</label><br>
              <input type="file"  name="productMainImages" id="productMainImages" class="form-control productImage" >
          </div>

 <div class="row">
        <div class="col-md-3">
       <p class="mt-3 ml-3"> Main Image</p></div>
        <div class="col-md-9">
          <img id="eProductMainImage" src=" " class="d-block" width="100" height="100">
        </div>

       </div>


      <div class="form-group">
              <label> Product Optional Image</label><span>(Min 3 Image)</span><br>
              <input type="file" onchange="readURL(this)" multiple="" name="productImage[]" id="productImage" class="form-control productImage" >
          </div>




           <div id="image-holder"> </div>

      <div class="row">   
        <div class="col-md-12  productImage"  id="eProductImages" class="" >
      
        </div>
      </div>
        
       
      </div>
      <div class="modal-footer">
        <button type="button"  id="dismissModelEditProduct" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateProduct()" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModal">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="contianer">
      	<div class="offset-md-1 col-md-10 offset-md-1" id="productErrorMessage">

      	</div>
      </div>
      <form action="{{url('admin/addProduct')}}" method="post" id="addProductForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div id="categoryMessage"></div>
         	@csrf
         	<div class="form-group">
         		<label>Product Name</label><br>
         		<input type="text" name="productName" id="productName" class="form-control">
         	</div>

         	<div class="form-group">
         		<label>Product Title</label><br>
         		<input type="text" name="productTitle" id="productTitle" class="form-control">
         	</div>

        	<div class="form-group">
         		<label>Product Description</label><br>
         		<textarea name="productDescription" required="" id="productDescription" class="form-control"></textarea>
         	</div>

         	<div class="form-group">
         		<label>Product Price</label><br>
         		<input type="text" name="productPrice" id="productPrice" class="form-control">
         	</div>

         	<div class="form-group">
         		<label> SubCategory</label><br>
         		<select name="productSubcategory" class="form-control">
         			<option value="" selected="" disabled="">--Please Select Category--</option>
         			@if($subcategory)
         			@foreach($subcategory as $c)
         				<option value="{{$c->id }}">{{ $c->name }}(<small style="font-size:10px;,font-weight:20px;">{{ $c->category->name }}</small>)</option>
         			@endforeach
         			@endif
         		</select>
         	</div>

              <div class="form-group">
                <label> Product Main Image</label><br>
                <input type="file" onchange="mainReadUrl(this)" name="productMainImages" id="productMainImage" class="form-control productMainImages" >
            </div>

            <div class="row"> 
            <div class="col-md-3">
            <label>Main Image</label>
            </div>

          <div class="col-md-6 offset-md-3 productMainImages"  id="productMainImages">
           
          </div>
        </div>
         
  	  	<div class="form-group">
  				<label> Product Image</label><span>(Min 3 Image)</span><br>
  				<input type="file" onchange="readURL(this)" multiple="" name="productImage[]" id="productImage" class="form-control productImage" >
  			</div>
     				 <div id="image-holder"> </div>

     		<div class="row">	
          <div class="col-md-2">
            <label>Optional Multipal Image</label>
          </div>
          <div class="col-md-10">	
            <div class="row">
         			<div class="col-md-12  productImages"  id="productImages">
         				
         			</div>
            </div>
          </div>
     		</div>

        <div class="row">
          <div class="col-md-10"><p>Do You Want to send Mail All Subscribe Users  for This Product ?</p></div>
          <div class="col-md-2"><br><input type="checkbox" name="notification[]"  /></div>      
        </div>
        <div class="modal-footer">
          <button type="button"  id="dismissModelProduct" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="addProduct()" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>






@endsection