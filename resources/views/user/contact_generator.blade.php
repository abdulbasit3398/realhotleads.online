@extends('layouts.user')

@section('page-content')
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body upload-modal-body">
        <div class="alert alert-danger error-alert" role="alert" style="display: none;">

        </div>
        <form method="POST"  class="require-validation" action="{{route('contact-price-pay')}}" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
          @csrf
          <input type="hidden" name="package_id" id="package_id">
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
          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-md">Pay</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Contact Generator</h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          @if(\Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! \Session::get('success') !!}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{$error}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
          @endif
          
          <form method="post" action="{{route('search-contact')}}">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="area_code" id="floatingnameInput">
                <label for="floatingnameInput">Enter Area Code, Zip, State</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="key_word" id="floatingnameInput">
                <label for="floatingnameInput">Enter Category, Industry Keywords</label>
                
            </div>

            <div class="row">
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck1" name="mobile_b2b[]" value="All" checked>
                  <label class="form-check-label" for="formCheck1">
                    All
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck3" name="mobile_b2b[]" value="Mobile #">
                  <label class="form-check-label" for="formCheck3">
                    Mobile #
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck2" name="mobile_b2b[]" value="Mobile # ONLY">
                  <label class="form-check-label" for="formCheck2">
                    Mobile # ONLY
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck3" name="mobile_b2b[]" value="B2B #">
                  <label class="form-check-label" for="formCheck3">
                    B2B #
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck3" name="mobile_b2b[]" value="B2B # ONLY">
                  <label class="form-check-label" for="formCheck3">
                    B2B # ONLY
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck8" name="mobile_b2b[]" value="Mobile # Heavy">
                  <label class="form-check-label" for="formCheck8">
                    Mobile # Heavy
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck4" name="mobile_b2b[]" value="B2B # Heavy">
                  <label class="form-check-label" for="formCheck4">
                    B2B # Heavy
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck5" name="mobile_b2b[]" value="Email">
                  <label class="form-check-label" for="formCheck5">
                    Email
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck6" name="mobile_b2b[]" value="Email only">
                  <label class="form-check-label" for="formCheck6">
                    Email only
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="formCheck7" name="mobile_b2b[]" value="Email Heavy">
                  <label class="form-check-label" for="formCheck7">
                    Email Heavy
                  </label>
                </div>
              </div>
            </div>
            <div class="g-recaptcha"
                    data-sitekey="{{$GOOGLE_RECAPTCHA_KEY}}">
                </div>

            <div class="form-floating mb-3">
              <button type="submit" class="btn btn-primary w-md">GENERATE</button>
              <br/>
              <small>(please note: not all contacts will be of requested target, but will be closest to)</small>
            </div>
          </form>


          <div class="table-responsive">
            <table class="table mb-0">

              <thead>
                <tr>
                  <th>Date submitted</th>
                  <th>Area</th>
                  <th>Keywords</th>
                  <th>Instructions</th>
                  <th>Contact File</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contacts as $contact)
                <tr>
                  <td>{{$contact->created_at}}</td>
                  <td>{{$contact->search_key}}</td>
                  <td>{{$contact->key_word}}</td>
                  <td>
                    <?php
                      // if(is_array($contact->mobile_b2b))
                      //   var_dump(json_decode($contact->mobile_b2b,true));
                      // else
                      //   echo explode(",",$contact->mobile_b2b);

                      $str = explode(",",$contact->mobile_b2b);
                      $str = str_replace(array('[',']','"'), '',$str);
                      for($i = 0; $i < count($str); $i++)
                        echo $str[$i].'<br/>';
                    ?>
                  </td>
                  
                  @if($contact->status == 1 && $contact->downloadable == 1)
                  <td>
                    @if($contact->is_file_complete == '1' && date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($contact->updated_at.'+24 hours')))
                      <a href="{{asset('public/assets/contacts/'.$contact->contact_file)}}" type="button" class="btn btn-primary waves-effect waves-light w-sm" download>
                        <i class="mdi mdi-download d-block font-size-16"></i> {{$contact->contact_file}}
                      </a>
                    @else
                      You can no longer access this file
                      <br/>
                      <a href="#" type="button" class="btn btn-primary waves-effect waves-light w-sm disabled">
                        <i class="mdi mdi-download d-block font-size-16"></i> {{$contact->contact_file}}
                      </a>
                      
                    @endif
                  </td>
                  @elseif($contact->status == 1 && $contact->downloadable == 0 && $contact->price != 0)
                  <td>
                    Pay ${{$contact->price}} to access the file. 
                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="{{$contact->id}}" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" style="float: right;">Pay</a>
                  </td>
                  @elseif($contact->notes != '')
                  <td>
                    <p style="color:#ff5e00;">{{$contact->notes}} <i class="bx bx-cog bx-spin"></i></p>
                  </td>
                  @else
                  <td>
                    <p style="color:#ff5e00;">contacts have been generated... <i class="bx bx-cog bx-spin"></i></p>
                  </td>
                  @endif
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          <br/>
          <br/>
          <br/>
          <br/>
        </div>
      </div>
    </div>


  </div>
  <!-- end page title -->

</div> 
@endsection



@section('scripts')
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
<script type="text/javascript">
  $(document).ready(function(){

    $('.upload-modal-button').click(function(){
      var myBookId = $(this).data('id');
      var time = $(this).data('time');
      $(".upload-modal-body #package_id").val( myBookId );
    });

  });

</script>
@endsection