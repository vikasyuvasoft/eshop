@extends('layouts.admin.app')
@section('title','Category List')
@section('content')
<section class="content">
		<div id="message"></div>
	<div class="container-fluid">

		<div class="container mr-5 mb-3 text-right">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcategory">
  Add
</button>
		</div>
		 <div id="categoryMessageSuccess"></div>
		<div class="row">
		
			<table class="table">
				<tr>
					<td>S.No.</td>
					<td>Name</td>
					<!-- <td>Sub Category</td> -->
					<td>Action</td>
				</tr>
				<tbody id="tbodyCategory">
				@include('admin.include.category')
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- Add Category Modal -->
<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form action="{{url('admin/category')}}" method="post" id="addcategoryForm">
      <div class="modal-body">
        <div id="categoryMessage"></div>
       	@csrf
       	<div class="form-group">
       		<label>Category Name</label><br>
       		<input type="text" name="category" id="category" class="form-control">
       	</div>

       	
       
      </div>
      <div class="modal-footer">
        <button type="button"  id="dismissModel" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="addcategory()" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Edit Category Modal -->
<div class="modal fade" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form action="{{url('admin/updateCategory')}}" method="post" id="editCategoryForm">
        @csrf
        <input type="hidden" name="categoryId" value="" id="categoryId">
      <div class="modal-body">
        <div id="editCategoryMessage"></div>
      
        <div class="form-group">
          <label>Category Name</label><br>
          <input type="text" name="category" value="" id="eCategory" class="form-control">
        </div>

        
       
      </div>
      <div class="modal-footer">
        <button type="button"  id="EditDismissModel" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateCategory()" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>






@endsection