@extends('layouts.user')

@section('custom-css')
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
<link href="{{asset('assets/css/phone-dial-pad.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title" id="myModalLabel">Message Body</h5>
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

	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="text-center mb-5">
				@if(\Session::has('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{!! \Session::get('success') !!}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endif

				@if ($errors->any())
				@foreach ($errors->all() as $error)
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{$error}}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endforeach
				@endif

				@if(\Session::has('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{!! \Session::get('error') !!}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endif
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<!-- <h4 class="mb-sm-0 font-size-18"></h4> -->

				<div class="page-title-right">

				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form method="post" action="">
						@csrf
						<input type="hidden" id="call_sid" value="">
						<input type="hidden" id="hangup_url" value="{{route('hangup-communication-phone')}}">
						<input type="hidden" name="phone_number" id="phone_number">
						<input type="hidden" name="phone_url" id="phone_url" value="{{route('send-communication-phone')}}">
						<div class="container1">

					  <div id="output">
					  	<label>+1</label>
					  </div>
					  <div class="row">
					    <div class="digit col-sm-4" data-id="1">1</div>
					    <div class="digit col-sm-4" data-id="2">2
					    </div>
					    <div class="digit col-sm-4" data-id="3">3
					    </div>
					  </div>
					  <div class="row">
					    <div class="digit col-sm-4" data-id="4">4
					    </div>
					    <div class="digit col-sm-4" data-id="5">5
					    </div>
					    <div class="digit col-sm-4" data-id="6">6
					    </div>
					  </div>
					  <div class="row">
					    <div class="digit col-sm-4" data-id="7">7
					    </div>
					    <div class="digit col-sm-4" data-id="8">8
					    </div>
					    <div class="digit col-sm-4" data-id="9">9
					    </div>
					  </div>
					  <div class="row">
					    <div class="digit col-sm-4"data-id="*">*
					    </div>
					    <div class="digit col-sm-4"data-id="0">0
					    </div>
					    <div class="digit col-sm-4"data-id="#">#
					    </div>
					  </div>

					  <div class="row my-4">
					  	<div class="col-sm-4">

					  	</div>
					  	<div class="col-sm-4 phone-dial">
					  		<button type="button" class="btn btn-success btn-dial"><i class="fa fa-phone" aria-hidden="true"></i></button>
					  	</div>
					  	<div class="col-sm-4 phone-hangup d-none">
					  		<button type="button" class="btn btn-danger btn-hangup"><i class="fas fa-phone-slash" aria-hidden="true"></i></button>
					  	</div>
					  	<div class="col-sm-4 py-3">
					  		<i class="fa fas fa-arrow-left " aria-hidden="true"></i>
					  	</div>
					  </div>
					  <!-- <div class="botrow">
					  	<i class="fa fa-star-o dig" aria-hidden="true"></i>
					    <div id="call"></div>
					    <i class="fa fa-long-arrow-left dig" aria-hidden="true"></i>
					  </div> -->
					</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="row">
		<div class="col-lg-12" style="padding: 0;">
			<div class="card">
				<div class="card-body">

					<div class="table-responsive">
						<table class="table align-middle table-nowrap table-hover" id="datatable">
							<thead class="table-light">
								<tr>
									<th scope="col">Date</th>
									<th scope="col">Phone#</th>
									<th scope="col">Message</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>    -->







</div>
@endsection

@section('scripts')

<script type="text/javascript">
	var count = 0;

	$(document).ready(function(){
		$('.btn-dial').click(function(){

			var phone_number = $('#phone_number').val();
			var phone_url = $('#phone_url').val();

			console.log(phone_number);
			if(phone_number.length == 10)
			{
                $.ajax({
                    url : phone_url,
                    method: 'POST',
                    data: {phone_number:phone_number},
                    success:function(response){
                        if(response['response'] == '1')
                        {
                            $('#call_sid').val(response['sid']);
                            $('.phone-dial').addClass('d-none');
                            $('.phone-hangup').removeClass('d-none');
                            $('#output').html('<label>Calling...</label>');
                        }

                    }

                });

			}
            else{
                alert('Phone Invalid');
            }
		});

		$('.btn-hangup').click(function(){
			var call_sid = $('#call_sid').val();
			var hangup_url = $('#hangup_url').val();

			$.ajax({
				url:hangup_url,
				method: 'POST',
				data:{call_sid:call_sid},
				success:function(response){
					if(response['response'] == '1')
					{
						$('#call_sid').val('');
						$('.phone-hangup').addClass('d-none');
						$('.phone-dial').removeClass('d-none');
						$('#output').html('<label>+1</label>');
						$('#phone_number').val('');
						count = 0;
					}

				}
			});
		});

	});



	$(".digit").on('click', function() {
	  var num = ($(this).clone().children().remove().end().text());

	  if (count < 10) {
	  	var phone_number = $('#phone_number').val();
	  	phone_number += $(this).data('id');
	  	$('#phone_number').val(phone_number);

	    $("#output").append('<span>' + num.trim() + '</span>');

	    count++
	  }
	});

	$('.fa-arrow-left').on('click', function() {
	  $('#output span:last-child').remove();

	  var phone_number = $('#phone_number').val();
	  phone_number = phone_number.slice(0, -1);
	  $('#phone_number').val(phone_number);

	  if(count > 0)
		  count--;
	});

	$(document).ready(function(){
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

	});
</script>

@endsection
