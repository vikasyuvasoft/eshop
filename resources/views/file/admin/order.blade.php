<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Order List</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.css') }}">
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if($userOrder)
				<h1 class="text-center text-success">{{$userOrder['title']}}</h1>
				@endif 

				<h4>Your Order List</h4>
			</div>

		</div>

	</div>

	<table class="table">
		<tr>
			<td>1</td>
			<td>Txn-id</td>
			<td>Payment-Type:-</td>
			<td>Name:-</td>
			<td>Email:-</td>
			<td>Phone:-</td>
			<td>Mobile:-</td>
			<td>Address:-</td>
			<td>Pincode:-</td>
			<td>State-</td>
			<td>Country:-</td>
			<td>Subtotal:-</td>
			<td>Tax:-</td>
			<td>Grand-Toal:-</td>
			
		</tr>
		<tr>
			<td>1</td>
			<td>{{ $userOrder['txn_id'] }}</td>	
			<td>{{ $userOrder['payment_type'] }}</td>	
			<td>{{ $userOrder['name'] }}</td>	
				<td>{{ $userOrder['email'] }}</td>	
				<td>{{ $userOrder['phone'] }}</td>	
				<td>{{ $userOrder['mobile'] }}</td>	
				<td>{{ $userOrder['address'] }}</td>	
				<td>{{ $userOrder['pincode'] }}</td>	
				<td>{{ $userOrder['state'] }}</td>	
				<td>{{ $userOrder['country'] }}</td>	
				<td>{{ $userOrder['subtotal'] }}</td>	
				<td>{{ $userOrder['tax'] }}</td>	
				<td>{{ $userOrder['grandtotal'] }}</td>	
		</tr>
	</table>


	<div class="row">
		<div class="col-md-6">
			<ul>
				<ol>S.No</ol>
				<ol>Txn-id:-</ol>
				<ol>Payment-Type:-</ol>
				<ol>Product:-</ol>
				<ol>Name:-</ol>
				<ol>Email:-</ol>
				<ol>Phone:-</ol>
				<ol>Mobile:-</ol>
				<ol>Address:-</ol>
				<ol>Pincode:-</ol>
				<ol>State-</ol>
				<ol>Country:-</ol>
				<ol>Subtotal:-</ol>
				<ol>Tax:-</ol>
				<ol>Grand-Toal:-</ol>
			</ul>
		</div>
		<div class="col-md-6">
			<ul>
				<ol>{{ '1' }}</ol>	
				<ol>{{ $userOrder['txn_id'] }}</ol>	
				<ol>{{ $userOrder['payment_type'] }}</ol>	
				<ol><?php  
					$product = unserialize($userOrder['product_detail']);
					// dd($product);
					if($product){
					echo "<table class='table border' >";
					echo "<tr>";
					echo "<th>Product Image</th>";
					echo "<th>Bar-Code</th>";
					echo "<th>Product Name</th>";
					echo "<th>Quantity</th>";
					echo "<th>Price</th>";
					echo "</tr>";
					foreach($product as $pro){
					echo "<tr>";
					echo "<td>";
					?>
				{{--    {!! DNS1D::getBarcodeHTML($pro['id'], "C128",2.5,28) !!}   --}}  
				{{--    {!! QrCode::size(250)->generate($pro['id']); !!}    --}}
		{{-- 	{{   QRCode::text('QR Code Generator for Laravel!')->png()  }}	 --}}
				{{ $pro['id'] }} 
				

				
					<?php 
$productId[]=$pro['id'];

					echo "</td>";

					echo "<td>";
					echo $pro['name'];
					echo "</td>";

					echo "<td>";
					?>
					<img src="{{ asset('public/uploads/'.$pro['product_image']) }}"  alt="" width="100" height="100" />
					<?php
					echo "</td>";

					echo "<td>";
					echo $pro['qty'];
					echo "</td>";

					echo "<td>";
					echo $pro['price'];
					echo "</td>";
					echo "</tr>";
				}
				// dd($productId);
				$products = implode(',', $productId);
				?>
				<td>{!! QrCode::size(250)->generate($products ) !!}</td>
				<?php
				echo "</table>";
				}
				?></ol>	
				<ol>{{ $userOrder['name'] }}</ol>	
				<ol>{{ $userOrder['email'] }}</ol>	
				<ol>{{ $userOrder['phone'] }}</ol>	
				<ol>{{ $userOrder['mobile'] }}</ol>	
				<ol>{{ $userOrder['address'] }}</ol>	
				<ol>{{ $userOrder['pincode'] }}</ol>	
				<ol>{{ $userOrder['state'] }}</ol>	
				<ol>{{ $userOrder['country'] }}</ol>	
				<ol>{{ $userOrder['subtotal'] }}</ol>	
				<ol>{{ $userOrder['tax'] }}</ol>	
				<ol>{{ $userOrder['grandtotal'] }}</ol>	
			</ul>
		</div>
	</div>

 <script src="{{ asset('public/custom.js') }}"></script>
      <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <!-- Bootstrap 4 -->
      <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- ChartJS -->
      <script src="{{ asset('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
      <!-- Sparkline -->
      <script src="{{ asset('public/admin/plugins/sparklines/sparkline.js') }}"></script>
      <!-- JQVMap -->
     <!--  <script src="{{ asset('public/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
      <script src="{{ asset('public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
      <!-- daterangepicker -->
      <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
      <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
      <!-- Summernote -->
      <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
      <!-- overlayScrollbars -->
      <!-- <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> -->
      <!-- AdminLTE App -->
      <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="{{ asset('public/admin/dist/js/pages/dashboard.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
     
      <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
</body>
</html>