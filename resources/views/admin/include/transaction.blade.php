@if(!empty($orders))
@php $i=0; @endphp
@foreach($orders as $order)
@php $i++; @endphp
<tr>
	<td>{{$i}}</td>
	<td>{{ $order->txn_id }}</td>
	<td>{{ $order->payment_type }}</td>
	<td>{{ $order->name }}</td>
 	<td>{{ $order->email }}</td>
	<td>{{ $order->subtotal }}</td>
	<td>{{ $order->tax }}</td>
	<td>{{ $order->grandtotal }}</td>
	<td><a href="{{url('admin/downloadOrder/'.$order->id)}}" onclick="downloadOrder('<?php echo url('admin/downloadOrder'); ?>','<?php echo $order->id;  ?>')" class="btn btn-info btn-sm" ><i class="fas fa-download"></i></a>|<a onclick="prodcutDetail('<?php echo url('admin/transactionProductDetail');  ?>','<?php echo $order->id; ?>')" href="javascript:void(0)" data-toggle="modal" data-target="#productDetail" class="btn btn-warning btn-sm" id="productButton" ><i class="fab fa-product-hunt"></i></a>|<a href="javascript:void(0)"  onclick="transactionUserDetail('<?php echo url('admin/transactionUserDetail');  ?>','<?php echo $order->id; ?>')"   data-toggle="modal" data-target="#userDetail" class="btn btn-success btn-sm" ><i class="fas fa-user"></i></a>|<a href="javascript:void(0)" onclick="deleteOrder('<?php echo url('admin/deleteOrder'); ?>','<?php echo $order->id;  ?>')" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i></a></td>
</tr>
@endforeach

@endif

 
