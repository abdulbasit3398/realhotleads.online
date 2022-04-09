@extends('layouts.user')

@section('custom-css')

@endsection

@section('page-content')
 
<div class="container-fluid">

	
	<div class="row justify-content-center">
		<div class="col-lg-12">
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
			</div>
		</div>
	</div>
	


	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">Send Payment</h4>

				<div class="page-title-right">
					 
				</div>

			</div>
		</div>
	</div>
	<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
        	<form method="post" action="{{route('proceed-payment')}}">
						@csrf        	
	          <div class="mb-3 row">
					    <label for="example-text-input" class="col-md-2 col-form-label">Receipent e-mail*</label>
					    <div class="col-md-10">
					      <input class="form-control" type="text" name="user_email" id="example-text-input" placeholder="Enter e-mail address">
					    </div>
					  </div>

					  <div class="mb-3 row">
					    <label for="example-text-input" class="col-md-2 col-form-label">Amount*</label>
					    <div class="col-md-10">
					    	<div class="input-group">
	                <div class="input-group-text">$</div>
	                <input type="number" class="form-control" name="amount" min="0" required value="10" id="inlineFormInputGroupUsername" placeholder="Amount to send">
	              </div>
					    </div>
					  </div>

					  <div class="mb-3 row">
					    <label for="example-text-input" class="col-md-2 col-form-label">Description</label>
					    <div class="col-md-10">
					    	<textarea class="form-control" rows="5" name="description"></textarea>
					    </div>
					  </div>

					  <div class="mb-3 row">
					    <div class="col-md-10">
					    	<button type="submit" class="btn btn-primary w-md">Send</button>
					    </div>
					  </div>
				  </form>
        </div>
      </div>
    </div>
  </div>                           

                                        

 
	

	 
 
	
</div>
@endsection

@section('scripts')
 


@endsection