<div>
	<main class="main">
		<div class="page-header breadcrumb-wrap">
			<div class="container">
				<div class="breadcrumb">
					<a href="{{route('home')}}" rel="nofollow">Home</a>
					<span></span> Wishlist
				</div>
			</div>
		</div>
		<section class="mt-50 mb-50">
			<div class="container">
				<div class="row product-grid-4">
					@if(Cart::instance('wishlist')->count() > 0)
					@foreach(Cart::instance('wishlist')->content() as $item)
						<div class="col-lg-3 col-md-3 col-6 col-sm-6">
							<div class="product-cart-wrap mb-30">
								<div class="product-img-action-wrap">
									<div class="product-img product-img-zoom">
										<a href="{{$item->options->slug ? route('product.details', $item->options->slug) : ''}}">
											<img class="default-img" src="{{asset('img/shop/product')}}-{{$item->id}}-1.jpg" alt="{{$item->name}}">
											<img class="hover-img" src="{{asset('img/shop/product')}}-{{$item->id}}-2.jpg" alt="{{$item->name}}">
										</a>
									</div>
									<div class="product-action-1">
										<a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
											<i class="fi-rs-search"></i></a>
										<a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
										<a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
									</div>
									<div class="product-badges product-badges-position product-badges-mrg">
										<span class="hot">Hot</span>
									</div>
								</div>
								<div class="product-content-wrap">
									<div class="product-category">
										<a href="shop.html">Music</a>
									</div>
									<h2 class="text-capitalize"><a href="{{$item->options->slug ? route('product.details', $item->options->slug) : ''}}">
											{{$item->name}}
										</a></h2>
									<div class="rating-result" title="90%">
										<span>
											<span>90%</span>
										</span>
									</div>
									<div class="product-price">
										<span>
											${{$item->price}}
										</span>
										{{--                                            <span class="old-price">$245.8</span>--}}
									</div>
									<div class="product-action-1 show">
										<a wire:click.prevent="removeFromWishlist({{$item->id}})" aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#"><i class="fi-rs-heart"></i></a>
{{--																						<a aria-label="Add To Cart" class="action-btn hover-up" href="#" wire:click.prevent="store({{$item->id}}, '{{$item->name}}', {{$item->regular_price}})"><i class="fi-rs-shopping-bag-add"></i></a>--}}
									</div>
								</div>
							</div>
						</div>
					@endforeach
					@else
						<strong>No Items In Wishlist!</strong>
					@endif
				</div>
			</div>
		</section>
	</main>
</div>