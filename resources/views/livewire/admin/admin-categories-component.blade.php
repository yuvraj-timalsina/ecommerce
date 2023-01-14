<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> <a href="{{route('shop')}}" rel="nofollow">Shop</a>
					<span></span> All Categories
				</div>
			</div>
		</div>
		<section class="mt-50 mb-50">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col-md-6">
										All Categories
									</div>
									<div class="col-md-6">
										<a href="{{route('admin.category.add')}}" class="btn btn-success float-end">Add</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								@if(session()->has('success_message'))
									<div class="alert alert-success">
										<strong>Success | {{session()->get('success_message')}}</strong>
									</div>
								@endif
								<table class="table table-striped">
									<thead>
										<tr>
											<th>S.N.</th>
											<th>Name</th>
											<th>Slug</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($categories as $category)
											<tr>
												<td>{{$loop->iteration + $categories->firstItem() - 1}}</td>
												<td class="text-capitalize">{{$category->name}}</td>
												<td>{{$category->slug}}</td>
												<td>
													<a href="{{route('admin.category.edit', $category)}}" class="text-info">Edit</a>
													<a onclick="deleteConfirmation({{$category->id}})" href="#" class="text-danger ms-2">Delete</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{{$categories->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>
<!-- Delete Category Modal -->
<div class="modal" id="delete_confirmation">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body py-30">
				<div class="row">
					<div class="col-md-12 text-center">
						<h4 class="pb-3">Do you want to delete this record?</h4>
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete_confirmation">Cancel</button>
						<button onclick="deleteCategory()" type="button" class="btn btn-danger">Delete</button>
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
            set('category_id', id);
            $('#delete_confirmation').modal('show');
        }

        function deleteCategory() {
			@this.
            call('deleteCategory');
            $('#delete_confirmation').modal('hide');
        }
	</script>
@endpush