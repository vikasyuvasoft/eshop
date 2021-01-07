@extends('layouts.admin.app')
@section('title','Orders')
@section('content')

<div class="row">
<div class="col-md-12">	
<div id="message"></div>
</div>
</div>
<div class="row" >
	
	<table class="table custom_table" id="transaction">
		<thead>
			<th>Id</th>
			<th>Transaction Id</th>
			<th>Payment Type</th>
			<th>User Name</th>
			<th>Email</th>
			<th>Subtotal</th>
			<th>Tax</th>
			<th>GrandTotal</th>
			<th>Action</th>
		</thead>
		<tbody id="tbodyOrder">
			@include('admin.include.transaction')
		</tbody>
	</table>
	  {{ $orders->links() }}  
</div>

<!-- User Detail Modal -->
<div class="modal" id="userDetail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Shipping Address</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Name</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="username"  readonly class="form-control">
        </div>
        </div>
          </div>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Email</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="email"  readonly class="form-control">
        </div>
        </div>
          </div>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Phone</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="phone"  readonly class="form-control">
        </div>
        </div>
          </div>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Mobile</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="mobile"  readonly class="form-control">
        </div>
        </div>
          </div>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Address</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="address"  readonly class="form-control">
        </div>
        </div>
          </div>

          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Pincode</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="pincode"  readonly class="form-control">
        </div>
        </div>
          </div>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User State</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="state"  readonly class="form-control">
        </div>
        </div>
          </div>
          <div class="form-group">
           <div class="row"> 
            <div class="col-md-3">
              <label>User Country</label>
            </div>
            <div class="col-md-9">
          <input type="text" id="country" readonly  class="form-control">
        </div>
        </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Product Detail Modal -->
<div class="modal" id="productDetail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Order Product Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalBody">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <table id="productTable" class = "table" style="display: none;">
        <thead>
          <tr>
         <th>Id</th>
         <th>Product Image</th>
         <th>Product Name</th>
         <th>Price</th>
         <th>Quantity</th>
       </tr>
         </thead>
         <tbody id="tbodyProductDetail">
         </tbody>
       </table> 
<script type="text/javascript">
  
</script>


@endsection
