<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
</div>

<script src="<?php echo e(asset('js/manifest.js')); ?>"></script>
<script src="<?php echo e(asset('js/vendor.js')); ?>"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
<?php if(Session::has('success')): ?>
	<script>
		swal('Success!', Session::get('success'), 'success');
	</script>
<?php endif; ?>
<?php if(Session::has('error')): ?>
	<script>swal('error!', Session::get('error'), 'error');</script>
<?php endif; ?>
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
			url: "<?php echo e(route('add-to-cart')); ?>",
			type:"post",
			data: {
				_token: "<?php echo e(csrf_token()); ?>",
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
</html><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/section/script.blade.php ENDPATH**/ ?>