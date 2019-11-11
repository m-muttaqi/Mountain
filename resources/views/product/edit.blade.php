@extends('layouts/app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-8 offset-2">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
					    <li class="breadcrumb-item"><a href="{{ url('add/product/view') }}">Product List</a></li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $single_product_info->product_name }}</li>
					  </ol>
					</nav>
				<div class="card">
					<div class="card-header bg-dark text-center text-white">
						Edit Product
					</div>
					<div class="card-body">
						<form action="{{ url('edit/product/insert') }}" method="post" enctype="multipart/form-data">
							@csrf
						  <div class="form-group">
						  	@if (session('editstatus'))
						  		<div class="alert alert-success">
							  		{{ session('editstatus') }}
							  	</div>
						  	@endif
						    <label>Product Name</label>
						    <input type="hidden" name="product_id" value="{{ $single_product_info->id }}">
						    <input type="text" class="form-control" placeholder="Enter Your Product Name" name="product_name" value="{{ $single_product_info->product_name }}">
						  </div>
						  <div class="form-group">
						    <label>Product Description</label>
						    <textarea name="product_description" class="form-control" placeholder="Enter Product Description">{{ $single_product_info->product_description }}</textarea>
						  </div>
						  <div class="form-group">
						    <label>Product Price</label>
						    <input type="number" class="form-control" placeholder="Enter Product Price" name="product_price"  value="{{ $single_product_info->product_price }}">
						  </div>
						  <div class="form-group">
						    <label>Product Quantity</label>
						    <input type="number" class="form-control" placeholder="Enter Product Quantity" name="product_quantity" value="{{ $single_product_info->product_quantity }}">
						  </div>
						  <div class="form-group">
						    <label>Alert Quantity</label>
						    <input type="number" class="form-control" placeholder="Enter Alert Quantity" name="alert_quantity" value="{{ $single_product_info->alert_quantity }}">
						  </div>
						  <div class="form-group">
						    <label>Product Image</label>
						    <input type="file" class="form-control" name="product_image">
						  </div>
						  <img src="{{ asset('uploads/product_photos') }}/{{ $single_product_info->product_image }}" alt="Not Found" width="150">
						  <button type="submit" class="btn btn-warning">Edit Product</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection