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
                  <p>Get your account now.</p>
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
                    <img src="{{asset('assets/images/favicon.png')}}" alt="" class="rounded-circle" height="34">
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
              <form method="POST" action="{{route('guest_register')}}">
                <input type="hidden" name="website" value="{{$website}}">
                @csrf
                <!-- <div class="mb-3">
                  <label for="referal_user" class="form-label">{{ __('Referal Username') }}</label>
                  <input id="referal_user" type="text" class="form-control" name="referal_user" value="{{ old('referal_user') }}">

                </div> -->
                {{-- <div class="mt-4 d-grid">
                  <button class="btn btn-primary waves-effect waves-light" type="submit">Continue as Guest</button>
                </div> --}}

              </form>

              <form method="POST" action="{{ route('create_free') }}">
                <input type="hidden" name="website" value="{{$website}}">
                @csrf
                <div class="mb-3">
                  <label for="referal_user" class="form-label">{{ __('Referal Username') }}</label>
                  <input id="referal_user" type="text" class="form-control" name="referal_user" value="{{ old('referal_user') }}">

                </div>

                <div class="mb-3">
                  <label for="useremail" class="form-label">{{ __('Username/E-Mail Address') }}*</label>
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                  <div class="invalid-feedback">
                    Please Enter {{ __('E-Mail Address') }}
                  </div>      
                </div>
                <!-- <div class="mb-3">
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
                </div> -->
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
                  <label for="userpassword" class="form-label">{{ __('Password') }}</label>
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
                  <label for="userpassword" class="form-label">{{ __('Confirm Password') }}</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  <div class="invalid-feedback">
                    Please Renter {{ __('Password') }}
                  </div>       
                </div>

                <div class="mb-3">
                  <label for="userpassword" class="form-label">Coupon Code</label>
                  <input id="coupon_code" type="text" class="form-control" name="coupon_code" autocomplete="coupon_code">
                         
                </div>

                <!-- <div class="form-check mb-3 py-2 px-4" style="background: #f8f8fb;">
    
                  <input class="form-check-input" type="checkbox" name="affiliate" value="1" id="formCheck1">
                  <label class="form-check-label" for="formCheck1">
                      Become Affiliate
                  </label>
                  <p>
                    33% commission on personal sales and payments. 3% on all referred members sales and payments.  $100 affiliate account fee
                  </p>
                </div> -->

                <div class="mt-4 d-grid">
                  <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                </div>

                <div class="mt-4 text-center">
                  
             