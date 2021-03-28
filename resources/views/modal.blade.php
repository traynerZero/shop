
<div>
<div class="modal-header border-bottom-0" style="background-color:white;">
			<h5 class="modal-title" id="exampleModalLabel">
			Your Shopping Cart
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<div class="modal-body"  style="background-color:white;">
        <table class="table table-image">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Qty</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $product)
            <tr>
              <td class="w-25">
                <img style="width:10vh; height 10vh;" src="images/home/product1.jpg" class="img-fluid img-thumbnail" alt="Sheep">
              </td>
              <td>{{ $product['prod_name'] }}</td>
              <td>{{ number_format($product['price'],2) }}</td>
              <td class="qty">{{ $product['quantity'] }}</td>
              <td>{{ number_format($product['total'],2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table> 
        <a  href="{{ url('/clearCart') }}" class="btn btn-success">Clear Cart</a>
      <div class="modal-footer border-top-0 d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a  href="{{ url('/checkout') }}" class="btn btn-success">Checkout</a>
      </div>

    </div>

    </div>

    

