<footer class="pt-4 my-md-5 pt-md-5 border-top">
	<div class="row">
		<div class="col-12 col-md">
			<img class="mb-2" src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="24" height="19">
			<small class="d-block mb-3 text-muted">&copy; {{ date('Y') }}</small>
		</div>
		<div class="col-6 col-md">
			<h5>Cart</h5>
			<ul class="list-unstyled text-small">
				<li class="mb-1"><a class="link-secondary text-decoration-none" href="{{ route('cart.show') }}">Cart items list</a></li>
			</ul>
		</div>
		<div class="col-6 col-md">
			<h5>Products</h5>
			<ul class="list-unstyled text-small">
				<li class="mb-1"><a class="link-secondary text-decoration-none" href="{{ route('products.create') }}">Create new product</a></li>
			</ul>
		</div>
		<div class="col-6 col-md">
			<h5>About</h5>
			<ul class="list-unstyled text-small">
				<li class="mb-1"><a class="link-secondary text-decoration-none" href="#">...</a></li>
			</ul>
		</div>
	</div>
</footer>
