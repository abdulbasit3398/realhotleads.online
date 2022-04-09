@extends('layouts.user_under_construction')

@push('script-js')
<script type="text/javascript">
	$('.carousel').carousel({
		  interval: false,
		});

    $('.owl-carousel').owlCarousel({
        center: true,
        items:1,
        loop:true,
        autoplay:false
    });

</script>
@endpush

@section('custom-css')

<link href="{{asset('assets/css/tooltip.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<style type="text/css">

.form-check-input-success:checked {

	background-color: green !important;

	border-color: green !important;

}



.carousel-control-next-icon {

  background-color: lightgray;

}

.carousel-control-prev-icon{

	background-color: lightgray;

}

</style>

@endsection



@section('container')

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="modal-header">

				<h4 style="margin: 0;">Payment Information</h4>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<div class="modal-body upload-modal-body">

				<div class="alert alert-danger error-alert" role="alert" style="display: none;">



				</div>

				<form method="POST"  class="require-validation" action="{{route('subscribe-package')}}" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">

					@csrf

					<input type="hidden" name="package_id" id="package_id">

					<input type="hidden" name="time" id="time">
 


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





<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<div class="modal-body upload-modal-body1">

				<div class="alert alert-danger error-alert" role="alert" style="display: none;">



				</div>

				<form method="POST"  class="" action="{{route('subscribe-package')}}" >

					@csrf

					<input type="hidden" name="package_id" id="package_id">

					<h4>Fill this information</h4>



					<div class="mb-3 row">

						<label for="expiration_month" id="custom-label" class="form-label"></label>

						<textarea class="form-control" rows="5" name="package_notes" required></textarea>

					</div>



					<div class="mb-3">

						<button type="submit" class="btn btn-primary w-md">Submit</button>

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

				<h4 class="mb-sm-0 font-size-18"></h4>



				<div class="page-title-right">



				</div>



			</div>

		</div>

	</div>

	<!-- end page title -->



	<div class="row justify-content-center">

		<div class="col-lg-6">

			<div class="text-center mb-5">

				@if(\Session::has('success'))

				<div class="alert alert-success alert-dismissible fade show" role="alert">

					{!! \Session::get('success') !!}

					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

				</div>
                    <?php
                    session()->forget('success');
                    ?>

				@endif

				<h4>Choose your Package</h4>



			</div>

		</div>

	</div>



	<div class="row">
 
            <div class="col-xl-46 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleFade54" class="carousel slide carousel-fade1" data-ride="carousel" data-bs-interval="false">

                            <ol class="carousel-indicators">

                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="0" class="active"></li>

                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="1"></li>

                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="2"></li>
                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="3"></li>

                            </ol>

                            <div class="carousel-inner" role="listbox">

                                <div class="carousel-item active">



                                    <div class="card-body p-4 ">

                                        <div class="media">

                                            <div class="media-body">

                                                <h5></h5>

                                                <p class="text-muted"></p>

                                            </div>

                                            <div class="ms-3">

                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
    
                                                </i> -->

                                            </div>

                                        </div>

                                        <div class="py-4">

                                            <h4> Landing Page</h4>

                                            <h2><sup><small>$</small></sup> 0.00</h2>

                                        </div>

                                        <div class="text-center plan-btn">

                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>

                                            

                                        </div>



                                        <div class="plan-features mt-5">

                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i>7 Day Free Trial</p>
                                            <p>&nbsp;</p>

                                             

                                        </div>

                                    </div>



                                </div>



                                <div class="carousel-item">



                                    <div class="card-body p-4 ">

                                        <div class="media">

                                            <div class="media-body">

                                                <h5></h5>

                                                <p class="text-muted"></p>

                                            </div>

                                            <div class="ms-3">

                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
    
                                                </i> -->

                                            </div>

                                        </div>

                                        <div class="py-4">

                                            <h4>Capture Page</h4>

                                            <h2><sup><small>$</small></sup> 45/<span class="font-size-13">Per month</span></h2>

                                        </div>

                                        <div class="text-center plan-btn">

                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>

                                            

                                        </div>



                                        <div class="plan-features mt-5">

                                            <p>&nbsp;</p>

                                             

                                        </div>



                                    </div>



                                </div>



                                <div class="carousel-item">



                                    <div class="card-body p-4 ">

                                        <div class="media">

                                            <div class="media-body">

                                                <h5></h5>

                                                <p class="text-muted"></p>

                                            </div>

                                            <div class="ms-3">

                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
    
                                                </i> -->

                                            </div>

                                        </div>

                                        <div class="py-4">

                                            <h4>Landing Page</h4>

                                            <h2><sup><small>$</small></sup> 105/<span class="font-size-13">Per month</span></h2>

                                        </div>

                                        <div class="text-center plan-btn">

                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>

                                            

                                        </div>



                                        <div class="plan-features mt-5">

                                            <p>&nbsp;</p>

                                             

                                        </div>

                                    </div>



                                </div>

                                <div class="carousel-item">



                                    <div class="card-body p-4 ">

                                        <div class="media">

                                            <div class="media-body">

                                                <h5></h5>

                                                <p class="text-muted"></p>

                                            </div>

                                            <div class="ms-3">

                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
    
                                                </i> -->

                                            </div>

                                        </div>

                                        <div class="py-4">

                                            <h4>Funnel <small>(landing and capture page combination)</small></h4>

                                            <h2><sup><small>$</small></sup> 135/<span class="font-size-13">Per month</span></h2>

                                        </div>

                                        <div class="text-center plan-btn">

                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>

                                            

                                        </div>



                                        <div class="plan-features mt-5">

                                            <p>&nbsp;</p>

                                             

                                        </div>

                                    </div>



                                </div>

                            </div>



                            <a class="carousel-control-prev" href="#carouselExampleFade54" role="button" data-bs-slide="prev">

                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                                <span class="sr-only">Previous</span>

                            </a>

                            <a class="carousel-control-next" href="#carouselExampleFade54" role="button" data-bs-slide="next">

                                <span class="carousel-control-next-icon" aria-hidden="true"></span>

                                <span class="sr-only">Next</span>

                            </a>
                        </div>

                    </div>

                </div>

            </div>
		 
        
		 
       
		 
		 

         
         
 

    </div>

		<!-- end row -->



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

	<script type="text/javascript">

		$(document).ready(function(){

			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))

			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {

				return new bootstrap.Tooltip(tooltipTriggerEl)

			})



			$('.upload-modal-button').click(function(){

				var myBookId = $(this).data('id');

				var time = $(this).data('time');

				$(".upload-modal-body #package_id").val( myBookId );

				$(".upload-modal-body #time").val( time );

			});



			$('.upload-modal-button1').click(function(){

				var myBookId = $(this).data('id');

				var label = $(this).data('label');

				$(".upload-modal-body1 #package_id").val( myBookId );

				$(".upload-modal-body1 #custom-label").text( label );

			});

		});
	</script>

		<script type="text/javascript">

            function cart(id){
                $.ajax({
                    url: '{{ url('cart') }}',
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        package_id:id,
                    },

                    success: function (response) {

                        // $(".cartCount").text(response.count);
                        $(".cartCount").fadeOut(400, function () {
                            $(this).text(response.count).fadeIn(400);
                        });
                    }
                });
            }


			function cart(e,id,time){--}}




				$.ajax({--}}

			 


		</script>

	@endsection
