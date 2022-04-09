@extends('user.gigi.layout.outside-layout')


@section('custom-css')
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/image-uploader.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">


  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Create New</h4>

        <div class="page-title-right">
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form method="post" class="dropzone1" action="{{route('save-gigy')}}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
              <label for="projectname" class="col-form-label col-lg-2">Name</label>
              <div class="col-lg-10">
                <input id="projectname" name="projectname" type="text" class="form-control" placeholder="Enter Project Name..." required>
              </div>
            </div>
            <div class="row mb-4">
              <label for="projectdesc" class="col-form-label col-lg-2">Description</label>
              <div class="col-lg-10">
                <textarea class="form-control" id="projectdesc" name="projectdesc" rows="3" placeholder="Enter Project Description..." required></textarea>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-form-label col-lg-2">Project Date</label>
              <div class="col-lg-10">
                <div class="input-daterange input-group" id="project-date-inputgroup" data-provide="datepicker" data-date-format="dd M, yyyy"  data-date-container='#project-date-inputgroup' data-date-autoclose="true">
                  <input type="text" class="form-control" placeholder="Start Date" name="start_date" />
                  <input type="text" class="form-control" placeholder="End Date" name="end_date" />
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <label for="projectbudget" class="col-form-label col-lg-2">Budget</label>
              <div class="col-lg-10">
                <input id="projectbudget" name="projectbudget" type="text" placeholder="Enter Project Budget..." class="form-control">
              </div>
            </div>
          
          <div class="row mb-4">
            <label class="col-form-label col-lg-2">Attached Files</label>
            <div class="col-lg-10">
                <div class="input-images"></div>
                <!-- <div class="fallback">
                  <input name="file" type="file" multiple />
                </div> -->

                <!-- <div class="dz-message needsclick">
                  <div class="mb-3">
                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                  </div>

                  <h4>Drop files here or click to upload.</h4>
                </div> -->
              
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-lg-10">
              <button type="submit" class="btn btn-primary">Create Project</button>
              <a href="{{route('gigi-index')}}" class="btn btn-light">Cancel</a>
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
<script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/image-uploader.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript">
  $('.input-images').imageUploader();
</script>
@endsection
