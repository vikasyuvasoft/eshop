@extends('layouts.website.app')
@section('content')
<section id="cart_items" class="mb-5">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			
		
		{{--		@if( sizeof($cartItems) == 1)  --}}
			<div class="table-responsive cart_info">
				
				<table class="table table-condensed">
					<div id="showMessage"></div>
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody id="tbodyCart">
						@include('website.include.cart')
						
					</tbody>
				</table>
			</div>
		{{--	@else 
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 text-center">
				<img src="{{asset('public/website/images/cart/empty.jpeg') }}" class="rounded" alt="cart" width="150" height="150">	<br><br>
				<h1 class="text-danger">Your Cart Is Empty</h1>
				<a href="{{url('/') }}" class="btn btn-success">Continue Shopping</a>
				</div>
				<div class="col-md-3"></div>


			</div><br><br><br>
			<div class="row">
			</div>
			@endif     --}}
		
		
		</div>
	</section> <!--/#cart_items-->

	{{--   @if( sizeof($cartItems) == 1)    --}}
	<section id="do_action">
		<div class="container">
		
			<div class="row">
			 	<div class="col-sm-6">
				
				</div> 
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span id="subtotal">$<?php echo Cart::subtotal();
 ?></span></li>
							<li>Eco Tax <span id="tax">$<?php echo Cart::tax();
 ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span id="total">$<?php echo Cart::total();
 ?></span></li>
						</ul>
							<a class="btn btn-default update" href="{{url('/')}}">Continue Shoping</a>
							@if(Session::has('WebsiteUserloggedIn'))

							@if( sizeof($cartItems) == 0)
						
							@else
							<a class="btn btn-default check_out" href="{{ url('user/checkout') }}">Check Out</a>

							@endif
							@else
							<a class="btn btn-default check_out" href="{{ url('login') }}">Login</a>
							@endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
{{--   @endif  --}}

@endsection	