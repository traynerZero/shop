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

	<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div class="toast" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
      <img src="..." class="rounded btn-success" alt="...">
      <strong class="mr-auto">Added to Cart</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Successfuly Added to Cart!
    </div>
  </div>
</div>

	
<style>

.table-image {
  
  thead {
    td, th {
      border: 0;
      color: #666;
      font-size: 0.8rem;
    }
  }
  
  td, th {
    vertical-align: middle;
    text-align: center;
    
    &.qty {
      max-width: 2rem;
    }
  }
}

.price {
  margin-left: 1rem;
}

.modal-footer {
  padding-top: 0rem;
}

</style>
	<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="width:50%;">
		

		
    </div>
  </div>
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
					$('.toast').toast('show');
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
