@php $contactus; @endphp
@if($contactus&&!empty($contactus))
@php $i=0; @endphp
@foreach($contactus as $data)
@php $i++; @endphp
<tr>
	<td>{{$i}}</td>
	<td>{{$data->name}}</td>
	<td>{{$data->email}}</td>
	<td>{{$data->subject}}</td>
	<td>{{$data->message}}</td>
	<td><a href="javascript:void(0)" class="btn btn-danger" onclick="deleteContactId('<?php echo url('admin/deleteContactId'); ?>','<?php echo $data->id; ?>')"><i class="fas fa-trash"></i></a></td>
</tr>
@endforeach
@endif

@php $subscribe; @endphp
@if($subscribe&&!empty($subscribe))
@php $i=0; @endphp
@foreach($subscribe as $data)
@php $i++; @endphp
<tr>
	<td>{{$i}}</td>
	<td>{{$data->email}}</td>
	<td><a href="{{url('admin/deleteSubscribeId/'.$data->id) }}" class="btn btn-danger" ><i class="fas fa-trash"></i></a></td>
</tr>
@endforeach
@endif