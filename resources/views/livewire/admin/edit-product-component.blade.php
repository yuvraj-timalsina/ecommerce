<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> <a href="{{route('shop')}}" rel="nofollow">Shop</a>
					<span></span> Edit Product
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
										<h4 class="text-muted pt-3">Edit Product</h4>
									</div>
									<div class="col-6">
										<a href="{{route('admin.products')}}" class="btn btn-success float-end">All Products</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								@if(session()->has('success_message'))
									<div class="alert alert-success">
										<strong>Success | {{session()->get('success_message')}}</strong>
									</div>
								@endif
								<form wire:submit.prevent="updateProduct">
									@if ($new_image)
										<img src="{{ $new_image->temporaryUrl() }}" alt="" width="225">
									@else
										<img src="{{asset('storage/'. $this->image)}}" alt="" width="225">
									@endif
									<div class="mb-3">
										<label for="image" class="form-label">Image</label>
										<input wire:model="new_image" name="new_image" type="file" id="image" class="form-control">
										@error('new_image') <span class="text-danger">{{ $message }}</span> @enderror
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
									<div class="form-floating my-3">
										<textarea wire:model="short_description" name="short_description" id="short_description" class="form-control" placeholder="Short Description"></textarea>
										<label for="short_description" class="form-label">Short Description</label>
										@error('short_description') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-floating my-3">
										<textarea wire:model="description" name="description" id="description" class="form-control" placeholder="Description"></textarea>
										<label for="description" class="form-label">Description</label>
										@error('description') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<div class="form-floating">
												<input wire:model="regular_price" name="regular_price" type="text" id="regular_price" class="form-control" placeholder="Regular Price">
												<label for="regular_price">Regular Price</label>
												@error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-floating">
												<input wire:model="sale_price" name="sale_price" type="text" id="sale_price" class="form-control" placeholder="Sale Price">
												<label for="sale_price">Sale Price</label>
												@error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-floating">
												<input wire:model="sku" name="sku" type="text" id="sku" class="form-control" placeholder="SKU">
												<label for="sku">SKU</label>
												@error('sku') <span class="text-danger">{{ $message }}</span> @enderror
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label for="stock_status" class="form-label">Stock Status</label>
											<select wire:model="stock_status" id="stock_status" class="form-select">
												<option value="in_stock">In Stock</option>
												<option value="out_of_stock">Out Of Stock</option>
											</select>
											@error('stock_status') <span class="text-danger">{{ $message }}</span> @enderror
										</div>
										<div class="col-md-4">
											<label for="featured" class="form-label">Is Featured</label>
											<select wire:model="featured" name="featured" id="featured" class="form-select">
												<option value="0">No</option>
												<option value="1">Yes</option>
											</select>
											@error('featured') <span class="text-danger">{{ $message }}</span> @enderror
										</div>
										<div class="col-md-4">
											<label for="quantity" class="form-label">Quantity</label>
											<input wire:model="quantity" name="quantity" type="number" id="quantity" class="form-control" placeholder="10">
											@error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
										</div>
									</div>
									<div class="mb-3">
										<select wire:model="category_id" name="category_id" id="category_id" class="form-select">
											<option hidden>Select Product Category</option>
											@foreach($categories as $category)
												<option value="{{$category->id}}">{{$category->name}}</option>
											@endforeach
										</select>
										@error('category') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<button type="submit" class="btn btn-primary float-end">Update</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>