@extends('layouts.auth')

@section('content')

<div class="account-pages my-5 pt-sm-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
          <div class="bg-primary bg-soft">
            <div class="row">
              <div class="col-7">
                <div class="text-primary p-4">
                  <h5 class="text-primary">Free Registration</h5>
                  <p>Get your {{$website}} account now.</p>
                </div>
              </div>
              <div class="col-5 align-self-end">
                <img src="{{asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="card-body pt-0"> 
            <div>
              <a href="index.html">
                <div class="avatar-md profile-user-wid mb-4">
                  <span class="avatar-title rounded-circle bg-light">
                    <img src="{{asset('assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                  </span>
                </div>
              </a>
            </div>
            <div class="p-2">
              @if(\Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                  {!! \Session::get('error') !!}
                </div>
              @endif
              <div class="alert alert-danger error-alert" role="alert" style="display: none;">
                
              </div>

              <form method="POST" action="{{ route('create_product') }}" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                @csrf
                <input type="hidden" name="package_name" value="{{$product}}">
                <input type="hidden" name="website" value="{{$website}}">

                <div class="mb-3">
                  <label for="referal_user" class="form-label">{{ __('Referal Username or Email') }}<small> (if any)</small></label>

                  <input id="referal_user" type="text" class="form-control @error('referal_user') is-invalid @enderror" name="referal_user" >

                  @error('referal_user')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('E-Mail Address') }}
                  </div>      
                </div>
                <div class="mb-3">
                  <label for="useremail" class="form-label">{{ __('Username') }}*</label>

                  <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                  @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('First Name') }}
                  </div>      
                </div>
                <div class="mb-3">
                  <label for="useremail" class="form-label">{{ __('First Name') }}*</label>

                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">

                  @error('first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('First Name') }}
                  </div>      
                </div>
                <div class="mb-3">
                  <label for="useremail" class="form-label">{{ __('Last Name') }}*</label>

                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                  @error('last_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('Last Name') }}
                  </div>      
                </div>
                <div class="mb-3">
                  <label for="useremail" class="form-label">{{ __('Company Name') }}</label>

                  <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" autocomplete="company_name">

                  @error('company_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('Company Name') }}
                  </div>      
                </div>
                <div class="mb-3">
                  <label for="useremail" class="form-label">{{ __('E-Mail Address') }}*</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('E-Mail Address') }}
                  </div>      
                </div>
                
                <div class="mb-3">
                  <label for="userpassword" class="form-label">{{ __('Password') }}*</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Password') }}
                  </div>       
                </div>
                
                <div class="mb-3">
                  <label for="userpassword" class="form-label">{{ __('Confirm Password') }}*</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  <div class="invalid-feedback">
                    Please Renter {{ __('Password') }}
                  </div>       
                </div>

                <h4>Billing Address</h4>
                <div class="mb-3">
                  <label for="first_name" class="form-label">{{ __('First Name') }}*</label>
                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                  @error('first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('First Name') }}
                  </div>  
                </div>

                <div class="mb-3">
                  <label for="last_name" class="form-label">{{ __('Last Name') }}*</label>
                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                  @error('last_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Last Name') }}
                  </div>  
                </div>

                <div class="mb-3">
                  <label for="address_1" class="form-label">{{ __('Address 1') }}*</label>
                  <input id="address_1" type="text" class="form-control @error('address_1') is-invalid @enderror" name="address_1" value="{{ old('address_1') }}" required autocomplete="address_1" autofocus>

                  @error('address_1')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Address 1') }}
                  </div>  
                </div>

                <div class="mb-3">
                  <label for="address_2" class="form-label">{{ __('Address 2') }}</label>
                  <input id="address_2" type="text" class="form-control @error('address_2') is-invalid @enderror" name="address_2" value="{{ old('address_2') }}" autocomplete="address_2" autofocus>

                  @error('address_2')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Address 1') }}
                  </div>  
                </div>
                <div class="mb-3">
                  <label for="city" class="form-label">{{ __('City') }}*</label>
                  <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>

                  @error('city')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('City') }}
                  </div>  
                </div>
                <div class="mb-3">
                  <label for="postal_code" class="form-label">{{ __('Postal Code') }}*</label>
                  <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code" autofocus>

                  @error('postal_code')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Postal Code') }}
                  </div>  
                </div>
                <div class="mb-3">
                  <label for="country" class="form-label">{{ __('Country') }}*</label>
                  <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>

                  @error('country')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Country') }}
                  </div>  
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">{{ __('Phone') }}*</label>
                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                  @error('phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Phone') }}
                  </div>  
                </div>
                <div class="mb-3">
                  <label for="state" class="form-label">{{ __('State') }}*</label>
                  <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state" autofocus>

                  @error('state')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('State') }}
                  </div>  
                </div>
                <h4>Payment Information</h4>

                <div class="mb-3">
                  <label for="card_number" class="form-label">{{ __('Card Number') }}*</label>
                  <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror card-number" name="card_number" value="{{ old('card_number') }}" required autocomplete="card_number" autofocus placeholder="1234 1234 1234 1234">

                  @error('card_number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('Card Number') }}
                  </div>  
                </div>

                <div class="mb-3 row">
                  <div class="col-md-6">
                    <label for="expiration_month" class="form-label">{{ __('Expiration Month') }}*</label>
                    <input id="expiration_month" type="text" class="form-control @error('expiration_month') is-invalid @enderror card-expiry-month" name="expiration_month" value="{{ old('expiration_month') }}" required autocomplete="expiration_month" autofocus placeholder="MM" size="2">

                    @error('expiration_month')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="invalid-feedback">
                      Please Enter {{ __('Expiration Month') }}
                    </div> 
                  </div>
                   <div class="col-md-6">
                    <label for="expiration_year" class="form-label">{{ __('Expiration Year') }}*</label>
                    <input id="expiration_year" type="text" class="form-control @error('expiration_year') is-invalid @enderror card-expiry-year" name="expiration_year" value="{{ old('expiration_year') }}" required autocomplete="expiration_year" autofocus placeholder="YYYY" size="4">

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

                <div class="mb-3">
                  <label for="cvc" class="form-label">{{ __('CVC') }}*</label>
                  <input id="cvc" type="text" class="form-control @error('cvc') is-invalid @enderror card-cvc" name="cvc" value="{{ old('cvc') }}" required autocomplete="cvc" autofocus>

                  @error('cvc')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback">
                    Please Enter {{ __('CVC') }}
                  </div>  
                </div>
                <div class="mt-4 d-grid">
                  <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                </div>

                <!-- <div class="mt-4 text-center">
                  <h5 class="font-size-14 mb-3">Sign up using</h5>
                  
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                        <i class="mdi mdi-facebook"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                        <i class="mdi mdi-twitter"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                        <i class="mdi mdi-google"></i>
                      </a>
                    </li>
                  </ul>
                </div> -->
                
                <div class="mt-4 text-center">
                  <p class="mb-0">By registering you agree to the ACG <a href="#" class="text-primary">Terms of Use</a></p>
                </div>
              </form>
            </div>
            
          </div>
        </div>
        <div class="mt-5 text-center">
          
          <div>
            <p>Already have an account ? <a href="{{route('login')}}" class="fw-medium text-primary"> Login</a> </p>
            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection


@section('script-auth')
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
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
      
    });
  </script>
@endsection
 
