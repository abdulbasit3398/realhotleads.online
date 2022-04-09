	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="text-center">
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

				@if(\Session::has('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{!! \Session::get('error') !!}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endif
			</div>
		</div>
	</div>