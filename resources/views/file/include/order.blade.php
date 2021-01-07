@if($userOrder)

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

@endif  