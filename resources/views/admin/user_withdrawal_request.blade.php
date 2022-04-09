@extends('layouts.admin')

@section('page-content')


<div class="container-fluid">

  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Withdrawal Requests</h4>

      </div>
    </div>
  </div>
@include('user.validation_message')

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">


          <div class="table-responsive">
            <table class="table mb-0">

              <thead>
                <tr>
                  <th>User Email</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               @foreach($data['requests'] as $requests)
               <tr>
                  <td>{{$requests->user->email}}</td>
                  <td>{{$requests->currency.' '.$requests->amount}}</td>
                  <td>{{$requests->status}}</td>
                  <td>
                    <a href="{{route('admin.show-withdrawal-request',$requests->id)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                  </td>
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
 
@endsection