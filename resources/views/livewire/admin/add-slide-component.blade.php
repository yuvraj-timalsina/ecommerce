<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> Add New Slide
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
										<h4 class="text-muted pt-3">New Slide</h4>
									</div>
									<div class="col-6">
										<a href="{{route('admin.slider')}}" class="btn btn-success float-end">All Slides</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<form wire:submit.prevent="storeSlide">
																		@if ($image)
																			<img src="{{ $image->temporaryUrl() }}" alt="" width="225">
																		@endif
									<div class="mb-3">
										<label for="image" class="form-label">Image</label>
										<input wire:model="image" name="image" type="file" id="image" class="form-control" placeholder="Image">
										@error('image') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="row mb-3">
										<div class="col-md-6">
											<div class="form-floating">
												<input wire:model="top_title" name="top_title" type="text" id="top_title" class="form-control" placeholder="Top Title">
												<label for="top_title">Top Title</label>
												@error('top_title') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-floating">
												<input wire:model="title" name="title" type="text" id="title" class="form-control" placeholder="Title">
												<label for="title" class="form-label">Title</label>
												@error('title') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
									</div>
									<div class="form-floating my-3">
										<input wire:model="sub_title" name="sub_title" type="text" id="sub_title" class="form-control" placeholder="Sub Title">
										<label for="sub_title" class="form-label">Sub Title</label>
										@error('sub_title') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="row mb-3">
										<div class="col-md-6">
											<div class="form-floating">
												<input wire:model="offer" name="offer" type="text" id="offer" class="form-control" placeholder="Offer">
												<label for="offer" class="form-label">Offer</label>
												@error('offer') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-floating">
												<input wire:model="link" name="link" type="url" id="link" class="form-control" placeholder="Link">
												<label for="link">Link</label>
												@error('link') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label for="status" class="form-label">Status</label>
											<select wire:model="status" name="status" id="status" class="form-select">
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
											@error('status') <span class="text-danger">{{ $message }}</span> @enderror
										</div>
									</div>
									<button type="submit" class="btn btn-primary float-end">Save</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>