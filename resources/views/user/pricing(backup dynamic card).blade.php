@extends('layouts.user')

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



@section('page-content')

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

					<div class="form-check form-switch form-switch-md" dir="ltr">

						<input class="form-check-input form-check-input-success" type="checkbox" name="use_wallet" value="1" id="SwitchCheckSizemd">

						<label class="form-check-label" for="SwitchCheckSizemd">Use Wallet Balance</label>

					</div>

					<small>If your wallet balance is less than package price, remaining payment will deduct from your card</small>

					<br>

					<br>

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

				<h4 class="mb-sm-0 font-size-18">Pricing</h4>



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

        @foreach($tags as $tag)

		    <div class="col-xl-4 col-md-6">
			    <div class="card">
				<div class="card-body">
                    <div class="owl-carousel owl-theme">

                        <?php
                            $packages = \App\Package::where('package_tag_id',$tag->id)->get();
                        ?>

                        @foreach($packages as $package)
                            <div class="item ">
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

                                        <h4>{{$package->title}}</h4>

                                        <h2><sup><small>$</small></sup> {{$package->price}}</h2>

                                    </div>

                                    <div class="text-center plan-btn">

                                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>

                                        <a href="#" onclick="cart({{$package->id}})"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>

                                    </div>


                                    <div class="plan-features mt-5">
                                        @if($package->items()->exists())
                                            @foreach($package->items as $item)
                                                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> {{$item->qty}} {{$item->product->title}}</p>
                                            @endforeach

                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
				</div>
			</div>
            </div>

        @endforeach

