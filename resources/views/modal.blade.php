
<div style="width:50%;">
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
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data['product'] as $product)
            <tr>
              <td class="w-25">
                <img style="width:10vh; height 10vh;" src="images/home/product1.jpg" class="img-fluid img-thumbnail" alt="Sheep">
              </td>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->price }}</td>
              <td class="qty"><input type="text" class="form-control" id="input1" value="2"></td>
              <td>178$</td>
              <td>
                <a href="#" class="btn btn-danger btn-sm">
                  <i class="fa fa-times"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table> 
        <div class="d-flex justify-content-end">
          <h5>Total: <span class="price text-success">89$</span></h5>
        </div>
        
      <div class="modal-footer border-top-0 d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Checkout</button>
      </div>

    </div>

    </div>

    

