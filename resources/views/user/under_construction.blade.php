@extends('layouts.user_under_construction')

@section('container')

<div class="row">
	<div class="col-12 text-center">
		<div class="home-wrapper">
			<div class="mb-5">
				<a href="{{('dashboard')}}" class="d-block auth-logo">
					<img src="{{('assets/images/logo.png')}}" alt="" width="200" class="auth-logo-dark mx-auto">
					<img src="assets/images/logo-light.png" alt="" height="20" class="auth-logo-light mx-auto">
				</a>
			</div>


			<div class="row justify-content-center">
				<div class="col-sm-4">
					<div class="maintenance-img">
						<img src="assets/images/maintenance.svg" alt="" class="img-fluid mx-auto d-block">
					</div>
				</div>
			</div>
			<h3 class="mt-5">{{(isset($message)) ? $message : ''}}</h3>
			<p>Please check back in sometime.</p>

			
				<!-- end row -->
			</div>
		</div>
	</div>

	@endsection