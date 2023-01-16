<div>
	<div class="header-action-icon-2">
		
		<a class="mini-cart-icon" href="{{route('shop.cart')}}">
			<img alt="Cart" src="{{asset('img/theme/icons/icon-cart.svg')}}">
			@if(Cart::instance('cart')->count() > 0)
				<span class="pro-count blue">{{Cart::instance('cart')->count()}}</span>
			@endif
		</a>
		<div class="cart-dropdown-wrap cart-dropdown-hm2">
			<ul>
				@foreach(Cart::instance('cart')->content() as $product)
					<li>
						<div class="shopping-cart-img">
							<a href="{{$product->options->slug ? route('product.details', $product->options->slug) : ''}}"><img alt="{{$product->name}}" src="{{asset('storage/'. $product->options->image)}}"></a>
						</div>
						<div class="shopping-cart-title">
							<h4 class="text-capitalize"><a href="{{$product->options->slug ? route('product.details', $product->options->slug) : ''}}">
									{{substr($product->name, 0, 20)}}
								</a></h4>
							<h3><strong>{{$product->qty}} × </strong>${{$product->price}}</h3>
						</div>
						<div class="shopping-cart-delete">
							<a href="#"><i class="fi-rs-cross-small"></i></a>
						</div>
					</li>
				@endforeach
			</ul>
			<div class="shopping-cart-footer">
				<div class="shopping-cart-total">
					<h4>Total <span>${{Cart::instance('cart')->total()}}</span></h4>
				</div>
				<div class="shopping-cart-button">
					<a href="{{route('shop.cart')}}">View Cart</a>
					<a href="shop-checkout.php">Checkout</a>
				</div>
			</div>
		</div>
	</div>
</div>
