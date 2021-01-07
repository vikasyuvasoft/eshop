@extends('layouts.website.app')

@section('content')

<section id="cart_items">

		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
		

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<div id="showMessage"></div>
				<table class="table table-condensed">
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
					<!-- 	@include('website.include.cart') -->
					@if($cartItems)
					@foreach($cartItems as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{asset('public/uploads/'.$cart->options->product_image) }}" alt="" width="100" height="100"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cart->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>${{$cart->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<!-- <a class="cart_quantity_up" href=""> + </a> -->
									<b>{{$cart->qty}}</b>
									<!-- <a class="cart_quantity_down" href=""> - </a> -->
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{$cart->subtotal() }}</p>
							</td>
							<td class="cart_delete">
								<!-- <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a> -->
							</td>
						</tr>

					@endforeach
					@endif   
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{Cart::subtotal() }}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>${{Cart::tax() }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{Cart::total() }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>


	
		<div class="row">
		<div class="col-md-12">
			<h1 class="bill-to">Bill To</h1>

		</div>
	</div>
	<div class="row mb-5">
		<div id="message" class="hidden"><p>helo</p></div>
		<form action="{{url('user/payment')}}" method="post" class="mb-5" id="payNow" name="payNow">
			@csrf
		<input type="hidden" name="userId" value="{{$userDetail->id}}">	
		<input type="hidden" name="subtotal" value="{{Cart::subtotal() }}">	
		<input type="hidden" name="tax" value="{{Cart::tax() }}">	
		<input type="hidden" name="grandtotal" value="{{Cart::total() }}">	
		<div class="col-md-6">
			<div class="form-group">
			<input type="text" value="{{$userDetail->name}}" name = "name"  class="form-control" readonly="" placeholder="First Name *" >
			</div>	

			<div class="form-group">
			<input type="email" value="{{$userDetail->email}}" name = "email" class="form-control" readonly="" placeholder="Email Address"  >
			</div>	

			<div class="form-group">
			<input type="text" value="{{$userDetail->phone}}"name = "phone"  class="form-control" placeholder="Enter Phone Number *">
			</div>	

			<div class="form-group">
			<input type="text" value="{{$userDetail->mobile}}"name = "mobile"  class="form-control" placeholder="Enter Mobile Number *">
			</div>	
		</div>	

		<div class="col-md-6 mb-5">
			<div class="form-group">
			<input type="text" value="{{$userDetail->address}}"name = "address"  class="form-control" placeholder="Address *">
			</div>	

			<div class="form-group">
			<input type="text" value="{{$userDetail->pincode}}" name = "pincode" class="form-control" placeholder="Enter Pin Code *">
			</div>	

			<div class="form-group">
			<input type="text" value="{{$userDetail->state}}" name = "state" class="form-control" placeholder="Enter State*">
			</div>	

			<div class="form-group">
			<input type="text" value="{{$userDetail->country}}" name = "country"  class="form-control"required="" placeholder="Enter Country *">
			</div>	

			<div class="form-group mt-3">
					<span>
						<label><input type="radio" id="paytm" onclick="paytm" value="paytm"  name="paymentType"> Paytm</label>
					</span>
					<span>
						<label><input type="radio"  id="cod" value="cod" checked="" name="paymentType" > Cash On Delivery</label>
					</span>
					<span>
						<label><input type="radio" id="paypal" value="paypal"   name="paymentType"> Paypal</label>
					</span>
					<span>
						<label><input type="radio" id="stripe" value="stripe"   name="paymentType"> Stripe</label>
					</span>
				</div>

		

				<button type="button" id ="payTyepeButton" onclick="paynow()" class="btn btn-success mb-5" >Cash On Delivery</button>
		</div>	
	</form>
	</div>	
@include('website.user.stripe')		

<div class="row" id="payByPaypal" style="display: none;">
	<div class="col-md-6"></div>
	<div class="col-md-6">
<div  >
<form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
          action="{!! URL::to('user/paypal') !!}">
     
       {{ csrf_field() }}
   @php $count=0; @endphp
@foreach($cartItems as $cart)
<br>    
      @php $count++; @endphp
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name_{{ $count }}" value="{{$cart->name}}">
<input type="hidden" name="price_{{ $count }}" value="{{$cart->price}}">
<input type="hidden" name="quantity_{{ $count }}" value="{{$cart->qty}}">
@endforeach  
    
       <!-- <label class="w3-text-blue"><b>Enter Amount</b></label> -->
       <!-- <input class="form-control" id="amount" type="text" value="" name="amount"></p> -->
       <input type="hidden" value="{{Cart::total() }}" name="amount" id="amount">
       <button type="submit" id="payWithPaypal" class="btn btn-success">Pay with PayPal</button>
     </form>

 </div>
</div>
</div>

		
			
	{{--	 @include('website.include.paypal')  	 --}}			
		
	</section> <!--/#cart_items-->

<script type="text/javascript">
	
$(document).ready(function(){
	$('#paypal').click(function(){
		$('#payTyepeButton').text('PayPal');
		$('#stripeForm').hide();
		$('#payTyepeButton').show();
		// $('#payByPaypal').show();

	});

	$('#cod').click(function(){
		$('#stripeForm').hide();
		$('#payTyepeButton').show();
	
		$('#payTyepeButton').text('Cash On Delivery');
	});

		$('#paytm').click(function(){
		$('#stripeForm').hide();
		$('#payTyepeButton').show();
		$('#payTyepeButton').text('PayTm');
	});


	$('#stripe').click(function(){
		$('#payTyepeButton').text('Stripe');
		// $('#payTyepeButton').hide();
		// $('#payByPaypal').show();

	});	

})

</script>


@endsection