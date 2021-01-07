@extends('layouts.website.app')

@section('content')

<section ><!--form-->
		<div class="container   ">
			<div class="row mb-5">
				
				<div class="col-sm-3"></div>
				<div class="col-sm-6 ">
					
					<div class="signup-form" ><!--sign up form-->
						<h1 class="text-center">User Profile</h1>
						<form class="text-center d-flex justify-content-center"  action="{{url('registration')}}" method="post">
							@csrf
							<div class="form-group">

							<input type="text" value="{{$userDetail->name}}" class="form-control" name="name" placeholder="Name" readonly/>
						</div>
						<div class="form-group">
							<input type="email" value="{{$userDetail->email}}" class="form-control" name="email"  placeholder="Email Address" readonly/>
						</div>

						<div class="form-group">
							<input type="text" value="{{$userDetail->phone}}" class="form-control" name="phone"  placeholder="Phone Number" readonly/>
						</div>

						<div class="form-group">
							<input type="text" value="{{$userDetail->mobile}}" class="form-control" name="mobile"  placeholder="Enter Mobile Number" readonly/>
						</div>

						<div class="form-group">
							<input type="text" value="{{$userDetail->address}}" class="form-control" name="address"  placeholder="Enter Address" readonly/>
						</div>

						<div class="form-group">
							<input type="text" value="{{$userDetail->pincode}}" class="form-control" name="pincode"  placeholder="Enter Pincode" readonly/>
						</div>

						<div class="form-group">
							<input type="text" value="{{$userDetail->state}}" class="form-control" name="state"  placeholder="Enter State" readonly/>
						</div>

						<div class="form-group">
							<input type="text" value="{{$userDetail->country}}" class="form-control" name="country"  placeholder="Enter Country" readonly/>
						</div>
							
						</form>
					</div><!--/sign up form-->
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</section><!--/form-->

@endsection