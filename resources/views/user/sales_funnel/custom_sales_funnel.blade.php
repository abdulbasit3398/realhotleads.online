@extends('layouts.user_under_construction')

@section('custom-css')
{{--<link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />--}}
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection


@section('container')
<div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">CREATE SALES FUNNEL</h4>
          </div>
        </div>
      </div>
      <!-- end page title -->

      <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                <?php
                    session()->forget('success');
                ?>

            @endif

          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4">Create New Funnel</h4>
              <form action="{{route('custom-sales-funnels.store')}}" method="POST">
                  @csrf
                    <div class="row mb-4">
                          <label for="projectname" class="col-form-label col-lg-2">Funnel ID</label>
                          <div class="col-lg-10">
                              <select name="funnel_id" id="funnel_id" class="form-control">
                                  @foreach($funnel_types as $funnel_type)
                                    <option value="{{$funnel_type->id}}">{{$funnel_type->id}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                <div class="row mb-4">
                  <label for="name" class="col-form-label col-lg-2">Funnel Name</label>
                  <div class="col-lg-10">
                    <input id="name" required
                           name="name" type="text" class="form-control" placeholder="Enter Funnel Name...">
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="description" class="col-form-label col-lg-2">Funnel Description</label>
                  <div class="col-lg-10">
                    <textarea id="elm1" name="description" rows="10"></textarea>
                  </div>
                </div>
                  <div class="row mb-4">
                      <label for="description" class="col-form-label col-lg-2">Attach Files</label>
                      <div class="col-lg-10">
                          <div class="dropzone" id="dropzone">
                              <div class="fallback">
                                  <input name="file" type="file" multiple />
                              </div>
                          </div>
                      </div>
                  </div>
                 <div class="row justify-content-end">
                      <div class="col-lg-10">
                          <button type="button" class="btn btn-primary" id="submit-all">Create Funnel</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
{{--                <div class="card">--}}
{{--                <div class="card-header"></div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row mb-4">--}}

{{--                        <label class="col-form-label col-lg-2">Attached Files</label>--}}
{{--                        <div class="col-lg-10">--}}

{{--                            <form action="{{route('funnel-files.upload')}}" method="post" class="dropzone">--}}
{{--                                @csrf--}}
{{--                                <div class="fallback">--}}
{{--                                    <input name="file" type="file" multiple />--}}
{{--                                </div>--}}

{{--                                <div class="dz-message needsclick">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>--}}
{{--                                    </div>--}}
{{--                                    <h4>Drop files here or click to upload.</h4>--}}
{{--                                </div>--}}
{{--                            </form>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
        </div>
      </div>
      <!-- end row -->

    </div>

@endsection


@section('scripts')
{{--<script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>--}}
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-editor.init.js')}}"></script>
<script>

    Dropzone.autoDiscover = false;

    $(function (){
        var myDropzone = new Dropzone("div#dropzone", {
            url: "{{route('custom-sales-funnels.store')}}",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 100,
            acceptedFiles: "image/*,application/pdf,.doc,.docx,.txt",
            init: function () {

                var submitButton = document.querySelector("#submit-all");
                var wrapperThis = this;

                submitButton.addEventListener("click", function () {
                    if($('#name').val().trim().length === 0 ){
                        alert('Please Enter Funnel Name');
                        return;
                    }
                    wrapperThis.processQueue();
                });

                this.on("addedfile", function (file) {
                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        wrapperThis.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });

                this.on('sendingmultiple', function (data, xhr, formData) {
                    formData.append("_token", '{{csrf_token()}}');
                    formData.append("name", $("#name").val());
                    formData.append("funnel_id", $("#funnel_id").val());
                    formData.append("description", $("#description").val());
                });

                this.on('completemultiple', function () {
                    location.reload();
                });
            }
        });
    })
</script>
@endsection
