@extends('layouts.frontendmaster')

@section('frontend_main')
  <!-- Page Info -->
  	<div class="page-info-section page-info">
  		<div class="container">
  			<div class="site-breadcrumb">
  				<a href="{{ url('/') }}">Home</a> /
  				<span></span>
  			</div>
  			<img src="img/page-info-art.png" alt="" class="page-info-art">
  		</div>
  	</div>
  	<!-- Page Info end -->


  	<!-- Page -->
  	<div class="page-area cart-page spad">
  		<div class="container" >
      <form  action="{{ url('card/update') }}" method="post">
        @if ( session('success_cod') )
          <div class="alert alert-success">
            {{ session('success_cod')  }}
          </div>
        @endif
        @if ( session('Cardpayment') )
          <div class="alert alert-success">
            {{ session('Cardpayment')  }}
          </div>
        @endif

        @csrf
  			<div class="cart-table" style="border-radius:8px; box-shadow:0px 2px 7px 0px;padding:10px; ">
    				<table >
    					<thead class="text-center text-white bg-info" >
    						<tr>
    							<th class="product-th p-4" style="font-size:20px;">Product</th>
    							<th style="font-size:20px;">Price</th>
    							<th style="font-size:20px;">Quantity</th>
    							<th style="font-size:20px;" class="total-th">Total</th>
    							<th style="font-size:20px;"> Delete Item</th>
    						</tr>
    					</thead>
    					<tbody>
                @php
                  $sub_total = 0;
                @endphp
                @forelse ($card_items as $card_item)
                  <tr>
      							<td class="product-col">
      								<img src="{{ asset('upload/product_images/'.$card_item-> relationcard-> product_image) }}" alt="Not Found" width="80">
      								<div class="pc-title">
      									<h4>{{ $card_item-> relationcard-> product_name }}</h4>
      								</div>
      							</td>
      							<td class="price-col">{{ $card_item-> relationcard-> product_price }} tk</td>
      							<td class="quy-col">
      								<div class="quy-input">
      									<span>Qty</span>
                        <input type="hidden" name="product_id[]" value="{{ $card_item-> product_id }}">
      									<input type="number" name="customer_quantity[]" value="{{ $card_item-> product_quantity }}">
      								</div>
      							</td>
      							<td class="total-col">
                      {{ $card_item-> relationcard-> product_price * $card_item-> product_quantity}} tk
                      @php
                        $sub_total = $sub_total + ($card_item-> relationcard-> product_price * $card_item-> product_quantity) ;
                      @endphp
                    </td>
                    <td>
                      <a href="{{ url('single/product/delete') }}/{{ $card_item-> id }}">
                        <span class=" fa fa-trash " style="margin-left: 144px; margin-top: -117px;font-size:30px;"></span>
                      </a>
                    </td>
                  </tr>
              @empty
                <tr class="text-center text-white bg-dark ">
                  <td colspan="5" class="p-3"><h4>Not Product Is Here</h4> </td>
                </tr>
              @endforelse

    					</tbody>
    				</table>
    			</div>
    			<div class="row cart-buttons">
    				<div class="col-lg-5 col-md-5">
    					<a href="{{ url('/') }}" class="site-btn btn-continue"  style="border-radius:15px; box-shadow:0px 0px 5px 0px black;padding:20px; ">Continue shooping</a>
    				</div>
    				<div class="col-lg-7 col-md-7 text-lg-right text-left">
    					<a href="{{ url('card/clear') }}" class="site-btn btn-clear" style="border-radius:15px; box-shadow:0px 0px 5px 0px black;padding:20px; ">Clear cart</a>
    					<button type="submit" class="site-btn btn-line btn-update" style="border-radius:15px; box-shadow:0px 0px 2px 0px black;padding:20px; ">Update Cart</button>
    				</div>
  			  </div>
        </form>
  		</div>
  		<div class="card-warp">
  			<div class="container">
  				<div class="row">
  					<div class="col-lg-4">
  						<div class="shipping-info">
  							<h4>Shipping method</h4>
  							<p>Select the one you want</p>
  							<div class="shipping-chooes">
  								<div class="sc-item">
  									<input type="radio" name="sc" id="one">
  									<label for="one" id="label_one">Next day delivery<span>150 tk</span></label>
  								</div>
  								<div class="sc-item">
  									<input type="radio" name="sc" id="two">
  									<label for="two" id="label_two">Standard delivery<span>100 tk</span></label>
  								</div>
  								<div class="sc-item">
  									<input type="radio" name="sc" id="three">
  									<label for="three" id="label_three">Personal Pickup<span>Free</span></label>
  								</div>
  							</div>
  							<h4>Cupon code</h4>
  							<p>Enter your cupone code</p>
  							<div class="cupon-input">
  								<input type="text" id="coupon_name" value="{{ $coupon_name }}">
  								<button class="site-btn" id="coupon_btn">Apply</button>
  							</div>
  						</div>
  					</div>
  					<div class="offset-lg-2 col-lg-6">
  						<div class="cart-total-details">
  							<h4>Cart total</h4>
  							<p>Final Info</p>
  							<ul class="cart-total-card">
  								<li>Subtotal<span>{{ $sub_total }} tk</span></li>
                  <li>Coupon Amount<span>{{ $coupon_amount }}</span></li>
  								<li>Shipping<span id="charge_amount"> free </span> </li>
                  @php
                    $presentis = $sub_total*($coupon_amount/100);
                    $total_amount = $sub_total-$presentis;
                  @endphp
                    <li class="total">Total<span>tk</span>
                      <span style="display:none;" id="intotal_taka">{{ $total_amount }}</span>
                      <span id="grand_total">{{ $total_amount }}</span>
                    </li>
                  </ul>
                  <form action="{{ url('checkout') }}" method="post">
                    @csrf
                    <input type="hidden" id="total_amount_billing_page" name="total_amount" value="{{ $total_amount }}">
                   <button class="site-btn btn-full" >Proceed to checkout</button>
                </form>

  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- Page end -->
@endsection

@section('footer_scripts')
  <script>
      $(document).ready(function(){
        $('#coupon_btn').click(function(){
          var coupon_name = $('#coupon_name').val();
          window.location.href = "{{ url('card/page') }}"+"/"+coupon_name;
        });
        $('#label_one').click(function(){
          var  delivary_charge = parseFloat(150);
          $('#charge_amount').html(delivary_charge);
          var grand_total = parseFloat($('#intotal_taka').html());
          var final_grand_total = delivary_charge + grand_total;
          $('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
          $('#total_amount_billing_page').val(parseFloat(final_grand_total).toFixed(2));
        });
        $('#label_two').click(function(){
          var dalivery_charge = parseFloat(100);
          $('#charge_amount').html(dalivery_charge);
          var grand_total = parseFloat($('#intotal_taka').html());
          var final_grand_total = dalivery_charge + grand_total;
          $('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
          $('#total_amount_billing_page').val(parseFloat(final_grand_total).toFixed(2));
        });
        $('#label_three').click(function(){
          var dalivery_charge = parseFloat(0);
          $('#charge_amount').html(dalivery_charge);
          var grand_total= parseFloat($('#intotal_taka').html());
          var final_grand_total = dalivery_charge + grand_total;
          $('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
          $('#total_amount_billing_page').val(parseFloat(final_grand_total).toFixed(2));
        });
      });
  </script>
@endsection
