@extends('layouts.user')

@section('custom-css')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('page-content')
<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body upload-modal-body">
        <form method="POST" enctype="multipart/form-data" action="{{route('import-contacts')}}">
          @csrf
          <div class="mb-3 row">
            <div class="col-md-12">
              <label class="form-label">Select File <small>(Excel or CSV file)</small></label>
              <input class="form-control" type="file" id="formFile" name="import_excel" accept=".xls,.xlsx,.csv">
            </div>
            <div class="col-md-12 my-2">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-warning" href="{{asset('assets/samples/import_contacts_sample.csv')}}" download="import_contacts_sample.csv">Download Sample</a>
            </div>
            

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
          <h4>Add new contact</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body upload-modal-body">
          <div class="alert alert-danger error-alert" role="alert" style="display: none;">

          </div>
          <form method="POST"  class="require-validation" action="{{route('save-user-contacts')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="package_id" id="package_id">


            <div class="mb-3">
              <label for="contact_name" class="form-label">Name*</label>
              <input id="contact_name" type="text" class="form-control @error('contact_name') is-invalid @enderror " name="contact_name" value="{{ old('contact_name') }}" required autocomplete="contact_name" autofocus >


            </div>

            <div class="mb-3 row">
              <div class="col-md-6">
                <label for="phone_no" class="form-label">Phone#</label>
                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" autocomplete="phone_no" autofocus >

              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus >

              </div>
              <div class="col-md-6">
                <label for="phone_no" class="form-label">Company</label>
                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" autocomplete="company" autofocus >

              </div>
            </div>

            <div class="mb-3">
              <label for="cvc" class="form-label">Notes</label>
              <textarea class="form-control" rows="5" name="note"></textarea>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Upload File</label>
              <small>Max upload size is 10MB</small>
              <input type="file" name="contact_file" class="form-control" >
            </div>

            <div class="mb-3" style="float: right;">
              <button type="submit" class="btn btn-primary w-md">Save</button>
            </div>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  


<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Contacts</h4>
      </div>
    </div>
  </div>


  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18"></h4>



        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-lg-12" style="padding: 0;">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="page-title-right col-md-6" style="text-align:right;">
                <button type="button" class="btn btn-light waves-effect waves-light w-sm mx-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1">
                    <i class="mdi mdi-upload d-block font-size-16"></i> Upload
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" style="float: right;"><i class="mdi mdi-plus d-block font-size-16"></i> Add</button>

              </div>
            </div>
            <br/>

            @if(\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! \Session::get('success') !!}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif
            <div class="table-responsive">
              <table class="table align-middle table-nowrap table-hover" id="myTable">
                <thead class="table-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Company</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($data['contacts'] as $contact)
                 <tr>
                  <td>
                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{$contact->contact_name}}</a></h5>
                  </td>
                  <td>{{$contact->contact_phone}}</td>
                  <td>{{$contact->contact_email}}</td>
                  <td>{{$contact->company_name}}</td>


                  <td>
                    <a href="{{route('show-user-contact',$contact->id)}}" class="btn btn-success waves-effect waves-light me-1"><i class="fas fa-eye"></i></a>
                    <a href="{{route('edit-user-contact',$contact->id)}}" class="btn btn-primary waves-effect waves-light me-1"><i class="fas fa-pencil-alt"></i></a>
                    <a href="{{route('delete-user-contacts',$contact->id)}}" onclick="return confirm('Are you sure you want to delete this contact?');" class="btn btn-danger waves-effect waves-light me-1"><i class="fa fa-trash"></i></a>
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

 

 

</div>
@endsection

@section('scripts')

<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  $('#myTable').DataTable( {
      responsive: true
  } );
</script>
@endsection

