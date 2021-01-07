@extends('layouts.admin.app')
@section('title','Subscribe User List')
@section('content')
<section class="content">
		<div id="message"></div>
	<div class="container-fluid">
			@if(session::get('message'))
			<div class="alert alert-success">
				{{session::get('message')}}
			</div>	
		@endif
		<div class="row table-responsive">
			<table class="table" >
				<tr>
					<td>S.No.</td>
					<td>Email</td>
					<td>Delete</td>
				</tr>
				<tbody id="tbodySubscribe">
					@include('admin.include.contactus')					
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection