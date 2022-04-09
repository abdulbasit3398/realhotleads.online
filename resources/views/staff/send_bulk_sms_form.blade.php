@extends('layouts.user')

@section('custom-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

 

@section('page-content')


<div class="modal fade bs-example-modal-lg" id="conversation_model" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title" id="myModalLabel">Conversation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body upload-modal-body">
      	 
         <div id="message-show">
         	
         </div>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div class="container-fluid">
	
	@include('user.validation_message')
	
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">Send Message</h4>

				

			</div>
		</div>
	</div>

	
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form method="post" action="{{route('staff.send-bulk-sms')}}" enctype="multipart/form-data">
						@csrf        	
						<div class="mb-3 row">
							<label for="example-text-input" class="col-md-2 col-form-label">Sender*</label>
							<div class="col-md-10">
								<div class="form-group">
									<input type="text" name="sender" class="form-control">
								</div>
								 
							</div>
						</div>

						<div class="mb-3 row new_number">
							<label for="example-text-input" class="col-md-2 col-form-label">Type Number</label>
							<div class="col-md-10">
								<div class="input-group">
									<div class="input-group-text">+1</div>
									<input type="text" class="form-control" name="sms_recipient_number" id="sms_recipient_number" placeholder="1231231234">

								</div>
								<small>For multiple numbers you can seperate by comma( , )</small>
							</div>
						</div>

						<div class="mb-3 row">
							<label for="example-text-input" class="col-md-2 col-form-label">Message</label>
							<div class="col-md-10">
								<textarea class="form-control" rows="5" name="message" required></textarea>
							</div>
						</div>

						<!-- <div class="mb-3 row">
							<label for="example-text-input" class="col-md-2 col-form-label"></label>
							<div class="col-md-10">
								<input class="form-control" type="file" id="formFile" name="file_mms" accept="image/*,.pdf,.txt,.doc,.docx">
							</div>
						</div>
 -->
						<div class="mb-3 row">
							<div class="col-md-10">
								<button type="submit" class="btn btn-primary w-md">Send</button>
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
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('input[name="user_type"]').change(function(){
			var type = $('input[name="user_type"]:checked').val();
			if(type == 'To Contacts')
			{
				$('#sms_recipient_contact').attr('required','true');
				$('#sms_recipient_number').removeAttr('required');
				$('.new_number').hide();
				$('.new_to_contacts').show();
			}
			else if(type == 'To new number')
			{
				$('#sms_recipient_contact').removeAttr('required','false');
				$('#sms_recipient_number').attr('required','true');
				$('.new_number').show();
				$('.new_to_contacts').hide();
			}

		});
		$('#sms_recipient_contact').change(function(){
			var number = $(this).val();
			if(number == 'other'){
				$('.new_number').attr('required','true');
				$('.new_number').show();
			}
			else{
				$('#sms_recipient_contact').attr('required','false');
				$('.new_number').hide();
			}
		});

		$('.view-message').click(function(){

			var message = $(this).data('message');
     	$(".modal-body #message-show").html(message);

		});

		$('.view-conversation').click(function(){
			var contact_id = $(this).data('message');
			$(".modal-body #message-show").html('');

			$.ajax({
				url: '{{route("get-conversation-history")}}',
				method: 'POST',
				data: {"_token": "{{ csrf_token() }}",contact_id:contact_id},
				success: function(response){
					if(response != 0)
					{
						$(".modal-body #message-show").html(response);
						$('#conversation_model').modal('show');
					}
					

				}

			});


		});
	});
</script>

@endsection