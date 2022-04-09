@extends('layouts.user')

@section('custom-css')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" /> 
@endsection
@section('scripts')
   <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
    {{-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> --}}
	
@endsection

@section('page-content')

@php

$withdrawable = 0;
$non_withdrawable = 0;

if(\Auth::user()->user_wallet)
{
	$withdrawable = \Auth::user()->user_wallet->withdrawable_funds;
	$non_withdrawable = \Auth::user()->user_wallet->non_withdrawable_funds;
}

@endphp

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 style="margin: 0;">Deposit Payment</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body upload-modal-body">
				<div class="alert alert-danger error-alert" role="alert" style="display: none;">

				</div>
				<form method="POST"  class="require-validation" action="{{route('deposit-into-wallet')}}" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
					@csrf
					<input type="hidden" name="package_id" id="package_id">
					<input type="hidden" name="time" id="time">
					
	{{-- <div id="paypal-button-container"></div> --}}
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

					<div class="mb-3 row">
						<div class="col-md-6">
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
						<div class="col-md-6">
							<label for="cvc" class="form-label">Enter Amount to deposit*</label>
							<label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
              <div class="input-group">
                  <div class="input-group-text">$</div>
                  <input type="number" class="form-control" name="amount" min="0" required value="10" id="inlineFormInputGroupUsername" placeholder="Amount">
              </div>
        
						</div>
					
					</div>
									  <!-- Set up a container element for the button -->
                     
					<div class="mb-3">
						<button type="submit" class="btn btn-primary w-md">Deposit</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="DepositPaypalModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 style="margin: 0;">Deposit Payment</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body upload-modal-body">
				<div class="alert alert-success error-alert" role="alert" style="display: none;">

				</div>
				
					<div class="alert alert-danger alert-dismissible fade show payment_error" style="display: none" role="alert">
					  <span id="amount_error"><strong>Oops!</strong> something went wrong while executing payment for your order. Please try again. For more details: <span id="error_msg"></span></span>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				 
				<form action="" class="needs-validation" novalidate id="paypal_form">
					<input name="contractId" value="3330534" type="hidden">
					<input name="overrideName" type="hidden" value="Credit Added">
					<input type="hidden" name="user" value="{{Auth::id()}}">
					<input type='hidden' id="login_user_email" name='email' value='{{Auth::user()->email}}' />
					<input name="firstName" type="hidden" value="{{Auth::user()->name}}" />
					<input type="hidden" name="currency" id="currency_id" value="USD">
					<input name="custom1" type="hidden" value="add-credit">
					<div class="input-group mb-3">
					  <span class="input-group-text">$</span>
					  <input type="number" placeholder="Amount to add" name="quantity" min="10" id="quantity" class="form-control" value="10" required>
					  <span class="input-group-text">.00</span>
					</div>
					<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&disable-funding=credit,venmo,bancontact,sepa,eps,giropay,ideal,mybank,p24,sofort"> // &disable-funding=credit,card,venmo,bancontact,sepa,eps,giropay,ideal,mybank,p24,sofort
					</script>
		  
					<div id="paypal-button-container" ></div>
				  </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

 


<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 style="margin: 0;">Withdraw Payment</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body upload-modal-body">
				<div class="alert alert-danger error-alert" role="alert" style="display: none;">

				</div>
				<form method="POST" class="require-validation1" action="{{route('withdraw-funds')}}">
					@csrf

					<div class="mb-3 row">
						
						<div class="col-md-6">
							<label for="cvc" class="form-label">Enter Amount to withdraw*</label>
							<label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
              <div class="input-group">
                  <div class="input-group-text">$</div>
                  <input type="number" class="form-control" name="amount" min="0" max="{{$withdrawable}}" required id="inlineFormInputGroupUsername" placeholder="Amount">
              </div>

						</div>
					</div>
	
					<div class="mb-3">
						<button type="submit" class="btn btn-primary w-md">Withdraw</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>


