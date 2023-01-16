<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> <a href="{{route('shop')}}" rel="nofollow">Shop</a>
					<span></span> Add New Category
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
										<h4 class="text-muted pt-3">New Category</h4>
									</div>
									<div class="col-6">
										<a href="{{route('admin.categories')}}" class="btn btn-success float-end">All Categories</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<form wire:submit.prevent="storeCategory">
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
												<input wire:model="name" wire:keyup="generateSlug" name="name" type="text" id="name" class="form-control" placeholder="Name">
												<label for="name">Name</label>
												@error('name') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-floating">
												<input wire:model="slug" name="slug" type="text" id="slug" class="form-control" placeholder="Slug" readonly>
												<label for="slug" class="form-label">Slug</label>
												@error('slug') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label for="is_popular" class="form-label">Is Popular</label>
											<select wire:model="is_popular" name="is_popular" id="is_popular" class="form-select">
												<option value="0">No</option>
												<option value="1">Yes</option>
											</select>
											@error('is_popular') <span class="text-danger">{{ $message }}</span> @enderror
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