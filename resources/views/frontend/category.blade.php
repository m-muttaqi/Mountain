@extends('layouts/frontend_app')

@section('frontend_content')

	<!-- Page Info -->
	<div class="page-info-section page-info-big">
		<div class="container">
			<h2>Dresses</h2>
			<div class="site-breadcrumb">
				<a href="">Home</a> / 
				<span>Dresses</span>
			</div>
			<img src="{{ asset('frontend_assets/img/categorie-page-top.png') }}" alt="" class="cata-top-pic">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area categorie-page spad">
		<div class="container">
			<div class="categorie-filter-warp">
				<p>Showing 12 results</p>
				<div class="cf-right">
					<div class="cf-layouts">
						<a href="#"><img src="{{ asset('frontend_assets/img/icons/layout-1.png') }}" alt=""></a>
						<a class="active" href="#"><img src="{{ asset('img/icons/layout-2.png') }}" alt=""></a>
					</div>
					<form action="#">
						<select>
							<option>Color</option>
						</select>
						<select>
							<option>Brand</option>
						</select>
						<select>
							<option>Sort by</option>
						</select>
					</form>
				</div>
			</div>
			<div class="row">
				@forelse ($products as $product)
					<div class="col-lg-3">
						<div class="product-item">
							<figure>
								<img src="{{ asset('uploads/product_photos') }}/{{ $product->product_image }}" alt="">
								<div class="pi-meta">
									<div class="pi-m-left">
										<img src="{{ asset('frontend_assets/img/icons/eye.png') }}" alt="">
										<p>quick view</p>
									</div>
									<div class="pi-m-right">
										<img src="{{ asset('frontend_assets/img/icons/heart.png') }}" alt="">
										<p>save</p>
									</div>
								</div>
							</figure>
							<div class="product-info">
								<h6>{{ $product->product_name }}</h6>
								<p>${{ $product->product_price }}</p>
								<a href="#" class="site-btn btn-line">ADD TO CART</a>
							</div>
						</div>
					</div>
					@empty
					<div class="alert alert-danger m-auto">
						No product found in this category
					</div>
				@endforelse
			</div>
		</div>
	</div>
	<!-- Page -->
@endsection