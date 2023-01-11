<div>
	<div class="header-action-icon-2">
		@if(Cart::count() > 0)
			<a class="mini-cart-icon" href="{{route('shop.cart')}}">
										<img alt="Cart" src="{{asset('img/theme/icons/icon-cart.svg')}}">
										<span class="pro-count blue">{{Cart::count()}}</span>
									</a>
		@endif
		<div class="cart-dropdown-wrap cart-dropdown-hm2">
			<ul>
				@foreach(Cart::content() as $item)
					<li>
					<div class="shopping-cart-img">
						<a href="#"><img alt="{{$item->name}}" src="{{asset('img/shop/product')}}-{{$item->id}}-1.jpg"></a>
					</div>
					<div class="shopping-cart-title">
						<h4><a href="#">
								{{substr($item->name, 0, 20)}}
							</a></h4>
						<h3><span>{{$item->qty}} × </span>${{$item->price}}</h3>
					</div>
					<div class="shopping-cart-delete">
						<a href="#"><i class="fi-rs-cross-small"></i></a>
					</div>
				</li>
				@endforeach
			</ul>
			<div class="shopping-cart-footer">
				<div class="shopping-cart-total">
					<h4>Total <span>${{Cart::total()}}</span></h4>
				</div>
				<div class="shopping-cart-button">
					<a href="{{route('shop.cart')}}">View Cart</a>
					<a href="shop-checkout.php">Checkout</a>
				</div>
			</div>
		</div>
	</div>
</div>