<div class="container-fluid">
<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="text-center mb-5">
				@if(\Session::has('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{!! \Session::get('success') !!}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endif
				@if(\Session::has('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{!! \Session::get('error') !!}
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

			</div>
		</div>
	</div>
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">Wallet</h4>

				<div class="page-title-right">
					 
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row">
		<div class="col-xl-4">
			<div class="card">
				<div class="card-body">
					
					<div class="media">
						<div class="me-4">
							<i class="mdi mdi-account-circle text-primary h1"></i>
						</div>

						<div class="media-body">
							<div class="text-muted">
								<h5>{{\Auth::user()->first_name.' '.\Auth::user()->last_name}}</h5>
								<p class="mb-1">{{\Auth::user()->email}}</p>
							</div>
							
						</div>

						<div class="dropdown ms-2">
							<!-- <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="mdi mdi-dots-horizontal font-size-18"></i>
							</a> -->
							
							<!-- <div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div> -->
						</div>
					</div>
				</div>
				<div class="card-body border-top">
					
					<div class="row">
						<div class="col-sm-6">
							<div>
								<p class="text-muted mb-2">Available Balance</p>
								@if(\Auth::user()->user_wallet)
								<h5>$ {{number_format($withdrawable + $non_withdrawable , 2)}}</h5>
								@else
								<h5>$ 0</h5>
								@endif
							</div>
						</div>
						<div class="col-sm-6">
							<div class="text-sm-end mt-4 mt-sm-0">
								<p class="text-muted mb-2"> </p>
								{{-- .bs-example-modal-lg --}}
								<a href="#" class="btn btn-primary btn-sm w-md" data-id="unlimited_contacts" data-time="year" data-bs-toggle="modal" data-bs-target="#DepositPaypalModal">Deposit</a>
								
							</div>
						</div>
					</div>
				</div>

				<div class="card-body border-top">
					<p class="text-muted mb-4"></p>
					<div class="text-center">
						<div class="row">
							<div class="col-sm-4">
								<div>
									<div class="font-size-24 text-primary mb-2">
										<i class="bx bx-send"></i>
									</div>
									
									<p class="text-muted mb-2">Send</p>
									<h5>$ {{$data['total_send']}}</h5>
									
									<div class="mt-3">
										<a href="{{route('send-payment')}}" class="btn btn-primary btn-sm w-md">Send</a>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mt-4 mt-sm-0">
									<div class="font-size-24 text-primary mb-2">
										<i class="bx bx-import"></i>
									</div>
									
									<p class="text-muted mb-2">Receive</p>
									<h5>$ {{$data['total_receive']}}</h5>
									
									<div class="mt-3">
										<a href="{{route('request-payment')}}" class="btn btn-primary btn-sm w-md">Request</a>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mt-4 mt-sm-0">
									<div class="font-size-24 text-primary mb-2">
										<i class="bx bx-wallet"></i>
									</div>
									
									<p class="text-muted mb-2">Withdraw</p>
									<h5>$ {{$data['total_withdraw']}}</h5>
									
									<div class="mt-3">
										<a href="#" class="btn btn-primary btn-sm w-md" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Withdraw</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		
		<div class="col-xl-8">
			<div class="row">
				<div class="col-sm-4">
					<div class="card mini-stats-wid">
						<div class="card-body">
							<div class="media">
								<div class="me-3 align-self-center">
									<i class="mdi mdi-bitcoin h2 text-warning mb-0"></i>
								</div>
								<div class="media-body">
									<p class="text-muted mb-2">Bitcoin Wallet</p>
									<h5 class="mb-0">1.02356 BTC <span class="font-size-14 text-muted">= $ 9148.00</span></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card mini-stats-wid">
						<div class="card-body">
							<div class="media">
								<div class="me-3 align-self-center">
									<i class="mdi mdi-ethereum h2 text-primary mb-0"></i>
								</div>
								<div class="media-body">
									<p class="text-muted mb-2">Ethereum Wallet</p>
									<h5 class="mb-0">0.04121 ETH <span class="font-size-14 text-muted">= $ 8235.00</span></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card mini-stats-wid">
						<div class="card-body">
							<div class="media">
								<div class="me-3 align-self-center">
									<i class="mdi mdi-litecoin h2 text-info mb-0"></i>
								</div>
								<div class="media-body">
									<p class="text-muted mb-2">litecoin Wallet</p>
									<h5 class="mb-0">0.00356 BTC <span class="font-size-14 text-muted">= $ 4721.00</span></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->

			<div class="card">
				<div class="card-body">
					<h4 class="card-title mb-3">Overview</h4>

					<div>
						<div id="overview-chart" class="apex-charts" dir="ltr"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end row -->
	<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
         <div class="row">
           <div class="col-md-6">
             <h4 class="card-title mb-4">Checking Account Information</h4>
           </div>
           <div class="col-md-6">
             <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="float: right;">
              Update
          </a>
           </div>
         </div>
        
        
      <div class="collapse" id="collapseExample">
        <div class="card border shadow-none card-body text-muted mb-0">
          <form action="{{route('edit-user-profile')}}" method="POST">
            @csrf
            <input type="hidden" name="bank_details" value="1">
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="bank_name" value="{{\Auth::user()->bank_detail('bank_name')}}">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Account Holder Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="account_holder_name" value="{{\Auth::user()->bank_detail('account_holder_name')}}">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Account #</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="account_number" value="{{\Auth::user()->bank_detail('account_number')}}">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Routing #</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="routing_number" value="{{\Auth::user()->bank_detail('routing_number')}}">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
        <div class="table-responsive">
          <table class="table table-nowrap mb-0">
            <tbody>
              <tr>
                <th scope="row">Bank Name :</th>
                <td>{{\Auth::user()->bank_detail('bank_name')}}</td>
              </tr>
              <tr>
                <th scope="row">Account Holder Name :</th>
                <td>{{\Auth::user()->bank_detail('account_holder_name')}}</td>
              </tr>
              <tr>
                <th scope="row">Account # :</th>
                <td>
                 {{\Auth::user()->bank_detail('account_number')}}
               </tr>
               <tr>
                <th scope="row">Routing # :</th>
                <td>
                 {{\Auth::user()->bank_detail('routing_number')}}
               </tr>

              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>


  </div>

  <div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
         <div class="row">
           <div class="col-md-6">
             <h4 class="card-title mb-4">Bank Card Information</h4>
           </div>
           <div class="col-md-6">
             <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1" style="float: right;">
              Update
          </a>
           </div>
         </div>
        
      <div class="collapse" id="collapseExample1">
        <div class="card border shadow-none card-body text-muted mb-0">
          <form action="{{route('edit-user-profile')}}" method="POST">
            @csrf
            <input type="hidden" name="bank_details" value="1">
            
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Card Holder Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="card_holder_name" value="{{\Auth::user()->bank_detail('card_holder_name')}}">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Card Number</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="card_number" value="{{\Auth::user()->bank_detail('card_number')}}" placeholder="1234 1234 1234 1234">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Card Expiry</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="card_expiry" value="{{\Auth::user()->bank_detail('card_expiry')}}" placeholder="MM/YYYY">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">CVC</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="card_cvc" value="{{\Auth::user()->bank_detail('card_cvc')}}" placeholder="123">
              </div>
            </div>
            <div class="row mb-4">
              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
        
          <div class="table-responsive">
          <table class="table table-nowrap mb-0">
            <tbody>
              
               <tr>
                <th scope="row">Card Holder Name :</th>
                <td>
                 {{\Auth::user()->bank_detail('card_holder_name')}}
               </tr>
               <tr>
                <th scope="row">Card Number :</th>
                <td>
                 {{\Auth::user()->bank_detail('card_number')}}
               </tr>
               <tr>
                <th scope="row">Card Expiry :</th>
                <td>
                 {{\Auth::user()->bank_detail('card_expiry')}}
               </tr>
               <tr>
                <th scope="row">CVC :</th>
                <td>
                 {{\Auth::user()->bank_detail('card_cvc')}}
               </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title mb-4">Activities</h4>
					<div class="row">
						<div class="col-md-4">
							<!-- Nav tabs -->
		          <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
		            <li class="nav-item">
		              <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
		                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
		                <span class="d-none d-sm-block">Deposit</span> 
		              </a>
		            </li>
		            <li class="nav-item">
		              <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
		                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
		                <span class="d-none d-sm-block">Send</span> 
		              </a>
		            </li>
		            <li class="nav-item">
		              <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
		                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
		                <span class="d-none d-sm-block">Receive</span>   
		              </a>
		            </li>
		            <li class="nav-item">
		              <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
		                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
		                <span class="d-none d-sm-block">Withdraw</span>    
		              </a>
		            </li>
		          </ul>
						</div>
					</div>
					
          
          <!-- Tab panes -->
          <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="home1" role="tabpanel">
              <table class="table">
              	<thead>
              		<tr>
              			<th>Date</th>
              			<th>Payment ID</th>
              			<th>Amount</th>
              		</tr>
              	</thead>
              	<tbody>
              		@foreach($data['deposits'] as $deposit)
              		<tr>
              			<td>{{date('Y-m-d',strtotime($deposit->created_at))}}</td>
              			<td>{{$deposit->payment_id}}</td>
              			<td>{{$deposit->currency.' '.$deposit->amount}}</td>
              		</tr>
              		@endforeach
              	</tbody>
              </table>
            </div>
            <div class="tab-pane" id="profile1" role="tabpanel">
              <table class="table">
              	<thead>
              		<tr>
              			<th>Date</th>
              			<th>Recipient</th>
              			<th>Description</th>
              			<th>Amount</th>
              		</tr>
              	</thead>
              	<tbody>
              		@foreach($data['send'] as $send)
              		<tr>
              			<td>{{date('Y-m-d',strtotime($send->created_at))}}</td>
              			<td>{{$send->sender_recipient_user->email}}</td>
              			<td>{{$send->description}}</td>
              			<td>{{$send->currency.' '.$send->amount}}</td>
              		</tr>
              		@endforeach
              	</tbody>
              </table>
            </div>
            <div class="tab-pane" id="messages1" role="tabpanel">
              <table class="table">
              	<thead>
              		<tr>
              			<th>Date</th>
              			<th>Sender</th>
              			<th>Description</th>
              			<th>Amount</th>
              		</tr>
              	</thead>
              	<tbody>
              		@foreach($data['receive'] as $receive)
              		<tr>
              			<td>{{date('Y-m-d',strtotime($receive->created_at))}}</td>
              			<td>{{$receive->sender_recipient_user->email}}</td>
              			<td>{{$receive->description}}</td>
              			<td>{{$receive->currency.' '.$receive->amount}}</td>
              		</tr>
              		@endforeach
              	</tbody>
              </table>
            </div>
            <div class="tab-pane" id="settings1" role="tabpanel">
              <table class="table">
              	<thead>
              		<tr>
              			<th>Date</th>
              			<th>Amount</th>
              			<th>Status</th>
              		</tr>
              	</thead>
              	<tbody>
              		@foreach($data['withdraw'] as $withdraw)
              		<tr>
              			<td>{{date('Y-m-d',strtotime($withdraw->created_at))}}</td>
              			<td>{{$withdraw->currency.' '.$withdraw->amount}}</td>
              			<td>{{ucfirst($withdraw->status)}}</td>
              		</tr>
              		@endforeach
              	</tbody>
              </table>
            </div>
          </div>


					 
				</div>
			</div>
		</div>
	</div>
	<!-- end row -->
	
</div>
@endsection

@section('scripts')
<!-- apexcharts -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- crypto-wallet init -->
<script src="{{asset('assets/js/pages/crypto-wallet.init.js')}}"></script>

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

    //   paypal.Buttons({

    //     // Sets up the transaction when a payment button is clicked
    //     createOrder: function(data, actions) {
    //       return actions.order.create({
    //         purchase_units: [{
    //           amount: {
    //             value: '77.44' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
    //           }
    //         }]
    //       });
    //     },

    //     // Finalize the transaction after payer approval
    //     onApprove: function(data, actions) {
    //       return actions.order.capture().then(function(orderData) {
    //         // Successful capture! For dev/demo purposes:
    //             console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
    //             var transaction = orderData.purchase_units[0].payments.captures[0];
    //             alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

    //         // When ready to go live, remove the alert and show a success message within this page. For example:
    //         // var element = document.getElementById('paypal-button-container');
    //         // element.innerHTML = '';
    //         // element.innerHTML = '<h3>Thank you for your payment!</h3>';
    //         // Or go to another URL:  actions.redirect('thank_you.html');
    //       });
    //     }
    //   }).render('#paypal-button-container');


</script>
@push('script-js')
<script type="text/javascript">
	$(document).ready(function(){
	  var overrideName = $('input[name="overrideName"]').val();
	  var currency = $('#currency_id').val();
	  var firstName = $('input[name="firstName"]').val();
	  var email = $('#login_user_email').val();
	  var user_id = $('input[name="user"]').val();
	  var client_id = $('input[name="client_id"]').val();
	  var public_url = '{{url("/")}}';
	  var dt = new Date();
	  var get_time = dt.getTime();
	  
	  paypal.Buttons({
	
		createOrder: function(data, actions) {
		  amount = $('#quantity').val();
		  // if(amount == '')
			// amount = 10;
		  // This function sets up the details of the transaction, including the amount and line item details.
		  return actions.order.create({
			purchase_units: [{
			  amount: {
				value: amount
			  },
			  description: overrideName,
			  invoice_id: user_id+",credit,"+get_time,
			}],
		  });
		},
	
	
		onApprove: function(data, actions) {
		  return actions.order.capture().then(function(details) {
			//$('#loading_page').show();
			$('#loading').show();
			// Call your server to save the transaction
			// window.location.href = window.location.href;
			$('#paypal_payment_success').show();
			fetch(public_url+'/add_credit_paypal', {
			  method: 'post',
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				'content-type': 'application/json',
			  },
			  body: JSON.stringify({
				orderID: data.orderID,
				description: overrideName,
				amount: amount,
				capture: details,
			  }),
	
			}).then(function(response) {
			  // console.log(response);
			  $('#loading').hide();
			//   $('.event_msg_heading').html('<h5>Success</h5>');
			  $('.error-alert').text('Funds deposit into your account.').show();
			//   $('.toast-success').toast('show').removeClass('d-none');
			  setTimeout(function(){ 
				location.reload();
			  }, 3100);
			});
			
			
		  });
		},
		onClick: function()  {
		  $('.payment_error').hide();
		  console.log('click');
		},
		onCancel: function(data, actions) {
		  $('#loading').hide();
		  // actions.redirect();
		  console.log('close');
		},
		onError: function (err) {
		  $('#loading').hide();
		  console.log(err);
		  if(err){
			var val = $('#quantity').val();
			if(val == '' || val <= 0){
			  if(val <= 0){
				$('#paypal_form').removeClass('was-validated');
			  }else{
				$('#paypal_form').addClass('was-validated');
			  }
			  $('#amount_error').html('Please enter credit amount to redeem <span id="error_msg"></span>');
			}else{
			  $('#error_msg').text(err);
			}
		  }
		  
		  $('.payment_error').show();
		  
			//   $.ajax({
			// 	type: "post",
			// 	url: public_url+"/SavePaymentError",
			// 	data: {error_data: err},
			// 	dataType: "json",
			// 	success: function (response) {
				
			// 	}
			//   });
			// For example, redirect to a specific error page
			// window.location.href = "/your-error-page-here";
		}
	
	  }).render('#paypal-button-container');
	
	});
	</script>
@endpush
@endsection