

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" target="_blank" method="post" name="frmTransaction" id="frmTransaction">
	@csrf
<!-- <input type="hidden" name="cmd" value="_cart"> -->
 <input type="hidden" name="charset" value="utf-8" />
 <input type='hidden' name='cmd' value='_xclick'>
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="sb-pwe763641068@business.example.com">
<!-- sb-te6ox236609@business.example.com -->
<!-- seller@dezignerfotos.com -->


  
<input type="hidden" name="bn" value="Business_BuyNow_WPS_SE" />


 @php $count=0; @endphp
@foreach($cartItems as $cart)
<br>
@php $count++; @endphp
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name_{{ $count }}" value="{{$cart->name}}">
<input type="hidden" name="amount_{{ $count }}" value="{{$cart->price}}">
<input type="hidden" name="quantity_{{ $count }}" value="{{$cart->qty}}">
@endforeach  
<input type="hidden" name="rm" value="2">
   <input type="hidden" name="cbt" value="Return to The Store">
<input type="hidden" value="No comments" name="cn">
<input type="hidden" value="US" name="lc">
<input type="hidden" value="PP-BuyNowBF" name="bn">
<input type="hidden" name="cancel_return" value="{{ url('user/checkout') }}" />
 <input type='hidden' name='return' value="{{ url('user/paypalCheckout') }}">
 <input type="hidden" name="notifyurl" value="{{ url('user/notifyurl') }}">
<input id="paypalSubmit" type="submit" class = "btn btn-success" value="PayPal" style="display: none;">
</form>



 <a style="display: none;" id="paypalsubmit" href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Pay $224 via Paypal</a>