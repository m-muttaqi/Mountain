@extends('layouts.app')

@section('content')

	<div class="">
		<div class="row">
			<div class="col-8">
				<div class="card">
					<div class="card-header bg-info text-center">
						List Of Products
					</div>
					<div class="card-body">
						@if (session('deletestatus'))
							<div class="alert alert-danger">
								{{ session('deletestatus') }}
							</div>
						@endif
						<table class="table table-bordered">
							<thead>
								<tr class="text-center">
									<th>Sl No.</th>
									<th>Category Name</th>
									<th>Product Name</th>
									<th>Product Description</th>
									<th>Product Price</th>
									<th>Product Quantity</th>
									<th>Alert Quantity</th>
									<th>Image</th>
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($products as $product)
									<tr>
										<td>{{ $loop->index+1 }}</td>
										{{-- <td>{{ App\Category::find($product->id)->category_name }}</td> --}}
										<td>{{ $product->relationtocategory->category_name }}</td>
										<td>{{ $product->product_name }}</td>
										<td>{{ Str::limit($product->product_description, 30) }}</td>
										<td>{{ $product->product_price }}</td>
										<td>{{ $product->product_quantity }}</td>
										<td>{{ $product->alert_quantity }}</td>
										<td>
											<img src="{{ asset('uploads/product_photos') }}/{{ $product->product_image }}" alt="" width="50">
										</td>
										<td>
											<img src="" alt="">
										</td>
										<td>
											<a href="{{ url('edit/product') }}/{{ $product->id }}" class="btn btn-sm btn-info">Edit</a>
										</td>
										<td>
											<a href="{{ url('delete/product') }}/{{ $product->id }}" class="btn btn-sm btn-danger">Delete</a>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="8" class="alert alert-danger text-center">
											No Data Available
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
						{{ $products->links() }}
					</div>
				</div>
				@if ($deleted_products->all())
					<div class="card mt-3">
						<div class="card-header bg-danger text-white text-center">
							Deleted Products
						</div>
						<div class="card-body">
							@if (session('restorestatus'))
								<div class="alert alert-success">
									{{ session('restorestatus') }}
								</div>
							@endif
							@if (session('removestatus'))
								<div class="alert alert-danger">
									{{ session('removestatus') }}
								</div>
							@endif
							<table class="table table-bordered">
								<thead>
									<tr class="text-center">
										<th>Sl No.</th>
										<th>Product Name</th>
										<th>Product Description</th>
										<th>Product Price</th>
										<th>Product Quantity</th>
										<th>Alert Quantity</th>
										<th>Product Image</th>
										<th colspan="2">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($deleted_products as $deleted_product)
										<tr>
											<td>{{ $loop->index+1 }}</td>
											<td>{{ $deleted_product->product_name }}</td>
											<td>{{ Str::limit($deleted_product->product_description, 30) }}</td>
											<td>{{ $deleted_product->product_price }}</td>
											<td>{{ $deleted_product->product_quantity }}</td>
											<td>{{ $deleted_product->alert_quantity }}</td>
											<td>
												<img src="{{ asset('uploads/product_photos') }}/{{ $deleted_product->product_image }}" alt="Not Found" width="50">
											</td>
											<td>
												<a href="{{ url('restore/product') }}/{{ $deleted_product->id }}" class="btn btn-sm btn-success">Restore</a>
											</td>
											<td>
												<a href="{{ url('force/delete/product') }}/{{ $deleted_product->id }}" class="btn btn-sm btn-danger">Remove</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							{{ $products->links() }}
						</div>
					</div>
				@endif
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header bg-dark text-center text-white">
						Add Product
					</div>
					<div class="card-body">
						@if ($errors->all())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									<li style="color: red"> {{ $error }} </li>
								@endforeach
							</div>
						@endif
						<form action="{{ url('add/product/insert') }}" method="post" enctype="multipart/form-data">
							@csrf
							  <div class="form-group">
							  	@if (session('status'))
							  		<div class="alert alert-success">
								  		{{ session('status') }}
								  	</div>
							  	@endif
							    <label>Category Name</label>
							    <select name="category_id" class="form-control">
								    <option value="">--Select One--</option>
								    @foreach ($categories as $category)
								    	<option value="{{ $category->id }}">{{ $category->category_name }}</option>
								    @endforeach
							    </select>
							  </div>
							  <div>
							  <label>Product Name</label>
							    <input type="text" class="form-control" placeholder="Enter Your Product Name" name="product_name" value="{{ old('product_name') }}">
							  </div>
							  <div class="form-group">
							    <label>Product Description</label>
							    <textarea name="product_description" class="form-control" placeholder="Enter Product Description">{{ old('product_description') }}</textarea>
							  </div>
							  <div class="form-group">
							    <label>Product Price</label>
							    <input type="number" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{ old('product_price') }}">
							  </div>
							  <div class="form-group">
							    <label>Product Quantity</label>
							    <input type="number" class="form-control" placeholder="Enter Product Quantity" name="product_quantity" value="{{ old('product_quantity') }}">
							  </div>
							  <div class="form-group">
							    <label>Alert Quantity</label>
							    <input type="number" class="form-control" placeholder="Enter Alert Quantity" name="alert_quantity" value="{{ old('alert_quantity') }}">
							  </div>
							  <div class="form-group">
							    <label>Product Image</label>
							    <input type="file" class="form-control" name="product_image">
							  </div>
							  <button type="submit" class="btn btn-info">Add Product</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection