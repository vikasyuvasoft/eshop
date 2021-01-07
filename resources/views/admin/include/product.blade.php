@if($product)	
				@php $i=0; @endphp			
					@foreach($product as $data)
					 @php $i++; @endphp
						<tr>
							<td>{{$i}}</td>
							<td><img src="{{asset('public/uploads/'.$data->image) }}" width="50" height="50"></td>
							<td>{{$data->name}}</td>
							<td>{{$data->title}}</td>
							<td>{{$data->description}}</td>
							<td>
								@if($data->subcategory) {{$data->subcategory->name}} <b> ({{$data->subcategory->category->name}})</b> @endif 
							</td>
							<td>{{$data->price}}</td>
							<td>
								<a data-toggle="modal"  onclick="editProduct('<?php echo url('admin/editProduct');  ?>','<?php echo $data->id; ?>')" href="javascript:void(0)" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
								<a href="javascript:void(0)" onclick="deleteProduct('<?php echo url('admin/deleteProduct');  ?>','<?php echo $data->id;  ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
							</td>

						</tr>
					@endforeach					
				@endif