@extends('layouts.website.app')

@section('content')
<h1 class="text-center">Thank You</h1>

<div  class="container mb-5" >
<table class="table">
	<thead>
		
		<th>Transaction Id</th>
		<th>Payment-Type</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>Address</th>
		<th>Pincode</th>
		<th>State</th>
		<th>Country</th>
		<th>Subtotal</th>
		<th>Tax</th>
		<th>GrandTotal</th>
	</thead>
	<tbody>
		@if(!empty($orders))
		@foreach($orders as $order)
			<td>{{$order->txn_id }}</td>
			<td>{{$order->payment_type }}</td>
			<td>{{$order->email }}</td>
			<td>{{$order->mobile }}</td>
			<td>{{$order->address }}</td>
			<td>{{$order->pincode }}</td>
			<td>{{$order->state }}</td>
			<td>{{$order->country }}</td>
			<td>{{$order->subtotal }}</td>
			<td>{{$order->tax }}</td>
			<td>{{$order->grandtotal }}</td>
			
		@endforeach
		@endif
	</tbody>
</table>

<div class="col-md-6"></div>
<div class="col-md-6">
	<a href="{{ url('/') }}" class="btn btn-primary">Back to home</a>
</div>
</div>

 <?php // print_r($order); ?>
 @endsection