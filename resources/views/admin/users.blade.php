@extends('layouts.admin.app')
@section('title','Users')
@section('content')


<div class="row">
	<div class="col-md-12">
	<div  id="messageUser"></div>
	</div>

<table class="table">
	<thead>
		<th>S.No</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Mobile</th>
		<th>Address</th>
		<th>Pincode</th>
		<th>State</th>
		<th>Country</th>
		<th>Status</th>
	</thead>
	<tbody id="tbodyUsers">
		@include('admin.include.users')
	</tbody>
</table>



</div>	

<div class="container">
  <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="description"></textarea>
                             <!-- <textarea class="form-control summernote" name="description"></textarea> -->
                        </div>
                           <button type="Submit">Submit</button>
                    </form>
                </div>

<!-- <script type="text/javascript">
  
</script> -->


<div class="barcode container">
    <p class="name">product</p>
    <p class="price">Price: 3'</p>
    {!! DNS1D::getBarcodeHTML('11', "C128",1.4,22) !!}
    <p class="pid">11</p>
</div>




<script>
    CKEDITOR.replace( 'description', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>


{{--<script type="text/javascript">
    CKEDITOR.replace('content', {
    	height:300,
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
      
    });
</script>  --}}
 
@endsection