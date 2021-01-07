@extends('layouts.website.app')

@section('content')

<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row mb-5">    		
	    		<div class="col-sm-12 ">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
					 <!-- <div id="gmap" class="contact-map">  -->
					
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.737862997205!2d75.87353065005283!3d22.700800333901675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962fce00db324a7%3A0xe0bfa4e3457de59c!2sYuvasoft%20Solutions%20Private%20Limited!5e0!3m2!1sen!2sin!4v1606473754416!5m2!1sen!2sin" width="1100" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>	
				<br><br><br><br><br><br>  	
			</div>
			  	
    		<div class="row mt-5">  
	    		<div class="col-sm-8">
	    		<div id="message" style="display: none;"></div>		
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="contactForm" action="{{ url('SubmitContact') }}"  method="post">@csrf
				            <div class="form-group col-md-6">
				                <input type="text" name="name" value="" class="form-control" required="required" placeholder="Name" >
				            </div>				         
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" value="" required="required" placeholder="Email" >
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" value="" required="required" placeholder="Subject" >
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message"value=""  id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here" ></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="button" onclick="SubmitContact()" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->

@endsection    