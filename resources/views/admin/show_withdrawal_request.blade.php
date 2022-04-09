@extends('layouts.admin')

@section('page-content')


<div class="container-fluid">

  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Withdrawal Request</h4>

      </div>
    </div>
  </div>
@include('user.validation_message')

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <div class="row">

            <div class="col-md-6">
              <label>User Name</label>
              <p>{{$data['user']->first_name.' '.$data['user']->last_name}}</p>
            </div>

            <div class="col-md-6">
              <label>User Email</label>
              <p>{{$data['user']->email}}</p>
            </div>

            <div class="col-md-6">
              <label>Account Holder Name</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'account_holder_name')}}</p>
            </div>

            <div class="col-md-6">
              <label>Bank Name</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'bank_name')}}</p>
            </div>

            <div class="col-md-6">
              <label>Account Number</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'account_number')}}</p>
            </div>

            <div class="col-md-6">
              <label>Routing Number</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'routing_number')}}</p>
            </div>
            <div class="col-md-6">
              <label>Card Holder Name</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'card_holder_name')}}</p>
            </div>
            <div class="col-md-6">
              <label>Card Number</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'card_number')}}</p>
            </div>

            <div class="col-md-6">
              <label>Card Expiry</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'card_expiry')}}</p>
            </div>
            <div class="col-md-6">
              <label>Card CVC</label>
              <p>{{$data['user']->user_bank_detail($data['user']->id,'card_cvc')}}</p>
            </div>

            <div class="col-md-6">
              <label>Amount to Withdraw</label>
              <p>{{$data['withdrawal_request']->currency.' '.$data['withdrawal_request']->amount}}</p>
            </div>

            @if($data['withdrawal_request']->status == 'Pending')
            <div class="col-md-6">
              <a href="{{route('admin.complete-withdrawal-request',$data['withdrawal_request']->id)}}" onclick="return confirm('This withdawal request complete ?');" class="btn btn-success">Pay</a>
            </div>
            @endif

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
            <div class="col-md-12">
              <form method="POST" action="{{route('admin.send-withdrawal-notification')}}">
                @csrf
                <input type="hidden" name="withdrawal_request_id" value="{{$data['withdrawal_request']->id}}">
                <div class="form-group">
                  <label class="form-label">Email Notification to User</label>
                  <textarea class="form-control" rows="5" name="notification_message"></textarea>
                </div>
                <br/>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('scripts')
 
@endsection