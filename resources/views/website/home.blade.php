@extends('layouts.website.app')
	

@section('content')	
	<section id="slider" class="MainSection"><!--slider-->
		<div class="container" id="">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('public/website/images/home/girl1.jpg') }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('public/website/images/home/pricing.png') }}"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('public/website/images/home/girl2.jpg') }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('public/website/images/home/pricing.png') }}"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('public/website/images/home/girl3.jpg') }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('public/website/images/home/pricing.png') }}" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section >
		<div class="container" id="MainSection">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#" onclick="seachBySubcategory('<?php echo 'null'; ?>','<?php echo url('/'); ?>')" >All</a></h4>
								</div>
							</div>
		@if($category)
		@foreach($category as $c)					
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{$c->name}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$c->name}}
										</a>
									</h4>
								</div>
								<div id="{{$c->name}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach($c->subcategory as $sub_category)
											<li><a href="#"  onclick="seachBySubcategory('<?php echo $sub_category->id; ?>','<?php echo url('/'); ?>')">{{$sub_category->name}} </a></li>
											
											@endforeach
										</ul>
									</div>
								</div>
							</div>
			@endforeach
			@endif

	
							
							
							
						</div><!--/category-products-->
					
						<div class="price-range bg-warning "  ><!--price-range-->
							
							<div class="row">
							<h2>Price Range</h2>
							<select style="width: 90%" class="form-control " name="priceRange" id="priceRange" action="{{url('priceRange') }}">
								<option value="0-0"  selected="">Select price who you want </option>
								<option value="0-500" >0-500</option>
								<option value="500-2000" >500-2000</option>
								<option value="2000-5000" >2000-5000</option>
								<option value="5000-15000" >5000-15000</option>
								<option value="15000-30000" >15000-30000</option>
								<option value="30000-50000" >30000-50000</option>
								<option value="50000-100000" >50000-100000</option>
								<option value="100000-500000" >100000-500000</option>
							</select>
						</div>
						</div><!--/price-range-->
						<br>





						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						



						<div class="shipping text-center"><!--shipping-->
							<img src="{{ asset('public/website/images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->
					</div>
				</div>
				
				<div class="col-sm-2 pull-right">
						<div class="search_box ">
							 <input id="searchProduct" onkeydown="searchProduct('<?php echo url('searchProduct'); ?>')" type="text" placeholder="Search Product"/>
						</div>
					</div>

					
				<div class="col-sm-9 padding-right position-fixed" id="AllProduct">
					<div class="features_items" id="productBySubcategory"><!--features_items-->
				<div class="row">		
			@include('website.include.product')	
				</div>
					</div><!--features_items-->
					<div class="row" >
				<div class="col-sm-2"></div> 
				<div class="col-sm-6">
					{{ $product->links()  }}	
				</div> 
			
			</div>
					<div class="row">
					<div class="category-tab position-fixed"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
				<li class="active"><a href="#all" data-toggle="tab">All</a></li>
				@php $i=0; @endphp				
								@foreach($mainCategoryByProduct as $mainCategory)
								@php $i++; @endphp
								<li><a href="#{{strtolower($mainCategory->name)}}" data-toggle="tab">{{$mainCategory->name}}</a></li>
								@endforeach								
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="all" >
							@foreach($product as $p)
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{ asset('public/uploads/'.$p->image) }}" alt="" height="200" width="200" />
												<h2>${{$p->price}}</h2>
												<p>{{$p->name}}</p>
												<a href="#"  onclick="viewproduct('<?php echo url('ViewProduct') ?>','<?php echo $p->id; ?>')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							
								</div>

								@foreach($mainCategoryByProduct as $mainCategory)
							<div class="tab-pane fade " id="{{strtolower($mainCategory->name)}}" >
								@foreach($mainCategory->product as $product)
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{ asset('public/uploads/'.$product->image) }}" alt="" width="80" height="80" />
												<h2>${{$product->price}}</h2>
												<p>{{$product->name}}</p>
												<a href="#"  onclick="viewproduct('<?php echo url('ViewProduct') ?>','<?php echo $product->id; ?>')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							</div>
							@endforeach


							
						</div>
					</div><!--/category-tab-->
					</div>
				
					
				</div>
			</div>
		</div>
	</section>


<script type="text/javascript">
	$(document).ready(function(){
	$('#priceRange').on('change', function(){ 
		var range = $(this).val();
		var url = $('#priceRange').attr('action');
		// console.log(range);
		if(range)
		{
			$.ajax({
				url:url,
				type:'get',
				data:
				{
					range:range
				},
				success:function(data)
				{
					if(data)
					{
						$('#productBySubcategory').empty();
						$('#productBySubcategory').html(data.html);
					}
				}

			});
		}

	});
	});
</script>

@endsection

	
	