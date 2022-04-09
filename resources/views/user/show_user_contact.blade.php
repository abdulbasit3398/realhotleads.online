@extends('layouts.user')

@section('custom-css')

@endsection

@section('page-content')
<style type="text/css">
	.table-nowrap td, .table-nowrap th{
		white-space: break-spaces;
	}
	.table th {
    font-weight: 600;
    width: 200px;
}
</style>

<div class="row">
	<div class="col-xl-12">
		<div class="card">
      <div class="card-body">
      	
        <h4 class="card-title mb-4">Contact Information</h4>

        <div class="table-responsive">
          <table class="table table-nowrap mb-0">
            <tbody>
              <tr>
                <th scope="row">Name :</th>
                <td>{{$contact->contact_name}} </td>
              </tr>
              <tr>
                <th scope="row">Phone# :</th>
                <td>{{$contact->contact_phone}} </td>
              </tr>
              <tr>
                <th scope="row">E-mail :</th>
                <td>{{$contact->contact_email}} </td>
              </tr>
              <tr>
                <th scope="row">Company Name :</th>
                <td>{{$contact->company_name}}</td>
              </tr>
              <tr>
                <th scope="row">Notes :</th>
                <td width="250">{{$contact->notes}}</td>
               </tr>

               @if($contact->contact_avatar != '' && $contact->contact_avatar != 'avatar-1.png')
               <tr>
	                <th scope="row">File :</th>
	                <td>
	                	<a style="float: left;" class="btn btn-primary" href="{{asset('public/assets/images/users/'.$contact->contact_avatar)}}" download="{{$contact->contact_avatar}}">{{$contact->contact_avatar}}&nbsp;<i class="fas fa-download"></i></a> 
	                </td>
	               </tr>

								@endif

              </tbody>
            </table>
            <div>
            	<a style="float: right;" href="{{route('dashboard')}}" class="btn btn-primary my-4">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

@endsection
