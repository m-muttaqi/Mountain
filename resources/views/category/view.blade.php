@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-8">
				<div class="card">
					<div class="card-header bg-info text-center">
						List Of Products
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr class="text-center">
									<th>Sl No.</th>
									<th>Category Name</th>
									<th>Menu Status</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($categories as $category)
									<tr>
										<td>{{ $loop->index+1 }}</td>
										<td>{{ $category->category_name }}</td>
										<td>{{ ($category->menu_status == 1) ? "YES":"NO" }}</td>
										<td>{{ $category->created_at->format('d-M-Y h-i-s A') }}
										<br>
										{{ $category->created_at->diffForHumans() }}
										</td>
										<td>
											<a href="{{ url('change/menu/status') }}/{{ $category->id }}" type="button" class="btn btn-info"> Change </a>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="3" class="alert alert-danger text-center">
											No Data Available
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
						{{-- {{ $products->links() }} --}}
					</div>
				</div>
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
						<form action="{{ url('add/category/insert') }}" method="post">
							@csrf
						  <div class="form-group">
						  	@if (session('categorystatus'))
						  		<div class="alert alert-success">
							  		{{ session('categorystatus') }}
							  	</div>
						  	@endif
						    <label>Category Name</label>
						    <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ old('category_name') }}">
						  </div>
						  <div class="form-group">
						  	<input type="checkbox" id="menu" name="menu_status" value="1"> <label for="meny">Use as Menu</label>
						  </div>
						  <button type="submit" class="btn btn-info">Add Category</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection