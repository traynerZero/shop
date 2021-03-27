@include('header')


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
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@foreach($data as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="images/home/product1.jpg" alt="" />
											<h2>{{ number_format($product->price,2)  }}</h2>
											<p>{{ $product->product_name }}</p>
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

	<script>
		$(document).ready(function(){

			$('.add-to-cart').on('click',function(){
				var id = $(this).data('data-id');
				alert(id);

			});

		});
	</script>
@include('modal')