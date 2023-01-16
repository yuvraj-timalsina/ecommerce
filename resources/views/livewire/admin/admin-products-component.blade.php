<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> <a href="{{route('shop')}}" rel="nofollow">Shop</a>
					<span></span> All Products
				</div>
			</div>
		</div>
		<section class="mt-50 mb-50">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<div class="row d-flex">
									<div class="col-6">
										<h4 class="text-muted pt-3">All Products</h4>
									</div>
									<div class="col-6">
										<a href="{{route('admin.product.add')}}" class="btn btn-success float-end">Add</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								@if(session()->has('success_message'))
									<div class="alert alert-success">
										<strong>Success | {{session()->get('success_message')}}</strong>
									</div>
								@endif
								@if($products->count() > 0)
									<table class="table table-striped">
									<thead>
										<tr>
											<th>S.N.</th>
											<th>Image</th>
											<th>Name</th>
											<th>Stock</th>
											<th>Price</th>
											<th>Category</th>
											<th>Added On</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($products as $product)
											<tr>
												<td>{{$loop->iteration + $products->firstItem() - 1}}</td>
												<td><img src="{{asset('storage/'. $product->image)}}" alt="{{$product->name}}" width="50"/></td>
												<td class="text-capitalize">{{$product->name}}</td>
												<td>{{ucwords(str_replace('_', ' ', $product->stock_status))}}</td>
												<td>{{$product->regular_price}}</td>
												<td>{{ucwords($product->category->name)}}</td>
												<td>{{$product->created_at->format('d M Y')}}</td>
												<td>
													<a href="{{route('admin.product.edit', $product)}}" class="text-info">Edit</a>
													<a onclick="deleteConfirmation({{$product->id}})" href="#" class="text-danger">Delete</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
									@else
									<strong>No Products Found!</strong>
								@endif
								
								{{$products->links('vendor.pagination.custom')}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>
<!-- Delete Product Modal -->
<div class="modal" id="delete_confirmation">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body py-30">
				<div class="row">
					<div class="col-md-12 text-center">
						<h4 class="pb-3">Do you want to delete this record?</h4>
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete_confirmation">Cancel</button>
						<button onclick="deleteProduct()" type="button" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@push('scripts')
	<script>
        function deleteConfirmation(id) {
			@this.
            set('product_id', id);
            $('#delete_confirmation').modal('show');
        }

        function deleteProduct() {
			@this.
            call('deleteProduct');
            $('#delete_confirmation').modal('hide');
        }
	</script>
@endpush