	@if($subcategory)	
				@php $i=0; @endphp			
					@foreach($subcategory as $data)
					 @php $i++; @endphp
						<tr>
							<td>{{$i}}</td>
							<td>{{$data->name}}</td>
							<td>{{$data->category->name}}</td>
							<td>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#editSubCategoryModel" onclick="editSubCategory('<?php echo url('admin/editSubCategory'); ?>','<?php echo $data->id; ?>')" class="btn btn-warning"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0)" onclick="deleteSubCategory('<?php echo url('admin/deleteSubCategory'); ?>','<?php echo $data->id;  ?>')" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
							</td>

						</tr>
					@endforeach
				@endif