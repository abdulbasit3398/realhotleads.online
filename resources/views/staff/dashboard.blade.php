@extends('layouts.admin')

@section('page-content')

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Contact Generator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body upload-modal-body">
                <form method="POST" action="{{route('staff.save-contact-file')}}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="contact_id" id="contact_id">
                  <div class="input-group">
                    <input type="file" class="form-control" name="contact_file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Upload</button>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Notes</label>
                      <textarea class="form-control" rows="5" name="notes" id="notes"></textarea>
                    </div>
                    <div class="col-md-4">
                      <div class="form-check mb-3 mt-5">
                        <input class="form-check-input" type="checkbox" id="formCheck2" name="file_complete" value="1">
                        <label class="form-check-label" for="formCheck2">
                          Contacts File Complete
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6 remain-div">
                      <label>User Remaining Contacts</label>
                      <input type="text" id="remaining_contacts" name="remaining_contacts" disabled="" class="form-control">
                    </div>
                    <div class="col-md-6 price-div" style="display: none;">
                      <label>User not have any package. </label><label> Please give price of this file in USD</label>
                      <input type="number" min="0" name="price_of_file"  class="form-control price-input">
                    </div>
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

          </div>
        </div>
      </div>
      <!-- end page title -->

      <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          @if ($errors->any())
             @foreach ($errors->all() as $error)
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {{$error}}
              </div>
             @endforeach
         @endif

           
          @if(\Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! \Session::get('success') !!}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          @endif

          <h4 class="card-title">Contact Generator Requests</h4>

          <div class="table-responsive">
            <table class="table mb-0">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <!-- <th>Username</th> -->
                  <th>Email</th>
                  <th>Area</th>
                  <th>Keywords</th>
                  <th>Instruction</th>
                  <th>Notes</th>
                  <th>Contac File</th>
                </tr>
              </thead>
              <tbody>
                 @foreach($contacts as $contact)
                 <tr>
                  <td>{{$contact->id}}</td>
                  <td>{{date('m-d-Y',strtotime($contact->created_at))}}</td>
                  <!-- <td>{{$contact->user->username}}</td> -->
                  <td>{{$contact->user->email}}</td>
                  <td>{{$contact->search_key}}</td>
                  <td>{{$contact->key_word}}</td>
                  <td>
                    <?php
                      // if(is_array($contact->mobile_b2b))
                      //   var_dump(json_decode($contact->mobile_b2b,true));
                      // else
                      //   echo explode(",",$contact->mobile_b2b);

                      $str = explode(",",$contact->mobile_b2b);
                      $str = str_replace(array('[',']','"'), '',$str);
                      for($i = 0; $i < count($str); $i++)
                        echo $str[$i].'<br/>';
                    ?>
                  </td>
                  <td>{{$contact->notes}}</td>
                  <td>
                  @if($contact->status == 1)
                  
                    <a href="{{asset('public/assets/contacts/'.$contact->contact_file)}}" type="button" class="btn btn-primary waves-effect waves-light w-sm my-2" download>
                      <i class="mdi mdi-download d-block font-size-16"></i> {{$contact->contact_file}}
                    </a>
                  @endif
                    @php
                      $available = 0;
                      if(count($contact->user->contacts_available) != 0)
                      {
                        $available = $contact->user->check_contacts_availability($contact->created_at);
                      }
                    @endphp
                    <button type="button" class="btn btn-light waves-effect upload-modal-button" data-id="{{$contact->id}}" data-bs-toggle="modal" data-remaining="{{$available}}" data-notes="{{$contact->notes}}" data-bs-target=".bs-example-modal-lg">Upload File</button>
 
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.upload-modal-button').click(function(){
      var myBookId = $(this).data('id');
      var remaining = $(this).data('remaining');
      var notes = $(this).data('notes');
      $(".upload-modal-body #contact_id").val( myBookId );
      $(".upload-modal-body #remaining_contacts").val('');
      $(".upload-modal-body #notes").val(notes);
      if(remaining == '-1')
      {

        $(".remain-div").show();
        $(".price-div").hide();
        $(".upload-modal-body #remaining_contacts").val('Unlimited');
      }
      else if(remaining == '0')
      {
        $(".remain-div").hide();
        $(".price-div").show();
        $(".upload-modal-body .price-input").prop('required',true);
      }
      else
      {
        $(".remain-div").show();
        $(".price-div").hide();
        $(".upload-modal-body #remaining_contacts").val(remaining);
      }

    });
  });
   
</script>
@endsection