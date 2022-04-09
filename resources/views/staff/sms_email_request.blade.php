@extends('layouts.admin')

@section('custom-css')

@endsection
@section('page-content')

<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Send Message</h4>

        <div class="page-title-right">
          <a href="{{route('staff.send-bulk-sms-form')}}" class="btn btn-info btn-rounded">Send SMS</a>
        </div>

      </div>
    </div>
  </div>
  
<div class="container-fluid">
  <div class="card">
    <div class="card-header"><h4>Custom Funnels</h4></div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User Email</th>
                  <th>User Number</th>
                  <th>Subject</th>
                  <th>Project Cod</th>
                  <th>Message</th>
                  <th>Type</th>
                  <th>File</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bulk_sms_email as $sms_email)
                <tr>
                  <td>{{$sms_email->id}}</td>
                  <td>{{$sms_email->user->email}}</td>
                  <td>{{$sms_email->user_phone_number->phone_number}}</td>
                  <td>{{$sms_email->subject}}</td>
                  <td>{{$sms_email->project_code}}</td>
                  <td>{{$sms_email->message}}</td>
                  <td>{{ucwords($sms_email->type)}}</td>
                  <td>
                    <a href="{{asset('assets/bulk_sms/'.$sms_email->contact_file)}}" class="btn btn-success">Download</a>
                  </td>
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
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
