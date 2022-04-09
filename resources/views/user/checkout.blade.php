@extends('layouts.user')

@section('custom-css')

@endsection

@section('page-content')

<div class="container-fluid">

	<!-- start page title -->
  <div class="checkout-tabs">
   <div class="row">
    <div class="col-12">
     <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">Checkout</h4>

      <div class="page-title-right">

      </div>

    </div>
  </div>
</div>
<!-- end page title -->

@include('user.validation_message')

<div class="row">

  <div class="col-xl-2 col-sm-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      {{-- <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
        <i class= "bx bxs-truck d-block check-nav-icon mt-4 mb-2"></i>
        <p class="fw-bold mb-4">Shipping Info</p>
      </a> --}}

      <a class="nav-link active " id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
        <i class= "bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
        <p class="fw-bold mb-4">Payment Info</p>
      </a>
      <a class="nav-link " id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
        <i class= "bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
        <p class="fw-bold mb-4">Confirmation</p>
      </a>
    </div>
  </div>
  <div class="col-xl-10 col-sm-9">
    <div class="alert alert-danger error-alert" role="alert" style="display: none;">

    </div>
    <form action="{{route('subscribe-package')}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
     @csrf
     <div class="card">
      <div class="card-body">
        <div class="tab-content" id="v-pills-tabContent">

          <div class="tab-pane fade  show active" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
            <div>
              {{-- <h4 class="card-title">Payment information</h4>
              <p class="card-title-desc">Fill all information below</p>

              <div>
                <div class="form-check form-check-inline font-size-16">
                  <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio1" checked>
                  <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><i class="fab fa-cc-mastercard me-1 font-size-20 align-top"></i> Credit / Debit Card</label>
                </div>
                <div class="form-check form-check-inline font-size-16">
                  <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio2">
                  <label class="form-check-label font-size-13" for="paymentoptionsRadio2"><i class="fab fa-cc-paypal me-1 font-size-20 align-top"></i> Paypal</label>
                </div>
                <div class="form-check form-check-inline font-size-16">
                  <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio3">
                  <label class="form-check-label font-size-13" for="paymentoptionsRadio3"><i class="far fa-money-bill-alt me-1 font-size-20 align-top"></i> Cash on Delivery</label>
                </div>
              </div> --}}

              <h5 class="mt-5 mb-3 font-size-15">For card Payment</h5>
              <div class="p-4 border">

                <div class="form-group mb-0">
                  <label for="cardnumberInput">Card Number</label>
                  <input type="text" class="form-control  @error('card_number') is-invalid @enderror card-number" name="card_number" value="{{ old('card_number') }}" required autocomplete="card_number" autofocus placeholder="1234 1234 1234 1234" name="card_number" placeholder="0000 0000 0000 0000">
                  @error('card_number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Card Number') }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group mt-4 mb-0">
                      <label for="cardnameInput">Expiry Month</label>
                      <input type="text" class="form-control  @error('expiration_month') is-invalid @enderror card-expiry-month" name="expiration_month" value="{{ old('expiration_month') }}" required autocomplete="expiration_month" autofocus placeholder="MM" size="2" name="expiration_month" placeholder="MM">
                      @error('expiration_month')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      <div class="invalid-feedback">
                        Please Enter {{ __('Expiration Month') }}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group mt-4 mb-0">
                      <label for="expiration_month">Expiry Year</label>
                      <input type="text" class="form-control @error('expiration_year') is-invalid @enderror card-expiry-year" name="expiration_year" value="{{ old('expiration_year') }}" required autocomplete="expiration_year" autofocus placeholder="YYYY" size="4" name="expiration_year" placeholder="yyYY">
                      @error('expiration_year')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      <div class="invalid-feedback">
                        Please Enter {{ __('Expiration Year') }}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group mt-4 mb-0">
                      <label for="cvvcodeInput">CVV Code</label>
                      <input type="text" name="cvc" class="form-control @error('cvc') is-invalid @enderror card-cvc" name="cvc" value="{{ old('cvc') }}" required autocomplete="cvc" autofocus placeholder="Enter CVV Code">
                      @error('cvc')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      <div class="invalid-feedback">
                        Please Enter {{ __('CVC') }}
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group mt-4 mb-0">
                    <div class="g-recaptcha" data-sitekey="{{$GOOGLE_RECAPTCHA_KEY}}">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
            <div class="card shadow-none border mb-0">
              <div class="card-body">
                <h4 class="card-title mb-4">Order Summary</h4>

                <div class="table-responsive">

                    <table class="table align-middle mb-0 table-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $total = 0;
                        ?>
                        @if(session()->has('packages'))
                            @foreach ($packages as $package_id)

                                <?php
                                    $package = \App\Package::find($package_id);
                                    $total += $package->price;
                                ?>
                                <tr>
                                    <th scope="row">{{$package->title}}</th>
                                    <td>$ {{$package->price}}</td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <th colspan="2">No items in the cart</th>
                            </tr>
                        @endif

                        {{-- <tr>
                          <td colspan="2">
                            <h6 class="m-0 text-end">Sub Total:</h6>
                          </td>
                          <td>
                            $ {{Cart::subtotal()}}
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3">
                            <div class="bg-primary bg-soft p-3 rounded">
                              <h5 class="font-size-14 text-primary mb-0"><i class="fas fa-shipping-fast me-2"></i> Shipping <span class="float-end">Free</span></h5>
                            </div>
                          </td>
                        </tr> --}}
                        <tr>
                            <td colspan="1">
                                <h6 class="m-0 text-end">Total:</h6>
                            </td>
                            <td>
                                $ {{$total}}
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    {{--                  <table class="table align-middle mb-0 table-nowrap">--}}
{{--                    <thead class="table-light">--}}
{{--                      <tr>--}}
{{--                        <th scope="col">Name</th>--}}
{{--                        <th scope="col">Product Desc</th>--}}
{{--                        <th scope="col">Price</th>--}}
{{--                      </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody> --}}
{{--                      @foreach (Cart::content() as $item)--}}

