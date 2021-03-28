@include('header')



@if(session('success_toast'))

	<div class="alert alert-success addedToCart" style="position: fixed; top: 0px; width:100%; text-align:center;">
							<strong>Success!</strong> {{ session('success_toast') }}
	</div>
	<script>
		setTimeout(() => {
			$('.addedToCart').hide('blind');
		}, 4000);
	</script>
	@endif

	@if(session('error_toast'))

	<div class="alert alert-danger addedToCart" style="position: fixed; top: 0px; width:100%; text-align:center;">
							<strong>Error!</strong> {{ session('error_toast') }}
	</div>
	<script>
		setTimeout(() => {
			$('.addedToCart').hide('blind');
		}, 4000);
	</script>
	@endif

<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@foreach($data as $product)
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="images/shop/{{ $product->image }}" alt="" style="width:100px; height:200px;"  />
											<h2>{{ number_format($product->price,2)  }}</h2>
											<p>{{ $product->product_name }}</p>
											<p>Stock: {{ $product->stocks }}</p>
											<a href="#" data-id="{{ $product->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{ number_format($product->price,2) }}</h2>
												<p>{{ $product->product_description }}</p>
												<a href="#" data-id="{{ $product->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<!-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div> -->
							</div>
						</div>
						@endforeach
						
						
					</div><!--features_items-->
					
					
				</div>
			</div>
		</div>
	</section>

	<div class="alert alert-success addedToCart" style="display:none; position: fixed; top: 0px; width:100%; text-align:center;">
    	<strong>Success!</strong> Item added to Cart!
  	</div>

	


	<script>
		$(document).ready(function(){

			$('.add-to-cart').on('click',function(){
				var id = $(this).attr('data-id');
				
				$.ajax({
					type: "POST",
					url: "{{ url('/addtoCart') }}",
					data: {
					"_token": "{{ csrf_token() }}",
					"id": id
					},
					dataType: "json",
					encode: true,
					}).done(function (data) {
					console.log(data);
					$('.addedToCart').show('blind');
					setTimeout(() => {
						$('.addedToCart').hide('blind');
					}, 2000);
				});

			});

			function loadModal(){
			$('.modal-body').load("{{ url('/viewCart') }}",function(){
				$('#cartModal').modal({show:true});
			});
			}

		});
	</script>

	</body>
	</html>
