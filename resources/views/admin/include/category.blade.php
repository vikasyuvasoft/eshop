@if($category)	
				@php $i=0; @endphp			
					@foreach($category as $data)
					 @php $i++; @endphp
						<tr>
							<td>{{$i}}</td>
							<td>{{$data->name}}</td>
							<!-- <td> -->
						{{--	@foreach($data->subcategory as $sub)
							{{$sub->name}}<br> 
							@endforeach  --}}
							<!-- </td> -->
							<td>
							<a  data-toggle="modal" data-target="#editcategory" onclick="editCategory('<?php echo url('admin/editCategory');  ?>','<?php echo $data->id; ?>')"  class="btn  btn-sm btn-warning" href="javascript:void(0)"><i class="fas fa-edit"></i></a>|<a   onclick="deleteCategory('<?php echo url('admin/deleteCategory'); ?>','<?php echo $data->id; ?>')" class="btn btn-sm btn-danger" href="javascript:void(0)"><i class="fas fa-trash-alt"></i>	</a>
							</td>
						</tr>
					@endforeach


				@endif