{{--            <div class="col-xl-4 col-md-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div id="carouselExampleFade54" class="carousel slide carousel-fade1" data-ride="carousel" data-bs-interval="false">--}}

{{--                            <ol class="carousel-indicators">--}}

{{--                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="0" class="active"></li>--}}

{{--                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="1"></li>--}}

{{--                                <li data-bs-target="#carouselExampleFade54" data-bs-slide-to="2"></li>--}}

{{--                            </ol>--}}

{{--                            <div class="carousel-inner" role="listbox">--}}

{{--                                <div class="carousel-item active">--}}



{{--                                    <div class="card-body p-4 ">--}}

{{--                                        <div class="media">--}}

{{--                                            <div class="media-body">--}}

{{--                                                <h5></h5>--}}

{{--                                                <p class="text-muted"></p>--}}

{{--                                            </div>--}}

{{--                                            <div class="ms-3">--}}

{{--                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--    --}}
{{--                                                </i> -->--}}

{{--                                            </div>--}}

{{--                                        </div>--}}

{{--                                        <div class="py-4">--}}

{{--                                            <h4>STARTER 1</h4>--}}

{{--                                            <h2><sup><small>$</small></sup> 20</h2>--}}

{{--                                        </div>--}}

{{--                                        <div class="text-center plan-btn">--}}

{{--                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>--}}

{{--                                            <a href="#" onclick="cart(event.preventDefault(),'20 usd package','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                                        </div>--}}



{{--                                        <div class="plan-features mt-5">--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 500 Contacts</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 500 Minutes</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 500 SMS/MMS</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 500 Emails</p>--}}

{{--                                        </div>--}}

{{--                                    </div>--}}



{{--                                </div>--}}



{{--                                <div class="carousel-item">--}}



{{--                                    <div class="card-body p-4 ">--}}

{{--                                        <div class="media">--}}

{{--                                            <div class="media-body">--}}

{{--                                                <h5></h5>--}}

{{--                                                <p class="text-muted"></p>--}}

{{--                                            </div>--}}

{{--                                            <div class="ms-3">--}}

{{--                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--    --}}
{{--                                                </i> -->--}}

{{--                                            </div>--}}

{{--                                        </div>--}}

{{--                                        <div class="py-4">--}}

{{--                                            <h4>STARTER 2</h4>--}}

{{--                                            <h2><sup><small>$</small></sup> 50</h2>--}}

{{--                                        </div>--}}

{{--                                        <div class="text-center plan-btn">--}}

{{--                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>--}}

{{--                                            <a href="#" onclick="cart(event.preventDefault(),'20 usd package','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                                        </div>--}}



{{--                                        <div class="plan-features mt-5">--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 1,500 Contacts</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 1,500 Minutes</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 1,500 SMS/MMS</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 1,500 Emails</p>--}}

{{--                                        </div>--}}



{{--                                    </div>--}}



{{--                                </div>--}}



{{--                                <div class="carousel-item">--}}



{{--                                    <div class="card-body p-4 ">--}}

{{--                                        <div class="media">--}}

{{--                                            <div class="media-body">--}}

{{--                                                <h5></h5>--}}

{{--                                                <p class="text-muted"></p>--}}

{{--                                            </div>--}}

{{--                                            <div class="ms-3">--}}

{{--                                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--    --}}
{{--                                                </i> -->--}}

{{--                                            </div>--}}

{{--                                        </div>--}}

{{--                                        <div class="py-4">--}}

{{--                                            <h4>STARTER 3</h4>--}}

{{--                                            <h2><sup><small>$</small></sup> 130</h2>--}}

{{--                                        </div>--}}

{{--                                        <div class="text-center plan-btn">--}}

{{--                                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="20 usd package" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy</a>--}}

{{--                                            <a href="#" onclick="cart(event.preventDefault(),'20 usd package','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                                        </div>--}}



{{--                                        <div class="plan-features mt-5">--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 4,500 Contacts</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 4,500 Minutes</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 4,500 SMS/MMS</p>--}}

{{--                                            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 4,500 Emails</p>--}}

{{--                                        </div>--}}

{{--                                    </div>--}}



{{--                                </div>--}}



{{--                            </div>--}}



{{--                            <a class="carousel-control-prev" href="#carouselExampleFade54" role="button" data-bs-slide="prev">--}}

{{--                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}

{{--                                <span class="sr-only">Previous</span>--}}

{{--                            </a>--}}

{{--                            <a class="carousel-control-next" href="#carouselExampleFade54" role="button" data-bs-slide="next">--}}

{{--                                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}

{{--                                <span class="sr-only">Next</span>--}}

{{--                            </a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--		<div class="col-xl-4 col-md-6">--}}

{{--			<div class="card">--}}

{{--				<div class="card-body">--}}



{{--					<h4 class="card-title">UNLIMITED</h4>--}}

{{--					<p class="card-title-desc">Enjoy All You Can Use:</p>--}}



{{--					<div id="carouselExampleFade" class="carousel slide carousel-fade1" data-ride="carousel" data-bs-interval="false">--}}

{{--						<ol class="carousel-indicators">--}}

{{--              <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>--}}

{{--            </ol>--}}



{{--						<div class="carousel-inner" role="listbox">--}}

{{--							<div class="carousel-item active">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>UNLIMITED CONTACT GENERATION</h4>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" >--}}

{{--										<h2><sup><small>$</small></sup> 300/<span class="font-size-13">Per month</span></h2>--}}

{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_contacts"--}}

{{--											 data-time="year" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy yearly</a>--}}

{{--											 <a href="#" onclick="cart(event.preventDefault(),'unlimited_contacts','year')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}



{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimted mobile #s</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited B2B #s</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>UNLIMITED BUSINESS COMMUNICATION</h4>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">--}}

{{--										<h2><sup><small>$</small></sup> 300/<span class="font-size-13">Per month</span></h2>--}}

{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_communication" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'unlimited_communication','month')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}



{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Minutes</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Text</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Email</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>UNLIMITED CONTACT GENERATION AND COMMUNICATION</h4>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">--}}

{{--										<h2><sup><small>$</small></sup> 550/<span class="font-size-13">Per month (26% Discount $407)</span></h2>--}}

{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_both" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'unlimited_both','month')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}



{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Contacts</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Minutes</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Text</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Email</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--						</div>--}}



{{--						<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">--}}

{{--              <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Previous</span>--}}

{{--            </a>--}}

{{--            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">--}}

{{--              <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Next</span>--}}

{{--            </a>--}}



{{--					</div>--}}

{{--				</div>--}}

{{--			</div>--}}

{{--		</div>--}}
{{--        --}}
{{--		<div class="col-xl-4 col-md-6">--}}

{{--			<div class="card">--}}

{{--				<div class="card-body">--}}

{{--					<h4 class="card-title">LEADS</h4>--}}

{{--					<p class="card-title-desc">All the Business You Can Handle</p>--}}

{{--					<div id="carouselExampleFade55" class="carousel slide carousel-fade1" data-ride="carousel" data-bs-interval="false">--}}

{{--						<ol class="carousel-indicators">--}}

{{--              <li data-bs-target="#carouselExampleFade55" data-bs-slide-to="0" class="active"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade55" data-bs-slide-to="1"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade55" data-bs-slide-to="2"></li>--}}

{{--            </ol>--}}



{{--						<div class="carousel-inner" role="listbox">--}}

{{--							<div class="carousel-item active">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}

{{--											<!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}

{{--											</i> -->--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>BIZOPP LEADS</h4>--}}
{{--										<div class="media pb-2">--}}

{{--											<span>A bizopp lead is some who expressed interest in your online business by submitting their info on a (capture) page</span>--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="text-center plan-btn">--}}

{{--										<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_leads" data-time="30" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 30</a>--}}

{{--										<a href="#" onclick="cart(event.preventDefault(),'biz_opp_leads','30')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> 30 Leads for $100</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}

{{--											<!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}

{{--											</i> -->--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>BIZOPP LEADS</h4>--}}

{{--										<div class="media pb-2">--}}

{{--											<span>A bizopp lead is some who expressed interest in your online business by submitting their info on a (capture) page</span>--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="text-center plan-btn">--}}

{{--										<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_leads" data-time="130" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 130</a>--}}

{{--										<a href="#" onclick="cart(event.preventDefault(),'biz_opp_leads','130')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> 130 Leads for $300</p>--}}

{{--									</div>--}}



{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}

{{--											<!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}

{{--											</i> -->--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>CUSTOM LEADS</h4>--}}

{{--										<div class="media pb-2">--}}

{{--											<span>A custom lead is someone who expressed interest in any business of choice by submitting their info on a (capture) page</span>--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="text-center plan-btn">--}}

{{--										<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_biz_opp_leads" data-label="PLEASE DESCRIBE YOUR BUSINESS AND LEAD REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy</a>--}}

{{--										<a href="#" onclick="cart(event.preventDefault(),'custom_biz_opp_leads','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Custom requirements</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--						</div>--}}



{{--						<a class="carousel-control-prev" href="#carouselExampleFade55" role="button" data-bs-slide="prev">--}}

{{--              <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Previous</span>--}}

{{--            </a>--}}

{{--            <a class="carousel-control-next" href="#carouselExampleFade55" role="button" data-bs-slide="next">--}}

{{--              <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Next</span>--}}

{{--            </a>--}}



{{--					</div>--}}

{{--				</div>--}}

{{--			</div>--}}

{{--		</div>--}}

{{--        <div class="col-xl-4 col-md-6">--}}

{{--			<div class="card">--}}

{{--				<div class="card-body">--}}

{{--					<h4 class="card-title">PROSPECTS</h4>--}}

{{--					<p class="card-title-desc">Engage Your Visitor and Increase Conversations</p>--}}

{{--					<div id="carouselExampleFade56" class="carousel slide carousel-fade1" data-ride="carousel" data-bs-interval="false">--}}

{{--						<ol class="carousel-indicators">--}}

{{--              <li data-bs-target="#carouselExampleFade56" data-bs-slide-to="0" class="active"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade56" data-bs-slide-to="1"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade56" data-bs-slide-to="2"></li>--}}

{{--            </ol>--}}



{{--						<div class="carousel-inner" role="listbox">--}}

{{--							<div class="carousel-item active">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}

{{--											<!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}

{{--											</i> -->--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>INHOUSE PROSPECTS</h4>--}}
{{--										<div class="media pb-2">--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="text-center plan-btn">--}}

{{--										<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_prospects" data-time="15" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 15</a>--}}

{{--										<a href="#" onclick="cart(event.preventDefault(),'biz_opp_prospects','15')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> 15 Prospects for $105</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}

{{--											<!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}

{{--											</i> -->--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>INHOUSE PROSPECTS</h4>--}}

{{--										<div class="media pb-2">--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="text-center plan-btn">--}}

{{--										<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_prospects" data-time="50" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 50</a>--}}

{{--										<a href="#" onclick="cart(event.preventDefault(),'biz_opp_prospects','50')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> 50 Prospects for $300</p>--}}

{{--									</div>--}}



{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}

{{--											<!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}

{{--											</i> -->--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h3>CUSTOM PROSPECTS</h3> <h6>Contact for pricing</h6>--}}

{{--										<div class="media pb-2">--}}


{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="text-center plan-btn">--}}

{{--										<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy</a>--}}

{{--										<a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Custom requirements</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--						</div>--}}



{{--						<a class="carousel-control-prev" href="#carouselExampleFade56" role="button" data-bs-slide="prev">--}}

{{--              <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Previous</span>--}}

{{--            </a>--}}

{{--            <a class="carousel-control-next" href="#carouselExampleFade56" role="button" data-bs-slide="next">--}}

{{--              <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Next</span>--}}

{{--            </a>--}}



{{--					</div>--}}

{{--				</div>--}}

{{--			</div>--}}

{{--		</div>--}}
{{--        --}}
{{--		<div class="col-xl-4 col-md-6">--}}

{{--			<div class="card">--}}

{{--				<div class="card-body">--}}



{{--					<h4 class="card-title">SALES FUNNELS</h4>--}}

{{--					<p class="card-title-desc">Enjoy All You Can Use:</p>--}}



{{--					<div id="carouselExampleFade3" class="carousel slide carousel-fade1" data-ride="carousel" data-bs-interval="false">--}}

{{--						<ol class="carousel-indicators">--}}

{{--              <li data-bs-target="#carouselExampleFade3" data-bs-slide-to="0" class="active"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade3" data-bs-slide-to="1"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade3" data-bs-slide-to="2"></li>--}}

{{--            </ol>--}}



{{--						<div class="carousel-inner" role="listbox">--}}

{{--							<div class="carousel-item active">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>INHOUSE SALES FUNNELS</h4>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">--}}



{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}



{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $10</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $30</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $120 (2 months FREE) $100</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>BIZOPP SALES FUNNELS</h4>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">--}}



{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}



{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $30</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $90</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $360 (2 months FREE) $300</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--							<div class="carousel-item">--}}



{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>CUSTOM SALES FUNNELS</h4>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">--}}



{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}



{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $90</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $270</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $1080 (2 months FREE) $900</p>--}}

{{--									</div>--}}

{{--								</div>--}}



{{--							</div>--}}



{{--						</div>--}}



{{--						<a class="carousel-control-prev" href="#carouselExampleFade3" role="button" data-bs-slide="prev">--}}

{{--              <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Previous</span>--}}

{{--            </a>--}}

{{--            <a class="carousel-control-next" href="#carouselExampleFade3" role="button" data-bs-slide="next">--}}

{{--              <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Next</span>--}}

{{--            </a>--}}



{{--					</div>--}}

{{--				</div>--}}

{{--			</div>--}}

{{--		</div>--}}

{{--		<div class="col-xl-4 col-md-6">--}}

{{--			<div class="card">--}}

{{--				<div class="card-body">--}}



{{--					<h4 class="card-title">CAPTURE PAGES</h4>--}}

{{--					<p class="card-title-desc">Engage Your Visitor and Increase Conversations</p>--}}



{{--					<div id="carouselExampleFade21" class="carousel slide carousel-fade1" data-bs-ride="carousel" data-bs-interval="false">--}}

{{--						<ol class="carousel-indicators">--}}

{{--              <li data-bs-target="#carouselExampleFade21" data-bs-slide-to="0" class="active"></li>--}}

{{--              <li data-bs-target="#carouselExampleFade21" data-bs-slide-to="1"></li>--}}

{{--            </ol>--}}



{{--						<div class="carousel-inner" role="listbox">--}}

{{--							<div class="carousel-item active">--}}

{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h4>BIZOPP CAPTURE PAGES</h4>--}}

{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">--}}

{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}

{{--									</div>--}}



{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $10</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $30</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $120 (2 months FREE) $100</p>--}}

{{--									</div>--}}



{{--								</div>--}}

{{--							</div>--}}



{{--							<div class="carousel-item">--}}

{{--								<div class="card-body p-4 ">--}}

{{--									<div class="media">--}}

{{--										<div class="media-body">--}}

{{--											<h5></h5>--}}

{{--											<p class="text-muted"></p>--}}

{{--										</div>--}}

{{--										<div class="ms-3">--}}



{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="py-4">--}}

{{--										<h3>CUSTOM CAPTURE PAGES</h3>--}}



{{--									</div>--}}

{{--									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">--}}

{{--										<div class="text-center plan-btn">--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--											<a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--											<a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"  class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--										</div>--}}

{{--									</div>--}}

{{--									<div class="plan-features mt-5">--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $20</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $60</p>--}}

{{--										<p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $240 (2 months FREE) $200</p>--}}

{{--									</div>--}}

{{--								</div>--}}

{{--							</div>--}}



{{--						</div>--}}



{{--						<a class="carousel-control-prev" href="#carouselExampleFade21" role="button" data-bs-slide="prev">--}}

{{--              <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Previous</span>--}}

{{--            </a>--}}

{{--            <a class="carousel-control-next" href="#carouselExampleFade21" role="button" data-bs-slide="next">--}}

{{--              <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}

{{--              <span class="sr-only">Next</span>--}}

{{--            </a>--}}



{{--					</div>--}}

{{--				</div>--}}

{{--			</div>--}}

{{--		</div>--}}

{{--        <div class="col-xl-4 col-md-6">--}}

{{--            <div class="card plan-box">--}}

{{--                <div class="card-body p-4">--}}

{{--                    <div class="media">--}}

{{--                        <div class="media-body">--}}

{{--                            <h5></h5>--}}

{{--                            <p class="text-muted"></p>--}}

{{--                        </div>--}}

{{--                        <div class="ms-3">--}}

{{--                            <!-- <i class="bx bx-car h1 text-primary"></i> -->--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="py-4">--}}

{{--                        <h3>PHONE NUMBERS</h3>--}}

{{--                    </div>--}}


{{--                    <div class="text-center plan-btn">--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--                        <a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"--}}
{{--                           class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button"--}}
{{--                           style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                    </div>--}}


{{--                    <div class="plan-features mt-5">--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $1</p>--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $3</p>--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $12 (2 months FREE) $10</p>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}


{{--        <div class="col-xl-4 col-md-6">--}}

{{--            <div class="card plan-box">--}}

{{--                <div class="card-body p-4">--}}

{{--                    <div class="media">--}}

{{--                        <div class="media-body">--}}

{{--                            <h5></h5>--}}

{{--                            <p class="text-muted"></p>--}}

{{--                        </div>--}}

{{--                        <div class="ms-3">--}}

{{--                            <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top"--}}
{{--                               tooltip="Ringless voicemail and interactive voice response" data-toggle="tooltip"--}}
{{--                               data-placement="top" title="Tooltip on top">--}}

{{--                            </i>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="py-4">--}}

{{--                        <h3>RVM & IVR</h3>--}}

{{--                    </div>--}}

{{--                    <div class="text-center plan-btn">--}}

{{--                        <!-- <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a> -->--}}

{{--                    </div>--}}


{{--                    <div class="plan-features mt-5">--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Coming Soon</p>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="col-xl-4 col-md-6">--}}

{{--            <div class="card plan-box">--}}

{{--                <div class="card-body p-4">--}}

{{--                    <div class="media">--}}

{{--                        <div class="media-body">--}}

{{--                            <h5></h5>--}}

{{--                            <p class="text-muted"></p>--}}

{{--                        </div>--}}

{{--                        <div class="ms-3">--}}

{{--                            <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top"--}}
{{--                               tooltip="All tasks that take place within this (ACG) back-office" data-toggle="tooltip"--}}
{{--                               data-placement="top" title="Tooltip on top">--}}

{{--                            </i>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="py-4">--}}

{{--                        <h3>ABSOLUTELY DONE FOR YOU</h3>--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> In-House Virtual Assistance</p>--}}

{{--                    </div>--}}


{{--                    <div class="text-center plan-btn">--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">$200 / Week</a>--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">$600 / Month</a>--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">$4000 / Year</a>--}}

{{--                        <a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"--}}
{{--                           class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button"--}}
{{--                           style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                    </div>--}}

{{--                    <div class="plan-features mt-5">--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> $200 / Week &nbsp;&nbsp;</p>--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> $600 / Month&nbsp;&nbsp;</p>--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> $4000 / Year&nbsp;&nbsp;</p>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}


{{--        <div class="col-xl-4 col-md-6">--}}

{{--            <div class="card plan-box">--}}

{{--                <div class="card-body p-4">--}}

{{--                    <div class="media">--}}

{{--                        <div class="media-body">--}}

{{--                            <h5></h5>--}}

{{--                            <p class="text-muted"></p>--}}

{{--                        </div>--}}

{{--                        <div class="ms-3">--}}

{{--                            <!-- <i class="bx bx-car h1 text-primary"></i> -->--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="py-4">--}}

{{--                        <h3>CUSTOM CUSTOMER SUPPORT</h3>--}}

{{--                    </div>--}}


{{--                    <div class="text-center plan-btn">--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>--}}

{{--                        <a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"--}}
{{--                           class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button"--}}
{{--                           style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                    </div>--}}


{{--                    <div class="plan-features mt-5">--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> $180 / Week </p>--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> $700 / Month&nbsp;&nbsp;</p>--}}


{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> $8400 / Year (2 months FREE) $7000&nbsp;&nbsp;--}}
{{--                        </p>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}


{{--        <div class="col-xl-4 col-md-6">--}}

{{--            <div class="card plan-box">--}}

{{--                <div class="card-body p-4">--}}

{{--                    <div class="media">--}}

{{--                        <div class="media-body">--}}

{{--                            <h5></h5>--}}

{{--                            <p class="text-muted"></p>--}}

{{--                        </div>--}}

{{--                        <div class="ms-3">--}}

{{--                            <!-- <i class="bx bx-car h1 text-primary"></i> -->--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="py-4">--}}

{{--                        <h3>AUTOMATION</h3>--}}

{{--                    </div>--}}

{{--                    <div class="text-center plan-btn">--}}

{{--                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1"--}}
{{--                           data-id="custom_prospects"--}}
{{--                           data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*"--}}
{{--                           data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy</a>--}}

{{--                        <a href="#" onclick="cart(event.preventDefault(),'custom_prospects','')"--}}
{{--                           class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button"--}}
{{--                           style="padding: 0 10px"><i class="mdi mdi-cart-plus" style="font-size: 16px;"></i></a>--}}

{{--                    </div>--}}


{{--                    <div class="plan-features mt-5">--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Custom Automation </p>--}}


{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}


{{--        <div class="col-xl-4 col-md-6">--}}

{{--            <div class="card plan-box">--}}

{{--                <div class="card-body p-4">--}}

{{--                    <div class="media">--}}

{{--                        <div class="media-body">--}}

{{--                            <h5></h5>--}}

{{--                            <p class="text-muted"></p>--}}

{{--                        </div>--}}

{{--                        <div class="ms-3">--}}

{{--                            <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top"--}}
{{--                               tooltip="Ringless voicemail and interactive voice response" data-toggle="tooltip"--}}
{{--                               data-placement="top" title="Tooltip on top">--}}

{{--                            </i>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="py-4">--}}

{{--                        <h3>List Cleaner</h3>--}}

{{--                    </div>--}}

{{--                    <div class="text-center plan-btn">--}}

{{--                        <!-- <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>--}}

{{--                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a> -->--}}

{{--                    </div>--}}


{{--                    <div class="plan-features mt-5">--}}

{{--                        <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Coming Soon</p>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}




        <!-- <div class="col-xl-4 col-md-6">

            <div class="card plan-box">

                <div class="card-body p-4">

                    <div class="media">

                        <div class="media-body">

                            <h5></h5>

                            <p class="text-muted"></p>

                        </div>

                        <div class="ms-3">

                        </div>

                    </div>

                    <div class="py-4">

                        <h4>UNLIMITED BUSINESS COMMUNICATION</h4>

                    </div>



                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-inner" role="listbox">

                            <div class="carousel-item active">

                                <h2><sup><small>$</small></sup> 300/<span class="font-size-13">Per month</span></h2>

                                <div class="text-center plan-btn">

                                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_communication" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>

                                </div>



                            </div>

                            <div class="carousel-item">

                                <h2><sup><small>$</small></sup> 3000/<span class="font-size-13">Per year</span></h2>

                                <div class="text-center plan-btn">

                                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_communication" data-time="year" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy yearly</a>

                                </div>

                            </div>

                        </div>

                    </div>



                {{-- </div> --}}

                {{-- <div class="text-center plan-btn">

                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_communication" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>

                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_communication" data-time="year" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy yearly</a>

                </div> --}}



                <div class="plan-features mt-5">

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Minutes</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Text</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Email</p>

                </div>

            </div>

        </div> -->
        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

            <div class="card-body p-4">

                <div class="media">

                    <div class="media-body">

                        <h5></h5>

                        <p class="text-muted"></p>

                    </div>

                    <div class="ms-3">

                    </div>

                </div>

                <div class="py-4">

                    <h4>UNLIMITED CONTACT GENERATION AND COMMUNICATION</h4>



                </div>

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-inner" role="listbox">

                        <div class="carousel-item active">

                            <h2><sup><small>$</small></sup> 550/<span class="font-size-13">Per month (26% Discount $407)</span></h2>

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_both" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>

                            </div>

                        </div>

                        <div class="carousel-item">

                            <h2><sup><small>$</small></sup> 6600/<span class="font-size-13">Per year (52% Discount $3168)</span></h2>

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_both" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- <div class="text-center plan-btn">

                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_both" data-time="month" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy monthly</a>

                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="unlimited_both" data-time="year" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy yearly</a>

                </div> --}}



                <div class="plan-features mt-5">

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Contacts</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Minutes</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Text</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Unlimited Email</p>

                </div>

            </div>

        </div>

        </div> -->

        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

            <div class="card-body p-4">

                <div class="media">

                    <div class="media-body">

                        <h5></h5>

                        <p class="text-muted"></p>

                    </div>

                    <div class="ms-3">

                        <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A bizopp lead is some who expressed interest in your online business by submitting their info on a (capture)page" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                        </i>

                    </div>

                </div>

                <div class="py-4">

                    <h4>BIZOPP LEADS</h4>

                </div>

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-inner" role="listbox">

                        <div class="carousel-item active">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_leads" data-time="30" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 30</a>

                            </div>

                        </div>

                        <div class="carousel-item">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_leads" data-time="130" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 130</a>

                            </div>

                        </div>

                        <div class="carousel-item">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_leads" data-time="800" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 400</a>

                            </div>

                        </div>

                    </div>

                </div>





                <div class="plan-features mt-5">

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 30 Leads for $100</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 130 Leads for $300</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 400 Leads for $800</p>

                </div>

            </div>

        </div>

        </div> -->
        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

            <div class="card-body p-4">

                <div class="media">

                    <div class="media-body">

                        <h5></h5>

                        <p class="text-muted"></p>

                    </div>

                    <div class="ms-3">

                        <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A custom lead is someone who expressed interest in any business of choice by submitting their info on a (capture)page" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                        </i>

                    </div>

                </div>

                <div class="py-4">

                    <h4>CUSTOM LEADS</h4> <h6>Contact for pricing</h6>

                </div>

                <div class="text-center plan-btn">

                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_biz_opp_leads" data-label="PLEASE DESCRIBE YOUR BUSINESS AND LEAD REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy</a>

                </div>



                <div class="plan-features mt-5">

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Custom requirements</p>

                </div>

            </div>

        </div>

        </div> -->
        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

            <div class="card-body p-4">

                <div class="media">

                    <div class="media-body">

                        <h5></h5>

                        <p class="text-muted"></p>

                    </div>

                    <div class="ms-3">

                        <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="An inhouse prospect is someone who expressed interest in ACG by engaging with a sales agent over phone, text or email" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                        </i>

                    </div>

                </div>

                <div class="py-4">

                    <h3>INHOUSE PROSPECTS</h3>

                </div>

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-inner" role="listbox">

                        <div class="carousel-item active">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_prospects" data-time="50" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 50</a>

                            </div>

                        </div>

                        <div class="carousel-item">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button" data-id="biz_opp_prospects" data-time="100" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Buy 100</a>

                            </div>

                        </div>

                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">

                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                        <span class="sr-only">Previous</span>

                    </a>

                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">

                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                        <span class="sr-only">Next</span>

                    </a>

                </div>





                <div class="plan-features mt-5">

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 15 Prospects for $105</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 50 Leads for $300</p>

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> 100 Leads for $500</p>

                </div>

            </div>

        </div>

        </div> -->
        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

            <div class="card-body p-4">

                <div class="media">

                    <div class="media-body">

                        <h5></h5>

                        <p class="text-muted"></p>

                    </div>

                    <div class="ms-3">

                        <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A custom prospect is someone who expressed interest in any business of your choice by engaging with a sales agent over phone, text or email" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                        </i>

                    </div>

                </div>

                <div class="py-4">

                    <h3>CUSTOM PROSPECTS</h3> <h6>Contact for pricing</h6>

                </div>

                <div class="text-center plan-btn">

                    <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy</a>

                </div>



                <div class="plan-features mt-5">

                    <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Custom requirements</p>

                </div>

            </div>

        </div>

        </div> -->
        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

            <div class="card-body p-4">

                <div class="media">

                    <div class="media-body">

                        <h5></h5>

                        <p class="text-muted"></p>

                    </div>

                    <div class="ms-3">

                        <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="An inhouse sales funnel is a mini website where someone submits their info then lands on a page that calls them to action on behalf of ACG" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                        </i>

                    </div>

                </div>

                <div class="py-4">

                    <h3>INHOUSE SALES FUNNELS</h3>

                </div>

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-inner" role="listbox">



                        <div class="carousel-item">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

                            </div>

                        </div>

                        <div class="carousel-item">

                            <div class="text-center plan-btn">

                                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

                            </div>

                        </div>

                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">

                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                        <span class="sr-only">Previous</span>

                    </a>

                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">

                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                        <span class="sr-only">Next</span>

                    </a>

                </div>

            </div>

            {{-- <div class="text-center plan-btn">

                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

            </div> --}}



            <div class="plan-features mt-5">

                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $10</p>

                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $30</p>

                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $120 (2 months FREE) $100</p>

            </div>

        </div>

        </div>





        <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

        <div class="card-body p-4">

            <div class="media">

                <div class="media-body">

                    <h5></h5>

                    <p class="text-muted"></p>

                </div>

                <div class="ms-3">

                    <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A bizopp sales funnel is a mini website where someone submits their info then lands on a page that calls them to action on behalf of your online business" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                    </i>

                </div>

            </div>

            <div class="py-4">

                <h3>BIZOPP SALES FUNNELS</h3>

            </div>

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner" role="listbox">



                    <div class="carousel-item">

                        <div class="text-center plan-btn">

                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

                        </div>

                    </div>

                    <div class="carousel-item">

                        <div class="text-center plan-btn">

                            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

                        </div>

                    </div>

                </div>

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">

                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                    <span class="sr-only">Previous</span>

                </a>

                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">

                    <span class="carousel-control-next-icon" aria-hidden="true"></span>

                    <span class="sr-only">Next</span>

                </a>

            </div>

            {{-- <div class="text-center plan-btn">

                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

                <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

            </div> --}}



            <div class="plan-features mt-5">

                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $30</p>

                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $90</p>

                <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $360 (2 months FREE) $300</p>

            </div>

        </div>

        </div>

        </div>



        <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

        <div class="card-body p-4">

            <div class="media">

                <div class="media-body">

                    <h5></h5>

                    <p class="text-muted"></p>

                </div>

                <div class="ms-3">

                    <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A custom sales funnel is a mini website where someone submits their info then lands on a page that calls them to action on behalf any business of your choice" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                    </i>

                </div>

            </div>

            <div class="py-4">

                <h3>CUSTOM SALES FUNNELS</h3>

            </div>

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner" role="listbox">

                    <div class="text-center plan-btn">

                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

                    </div>

                </div>

                <div class="carousel-item">

                    <div class="text-center plan-btn">

                        <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

                    </div>

                </div>

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">

                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                    <span class="sr-only">Previous</span>

                </a>

                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">

                    <span class="carousel-control-next-icon" aria-hidden="true"></span>

                    <span class="sr-only">Next</span>

                </a>

            </div>

        {{-- </div> --}}

        {{-- <div class="text-center plan-btn">

            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

        </div> --}}



        <div class="plan-features mt-5">

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $90</p>

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $270</p>

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $1080 (2 months FREE) $900</p>

        </div>

        </div>

        </div>

        </div> -->
        <!-- <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

        <div class="card-body p-4">

            <div class="media">

                <div class="media-body">

                    <h5></h5>

                    <p class="text-muted"></p>

                </div>

                <div class="ms-3">

                    <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A bizopp capture page is the first part of a sales funnel, where the visitor submits their info and redirects to your online business link or website" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                    </i>

                </div>

            </div>

            <div class="py-4">

                <h3>BIZOPP CAPTURE PAGES</h3>

            </div>





        <div class="text-center plan-btn">

            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

        </div>



        <div class="plan-features mt-5">

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $10</p>

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $30</p>

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $120 (2 months FREE) $100</p>

        </div>

        </div>

        </div>

        </div>



        <div class="col-xl-4 col-md-6">

        <div class="card plan-box">

        <div class="card-body p-4">

            <div class="media">

                <div class="media-body">

                    <h5></h5>

                    <p class="text-muted"></p>

                </div>

                <div class="ms-3">

                    <i class="bx bx-question-mark h1 text-primary tooltips" tooltip-position="top" tooltip="A custom capture page is the first part of a sales funnel, where the visitor submits their info and redirects to your link or website" data-toggle="tooltip" data-placement="top" title="Tooltip on top">

                    </i>

                </div>

            </div>

            <div class="py-4">

                <h3>CUSTOM CAPTURE PAGES</h3>

            </div>

        <div class="text-center plan-btn">

            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Quarterly</a>

            <a href="#" class="btn btn-primary btn-sm waves-effect waves-light upload-modal-button1" data-id="custom_prospects" data-label="PLEASE DESCRIBE YOUR BUSINESS AND PROSPECT REQUIREMENTS IN DETAIL AND SUPPORT WILL REACH OUT TO YOU*" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Buy Yearly</a>

        </div>



        <div class="plan-features mt-5">

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Monthly $20</p>

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Quartly $60</p>

            <p><i class="bx bx-checkbox-square text-primary mr-2"></i> Yearly $240 (2 months FREE) $200</p>

        </div>

        </div>

        </div>

        </div> -->

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


			{{--function cart(e,id,time){--}}

			{{--	// let package_id=$(this).attr('package_name')--}}



			{{--	$.ajax({--}}

			{{--	url: '{{ url('cart') }}',--}}

			{{--	method: "post",--}}

			{{--	data: {--}}

			{{--		_token: '{{ csrf_token() }}',--}}

			{{--		package_id:id,--}}

			{{--		time:time,--}}

			{{--	},--}}

			{{--	success: function (response) {--}}

			{{--		$(".cartCount").fadeOut(400, function () {--}}

			{{--				$(this).text(response.count).fadeIn(400);--}}

			{{--		});--}}

			{{--	}--}}

			{{--});--}}

			{{--}--}}



		</script>

	@endsection
