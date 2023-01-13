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
												<td></td>
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