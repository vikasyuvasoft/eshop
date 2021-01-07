@extends('layouts.admin.app')
@section('title','Sub Category List')
@section('content')
<section class="content">
		<div id="subCategoryMessage"></div>
	<div class="container-fluid">

		<div class="row">
		<div class="col-md-12">
			<a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#addSubCategory" class="btn btn-primary mb-3">Add Subcategory</a>
		</div>
			<table class="table">
				<tr>
					<td>S.No.</td>
					<td>Name</td>
					<td>Main Category</td>
					<td>Action</td>
				</tr>
				<tbody id="tbodySubCategory">
				@include('admin.include.subcategory')
				</tbody>
			</table>
		</div>
	</div>

<!-- Add Sub Category Modal -->
<div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="addSubCategory" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubCategory">Add Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form action="{{url('admin/addSubCategory')}}" method="post" id="addSubCategoryForm">
      <div class="modal-body">
        <div id="subCategoryErrorMessage"></div>
       	@csrf
       	<div class="form-group">
       		<label>Sub Category Name</label><br>
       		<input type="text" name="subCategoryName" id="subCategoryName" class="form-control">
       	</div>

       		<div class="form-group">
       		<label>Main Category </label><br>
       		<select class="form-control" name="mainCategoryName" id="mainCategory">
       		<option value="" >Please Select Main Category</option>
     		@if($category)
       		@foreach($category as $c)
       		<option value="{{$c->id}}" >{{$c->name}}</option>
       		@endforeach
       		@endif  
       		</select>
       	</div>

       	
       
      </div>
      <div class="modal-footer">
        <button type="button"  id="dismissModelAddSubCategory" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="addSubCategory()" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit Sub Category Modal -->
<div class="modal fade" id="editSubCategoryModel" tabindex="-1" role="dialog" aria-labelledby="addSubCategory" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubCategory">Edit Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form action="{{url('admin/updateSubCategory')}}" method="post" id="updateSubCategoryForm">
      <div class="modal-body">
        <div id="subCategoryEditErrorMessage"></div>
       	@csrf  
       	<input type="hidden" name="subCategoryId" value="" id="subCategoryId">
       	<div class="form-group">
       		<label>Sub Category Name</label><br>
       		<input type="text" name="SubCategoryName" id="eSubCategoryName" class="form-control">
       	</div>

       		<div class="form-group">
       		<label>Main Category </label><br>
       		<select class="form-control" name="mainCategoryName" id="mainCategoryName">
       		<option value="" >Please Select Main Category</option>
     		@if($category)
	       		@foreach($category as $c)
	       			<option value="{{$c->id}}" >{{$c->name}}</option>
	       		@endforeach
       		@endif  
       		</select>
       	</div>
       
      </div>
      <div class="modal-footer">
        <button type="button"  id="dismissModelEditSubCategory" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateSubCategory()"  class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>





</section>
@endsection