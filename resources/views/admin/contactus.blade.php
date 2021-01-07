@extends('layouts.admin.app')
@section('title','ContactUs')
@section('content')
<section class="content">
		<div id="message"></div>
	<div class="container-fluid">
		<div class="row">
		
			<table class="table">
				<tr>
					<td>S.No.</td>
					<td>Name</td>
					<td>Email</td>
					<td>Subject</td>
					<td>Message</td>
					<td>Delete</td>
				</tr>
				<tbody id="tbodyContact">
					@include('admin.include.contactus')					
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection