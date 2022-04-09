@extends('layouts.admin')

@section('page-content')


<div class="container-fluid">

  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Admin Dashboard</h4>

      </div>
    </div>
  </div>
@include('user.validation_message')
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">

        <h4 class="card-title">Total Registered users</h4>

        <div class="table-responsive">
          <table class="table mb-0">

            <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Total Paid</th>
              </tr>
            </thead>
            <tbody>
             @foreach($data['user'] as $user)
             <tr>
              <td>{{$user->username}}</td>
              <td>{{$user->email}}</td>
              <td>${{$user->package_price}}</td>

              <tr/>
              @endforeach
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

          <h4 class="card-title">Users Time Managament</h4>

          <div class="table-responsive">
            <table class="table mb-0">

              <thead>
                <tr>
                  <th>User</th>
                  <th>Job Code</th>
                  <th>Status</th>
                  <th>Date Time</th>
                </tr>
              </thead>
              <tbody>
               @foreach($data['user_clock'] as $clock)
               <tr>
                <td>{{$clock->user->username}}</td>
                <td>{{$clock->job_code}}</td>
                <td>
                  {{$clock->clock_status == 1 ? 'Clock In' : 'Clock Out'}}
                </td>
                <td>{{date('d M Y H:i:s',strtotime($clock->created_at))}}</td>
                <tr/>
                @endforeach
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

          <h4 class="card-title">Custom Package Requests</h4>

          <div class="table-responsive">
            <table class="table mb-0">

              <thead>
                <tr>
                  <th>Email</th>
                  <th>Package</th>
                  <th>Answer</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
               @foreach($data['custom_packages'] as $package)
               <tr>
                <td>{{$package->user->email}}</td>
                <td>{{$package->package_name}}</td>
                <td>{{$package->answer}}</td>
                <td>{{date('d M Y',strtotime($package->created_at))}}</td>
                <tr/>
                @endforeach
              </tbody>  
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.upload-modal-button').click(function(){
     var myBookId = $(this).data('id');
     var remaining = $(this).data('remaining');
     $(".upload-modal-body #contact_id").val( myBookId );
     $(".upload-modal-body #remaining_contacts").val( remaining );
   });
  });

</script>
@endsection