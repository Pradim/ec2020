<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
</div>

<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
@if(Session::has('success'))
	<script>
		swal('Success!', Session::get('success'), 'success');
	</script>
@endif
@if(Session::has('error'))
	<script>swal('error!', Session::get('error'), 'error');</script>
@endif
<script>
	$('.js-addcart-detail').click(function(){
		let product_id = $(this).data('product_id');
		let quantity = $('#quantity').val();
		addToCart(product_id, quantity);
	});

	$('.add-to-cart').click(function(){
		let product_id = $(this).data('product_id');
		let quantity = $(this).data('quantity');
		addToCart(product_id, quantity);
	});
	function addToCart(product_id, quantity){
		$.ajax({
			url: "{{ route('add-to-cart') }}",
			type:"post",
			data: {
				_token: "{{ csrf_token() }}",
				prod_id: product_id,
				quantity: quantity
			},
			success: function(response){
				if (typeof(response) != 'object') {
					response = JSON.parse(response);
					alert('hello');
				}
				if (response.status) {
					swal('Cart Updated', response.msg, 'success').then(function(){
						document.location.href = document.location.href; 
					});
				}else{
					swal('Error!', response.msg, 'error');
				}
			}
		});
	}
</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5eaba7223b710f3f"></script>

</body>
</html>