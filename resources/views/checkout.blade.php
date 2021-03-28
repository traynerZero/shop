@include('header')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					@foreach($data as $product)
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/shop/{{ $product->image }}" alt="" style="width:100px; height:200px;"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $product['prod_name'] }}</a></h4>
								<p>{{ $product['prod_description'] }}</p>
							</td>
							<td class="cart_price">
								<p>{{ number_format($product['price'],2) }}</p>
							</td>
							<td class="cart_quantity">
								<p>{{ $product['quantity'] }}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{ number_format($product['total'],2) }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<a class="btn btn-primary" href="{{ url('/inputCardInfo') }}" role="tab" data-toggle="modal" data-target="#cardModal">Continue</a>
			</div>
		</div>
	</section> <!--/#cart_items-->


</body>
</html>