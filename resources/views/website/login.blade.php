@extends('layouts.website.app')

@section('content')

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div id="loginMessage"></div>
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form id="loginUser" action="{{url('loginUser')}}" method="post">
							@csrf
							<input type="email" name="email" placeholder="Enter Your Email Address" />
							<input type="password" name="password" placeholder="Enter Password" />
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span> -->
							<button type="button" onclick="loginUser()" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div id="message"></div>
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form  id = "registration" action="{{url('registration')}}" method="post">
							@csrf
							<input type="text"   name="name" placeholder="Enter Full Name"/>
							<input type="email" name="email"  placeholder="Enter Email Address"/>
							<input type="password" name="password"  placeholder="Password"/>
							<input type="text" name="phone"  placeholder="Enter Phone (optional)"/>
							<input type="text" name="mobile"  placeholder="Enter Mobile"/>
							<input type="text" name="address"  placeholder="Enter Address (optional)"/>
							<input type="text" name="pincode"  placeholder="Enter Pincode (optional)"/>
							<input type="text" name="state"  placeholder="Enter State (optional)"/>
							<input type="text" name="country"  placeholder="Enter Country (optional)"/>
							<button type="button" onclick="registration()" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

@endsection