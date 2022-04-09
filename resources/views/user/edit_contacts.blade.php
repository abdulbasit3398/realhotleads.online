@extends('layouts.user')

@section('custom-css')

@endsection

@section('page-content')

 @include('user.validation_message') 

<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Edit Contact</h4>

					<form method="post" action="{{route('update-user-contact')}}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="contact_id" value="{{$contact->id}}">
						<div class="row">
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label">Name*</label>
									<input type="text" name="contact_name" value="{{$contact->contact_name}}" class="form-control">
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label">Phone#</label>
									<input type="text" name="phone_no" value="{{$contact->contact_phone}}" class="form-control">
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label">Email</label>
									<input type="email" name="email" value="{{$contact->contact_email}}" class="form-control">
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label">Company</label>
									<input type="text" name="company" value="{{$contact->company_name}}" class="form-control">
								</div>
							</div>
							<div class="col-md-12 mb-3">
								<div class="form-group">
									<label class="form-label">Notes</label>
									<textarea class="form-control" rows="5" name="note">{{$contact->notes}}</textarea>
								</div>
							</div>

							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label">Update File</label>
									<small>Max upload size is 10MB</small>
		              <input type="file" name="contact_file" class="form-control" >
								</div>
							</div>
							
							<div class="col-md-6 mb-3 p-4">
								@if($contact->contact_avatar != '' && $contact->contact_avatar != 'avatar-1.png')
								<a class="btn btn-primary" href="{{asset('public/assets/images/users/'.$contact->contact_avatar)}}" download="{{$contact->contact_avatar}}">
									{{$contact->contact_avatar}}
									<i class="fas fa-download"></i>
								</a>
								@endif
							</div>
							

							<div class="col-md-6 mb-3">
								<div class="form-group">
		              <button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>

						</div>
					</form>
				

			</div>
		</div>
	</div>

</div>

@endsection
