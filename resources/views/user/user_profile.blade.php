@extends('layouts.user')

@section('page-content')
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Profile</h4>

		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Edit details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body upload-modal-body">
        <form method="POST" action="{{route('edit-user-profile')}}">
          @csrf
          <div class="form-group my-2">
           <label class="form-label">First Name</label>
           <input type="text" name="first_name" class="form-control" placeholder="Type first name" value="{{\Auth::user()->first_name}}">
         </div>
         <div class="form-group my-2">
           <label class="form-label">Last Name</label>
           <input type="text" name="last_name" class="form-control" placeholder="Type last name" value="{{\Auth::user()->last_name}}">
         </div>
         <div class="form-group my-2">
           <label class="form-label">Company Name</label>
           <input type="text" name="company_name" class="form-control" placeholder="Type company name" value="{{\Auth::user()->company_name}}">
         </div>
         <div class="form-group my-3">
           <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Save</button>
         </div>
       </form>
     </div>
   </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Edit your password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body upload-modal-body">
        <form method="POST" action="{{route('edit-user-profile')}}" >
          @csrf
          <div class="form-group">
           <label class="form-label">New Password</label>
           <input type="password" name="new_password" class="form-control" placeholder="Type new password">
         </div>
         <div class="form-group my-3">
           <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Save</button>
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
        <h5 class="modal-title" id="myLargeModalLabel">Edit Profile Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body upload-modal-body">
        <form method="POST" action="{{route('edit-user-profile')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
           <label class="form-label">Upload Profile Image</label>
           <input type="file" name="profile_image" class="form-control" >
         </div>
         <div class="form-group my-3">
           <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Save</button>
         </div>
       </form>
     </div>
   </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div>
@include('user.validation_message')
<div class="row">
	<div class="col-xl-12">
		<div class="card">
      <div class="card-body">
      	
        <h4 class="card-title mb-4">Personal Information</h4>

        <div class="table-responsive">
          <table class="table table-nowrap mb-0">
            <tbody>
              <tr>
                <th scope="row">First Name :</th>
                <td>{{\Auth::user()->first_name}} <a href="" class="px-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg2">Edit</a> </td>
              </tr>
              <tr>
                <th scope="row">Last Name :</th>
                <td>{{\Auth::user()->last_name}} <a href="" class="px-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg2">Edit</a> </td>
              </tr>
              <tr>
                <th scope="row">Company Name :</th>
                <td>{{\Auth::user()->company_name}} <a href="" class="px-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg2">Edit</a> </td>
              </tr>
              <tr>
                <th scope="row">E-mail :</th>
                <td>{{\Auth::user()->email}}</td>
              </tr>
              <tr>
                <th scope="row">Password :</th>
                <td>
                 ********<a href="" class="px-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</a> 
               </tr>
               <tr>
                <th scope="row">Profile Image :</th>
                <td>
                 <img src="{{asset('public/assets/images/users/'.\Auth::user()->profile_image)}}" alt="" class="img-thumbnail rounded-circle" width="62">
                 <a href="" class="px-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">Edit</a> 
               </tr>
               <tr>
                <th scope="row">Affiliate Account:</th>
                <td>
                  <form method="POST" action="{{route('edit-user-profile')}}">
                    @csrf

                    <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                      <input class="form-check-input" type="checkbox" name="affiliate" id="SwitchCheckSizesm" value="1" {{(\Auth::user()->affiliate_account == 1) ? 'disabled checked' : ''}}>
                      <!-- <label class="form-check-label" for="SwitchCheckSizesm">Become Affiliate</label> -->
                    </div>

                    <button type="submit" class="btn btn-primary btn-aff d-none">Save</button>
                  </form> 
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </div>


  
  @endsection

  @section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#SwitchCheckSizesm').change(function(){
        $('.btn-aff').removeClass('d-none');
      });
    });
  </script>
  @endsection