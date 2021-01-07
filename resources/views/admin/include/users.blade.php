@if(!empty($users))
@php $i=0; @endphp
@foreach($users as $userData)
@php $i++; @endphp
<tr>
	<td>{{$i}}</td>
	<td>{{ $userData->name }}</td>
	<td>{{ $userData->email }}</td>
	<td>{{ $userData->phone }}</td>
	<td>{{ $userData->mobile }}</td>
	<td>{{ $userData->address }}</td>
	<td>{{ $userData->pincode }}</td>
	<td>{{ $userData->state }}</td>
	<td>{{ $userData->country }}</td>
	<td>@if($userData->status == 1) <button onclick="editUserStatus('<?php  echo $userData->id; ?>','<?php echo 0; ?>','<?php echo url('admin/editUserStatus'); ?>')" class="btn btn-danger btn-sm">Deactive</button>  @else <button onclick="editUserStatus('<?php  echo $userData->id; ?>','<?php echo 1; ?>','<?php echo url('admin/editUserStatus'); ?>')"  class="btn btn-success btn-sm">Active</button>    @endif</td>
	
</tr>

@endforeach
@endif