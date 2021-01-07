<h2 class="title text-center">Features Items</h2>
		@if(sizeof($product) !=0)
		@foreach($product as $p)
							<div class="col-sm-4 mx-auto" >
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ asset('public/uploads/'.$p->image) }}" alt="" height="200" width="200" />
											<h2>${{$p->price}}</h2>
											<p>{{$p->name}}</p>
											<a href="#" onclick="viewproduct('<?php echo url('ViewProduct') ?>','<?php echo $p->id; ?>')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Product</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>${{$p->price}}</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#"  onclick="viewproduct('<?php echo url('ViewProduct') ?>','<?php echo $p->id; ?>')"class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Product</a>
											</div>
										</div>
								</div>
								<!-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div> -->
							</div>
						    </div>
		@endforeach
		@else
		<br><br><br><br><br><br><br><br><br>
		<div class="row">
			<div class="col-md-12">
				<h1 class=" mt-5 text-center text-danger">No Record Found</h1>
			</div>
		</div>	
		<br><br><br><br><br><br><br><br><br><br>
		
		@endif