{{--                      <tr>--}}
{{--                        <th scope="row">{{$item->name}}</th>--}}
{{--                        <td>--}}
{{--                          <p class="text-muted mb-0">$ {{$item->price}}x {{$item->qty}}</p>--}}
{{--                        </td>--}}
{{--                        <td>$ {{$item->price*$item->qty}}</td>--}}
{{--                      </tr>--}}
{{--                      @endforeach--}}

{{--                      --}}{{-- <tr>--}}
{{--                        <td colspan="2">--}}
{{--                          <h6 class="m-0 text-end">Sub Total:</h6>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                          $ {{Cart::subtotal()}}--}}
{{--                        </td>--}}
{{--                      </tr>--}}
{{--                      <tr>--}}
{{--                        <td colspan="3">--}}
{{--                          <div class="bg-primary bg-soft p-3 rounded">--}}
{{--                            <h5 class="font-size-14 text-primary mb-0"><i class="fas fa-shipping-fast me-2"></i> Shipping <span class="float-end">Free</span></h5>--}}
{{--                          </div>--}}
{{--                        </td>--}}
{{--                      </tr> --}}
{{--                      <tr>--}}
{{--                        <td colspan="2">--}}
{{--                          <h6 class="m-0 text-end">Total:</h6>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                          $ {{Cart::subtotal()}}--}}
{{--                        </td>--}}
{{--                      </tr>--}}
{{--                    </tbody>--}}
{{--                  </table>--}}

                </div>
              </div>
            </div>


          </div>
          <div class="row mt-4">
            <div class="col-sm-6">
              <a href="{{url('cart')}}" class="btn text-muted d-none d-sm-inline-block btn-link">
                <i class="mdi mdi-arrow-left me-1"></i> Back to Shopping Cart </a>
              </div> <!-- end col -->
              <div class="col-sm-6">
                <div class="text-end">
                  <button type="submit" class="btn btn-success">
                    <i class="mdi mdi-truck-fast me-1"></i> Pay </button>
                  </div>
                </div> <!-- end col -->
              </div>
            </div>
          </div>

        </form>
        <!-- end row -->
      </div>

    </div>
    <!-- end row -->

  </div> <!-- container-fluid -->
</div> <!-- container-fluid -->

@endsection


@section('scripts')
<script type="text/javascript" src="{{asset('assets/js/tooltip.js')}}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">


  $(function() {
   var $form         = $(".require-validation");
   $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
    inputSelector = ['input[type=email]', 'input[type=password]',
    'input[type=text]', 'input[type=file]',
    'textarea'].join(', '),
    $inputs       = $form.find('.required').find(inputSelector),

    valid         = true;
    $('.error-alert').hide();

    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
     var $input = $(el);
     if ($input.val() === '') {
      $input.parent().addClass('has-error');
      $('.error-alert').show();
      e.preventDefault();
    }
  });

    if (!$form.data('cc-on-file')) {
     e.preventDefault();
     Stripe.setPublishableKey($form.data('stripe-publishable-key'));
     Stripe.createToken({
      number: $('.card-number').val(),
      cvc: $('.card-cvc').val(),
      exp_month: $('.card-expiry-month').val(),
      exp_year: $('.card-expiry-year').val()
    }, stripeResponseHandler);
   }

 });

   function stripeResponseHandler(status, response) {
    if (response.error) {
     $('.error-alert')
     .show()
     .text(response.error.message);
     $(window).scrollTop(0);
   } else {
     var token = response['id'];
     $form.find('input[type=text]').empty();
     $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
     $form.get(0).submit();
   }
 }

});
</script>
@endsection
