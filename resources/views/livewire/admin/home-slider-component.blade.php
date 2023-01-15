<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> <a href="{{route('shop')}}" rel="nofollow">Shop</a>
					<span></span> All Slides
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
										<h4 class="text-muted pt-3">All Slides</h4>
									</div>
									<div class="col-6">
										<a href="{{route('admin.slide.add')}}" class="btn btn-success float-end">Add</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								@if(session()->has('success_message'))
									<div class="alert alert-success">
										<strong>Success | {{session()->get('success_message')}}</strong>
									</div>
								@endif
								@if($slides->count() > 0)
									<table class="table table-striped">
									<thead>
										<tr>
											<th>S.N.</th>
											<th>Image</th>
											<th>Top Title</th>
											<th>Title</th>
											<th>Sub Title</th>
											<th>Offer</th>
											<th>Link</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($slides as $slide)
											<tr>
												<td>{{$loop->iteration}}</td>
												<td><img src="{{asset('storage/'. $slide->image)}}" alt="{{$slide->name}}" width="50"/></td>
												<td>{{$slide->top_title}}</td>
												<td>{{$slide->title}}</td>
												<td>{{$slide->sub_title}}</td>
												<td>{{$slide->offer}}</td>
												<td>{{$slide->link}}</td>
												<td>{{$slide->status === 1 ? 'Active' : 'Inactive'}}</td>
												<td>
													<a href="{{route('admin.slide.edit', $slide)}}" class="text-info">Edit</a>
													<a onclick="deleteConfirmation({{$slide->id}})" href="#" class="text-danger ms-2">Delete</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
									@else
									<strong>No Slides Found!</strong>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>
<!-- Delete Slide Modal -->
<div class="modal" id="delete_confirmation">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body py-30">
				<div class="row">
					<div class="col-md-12 text-center">
						<h4 class="pb-3">Do you want to delete this record?</h4>
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete_confirmation">Cancel</button>
						<button onclick="deleteSlide()" type="button" class="btn btn-danger">Delete</button>
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
            set('slide_id', id);
            $('#delete_confirmation').modal('show');
        }

        function deleteSlide() {
			@this.
            call('deleteSlide');
            $('#delete_confirmation').modal('hide');
        }
	</script>
@endpush