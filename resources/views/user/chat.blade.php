@extends('layouts.user')

@section('custom-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<style>

</style>
@endsection


@section('page-content')

    <div id="customerSupport" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <form method="post" action="{{route('send_chat')}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="customer_support" id="customer_support" value="1">

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="example-text-input" class="col-md-2 col-form-label">Recipient</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <select name="receiver_id" id="creceiver_id" class=" select2" style="width: 100%!important;">--}}
{{--                                    @foreach($allUsers as $user)--}}
{{--                                        <option value="{{$user->id}}">{{$user->full_name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <input type="text" disabled name="username" class="form-control" id="creceiver_username">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Message</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="message" required id="cmessage_body"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Media</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="cformFile" name="file_mms" accept="image/*,.pdf,.txt,.doc,.docx">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-md">Send</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="newMessage" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">

		<div class="modal-content">
			<form method="post" action="{{route('send_chat')}}" enctype="multipart/form-data">
				<div class="modal-body">

					@csrf
					<input type="hidden" name="receiver_id" id="receiver_id">
					<div class="mb-3 row">
						<label for="example-text-input" class="col-md-2 col-form-label">Recipient</label>
						<div class="col-md-10">
							<input type="text" disabled name="username" class="form-control" id="receiver_username">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="example-text-input" class="col-md-2 col-form-label">Message</label>
						<div class="col-md-10">
							<textarea class="form-control" rows="5" name="message" required id="message_body"></textarea>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="example-text-input" class="col-md-2 col-form-label">Media</label>
						<div class="col-md-10">
							<input class="form-control" type="file" id="formFile" name="file_mms" accept="image/*,.pdf,.txt,.doc,.docx">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary w-md">Send</button>
				</div>

			</form>
		</div>
	</div>
</div>

<div id="createGroup" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{route('create-group')}}" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">

					<div class="mb-3 row">
						<label for="example-text-input" class="col-md-2 col-form-label">Group Name</label>
						<div class="col-md-10">
							<input type="text"required name="group_name" id="group_name" class="form-control">
						</div>
					</div>

					<div class="mb-3 row">

						<label for="example-text-input" class="col-md-2 col-form-label">Members</label>
						<div class="col-md-10">
							<select name="members[]" id="members"
							required multiple
							class="select2 form-control select2-multiple"
							style="width: 100%!important;">

							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->full_name}}</option>
							@endforeach

						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary w-md">Save</button>
			</div>

		</form>
	</div>
</div>
</div>

<div id="addRemoveMembers" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{route('update-group')}}" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<input type="hidden" name="update_group_id" id="update_group_id" class="form-control">
					<div class="mb-3 row">
						<label for="example-text-input" class="col-md-2 col-form-label">Group Name</label>
						<div class="col-md-10">
							<input type="text"required name="update_group_name" id="update_group_name" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="example-text-input" class="col-md-2 col-form-label">Members</label>
						<div class="col-md-10">
							<select name="update_members[]" id="update_members"
							required multiple
							class="select2 form-control select2-multiple"
							style="width: 100%!important;">

							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->full_name}}</option>
							@endforeach

						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary w-md">Update</button>
			</div>

		</form>
	</div>
</div>
</div>


<div class="container-fluid">
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">Chat</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="javascript: void(0);">Skote</a></li>
						<li class="breadcrumb-item active">Chat</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="d-lg-flex">
		<div class="chat-leftsidebar me-lg-4">
			<div class="">
				<div class="py-4 border-bottom1">
					<div class="media">
						<div class="align-self-center me-3">
							<img src="{{asset('assets/images/users/'.\Auth::user()->profile_image)}}" class="avatar-xs rounded-circle" alt="">
						</div>
						<div class="media-body">
							<h5 class="font-size-15 mt-0 mb-1">{{\Auth::user()->username}}</h5>
							<p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active</p>
						</div>

						<div>
							<!-- <div class="dropdown chat-noti-dropdown active">
								<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="bx bx-bell bx-tada"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-end">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div> -->
						</div>
					</div>
				</div>
                @if(auth()->user()->type != 'staff')


                <li data-conversation="" onclick="customerSupportModal()" style="list-style: none;">
					<a href="#">
						<div class="media">
							<div class="align-self-center me-3">
								<i class="mdi mdi-circle font-size-10"></i>
							</div>
							<div class="align-self-center me-3">
								<img src="{{asset('assets/images/users/avatar-1.png')}}" class="rounded-circle avatar-xs" alt="">
							</div>

							<div class="media-body overflow-hidden" >
								<h5 class="text-truncate font-size-14 mb-1">Customer Support</h5>
							</div>

						</div>
					</a>
				</li>
                @endif

				<div class="chat-leftsidebar-nav">
					<div class="search-box chat-search-box py-4">
						<div class="position-relative">
							<input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Search...">
							<i class="bx bx-search-alt search-icon"></i>
						</div>
					</div>
					<ul class="nav nav-pills nav-justified">
						<li class="nav-item" onclick="showChat()">
							<a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
								<i class="bx bx-chat font-size-20 d-sm-none"></i>
								<span class="d-none d-sm-block">Chat</span>
							</a>
						</li>

                        @if(auth()->user()->type !== 'staff')
                            <li class="nav-item" onclick="showGroupChat()">
                                <a href="#groups" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="bx bx-group font-size-20 d-sm-none"></i>
                                    <span class="d-none d-sm-block">Groups</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#contacts" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="bx bx-book-content font-size-20 d-sm-none"></i>
                                    <span class="d-none d-sm-block">ACG Users</span>
                                </a>
                            </li>
                        @endif

                    </ul>
					<div class="tab-content py-4">
						<div class="tab-pane show active" id="chat">
							<div>
								<h5 class="font-size-14 mb-3">Recent</h5>
								<ul class="list-unstyled chat-list all-chatters" data-simplebar style="max-height: 410px;">
									@forelse($conversations as $conversation)
									<?php
									$person = false;
									if($conversation->receiver()->exists() && $conversation->sender()->exists()){

										if($conversation->receiver->id === auth()->id()){
											$person = $conversation->sender;
										}else{
											$person = $conversation->receiver;
										}

										$msg = \App\Message::where('rcvr_id',$person->id)->orWhere('sender_id',$person->id)->latest()->first();

									}
									?>

									@if($person)

									<li data-conversation="{{$conversation->id}}" onclick="getMessages({{$conversation->id}} , {{$person->id}}, '{{$person->first_name.' '.$person->last_name }}')">
										<a href="#">
											<div class="media">
												<div class="align-self-center me-3">
													<i class="mdi mdi-circle font-size-10"></i>
												</div>
												<div class="align-self-center me-3">
													<img src="{{asset('assets/images/users/'.$person->profile_image)}}" class="rounded-circle avatar-xs" alt="">
												</div>

												<div class="media-body overflow-hidden">
													<h5 class="text-truncate font-size-14 mb-1">{{$person->full_name}}</h5>
													<p class="text-truncate mb-0">{{$msg->body}}</p>
												</div>
												{{--                                                            <div class="font-size-11">{{$conversation->created_at->diffForHumans()}}</div>--}}
											</div>
										</a>
									</li>
									@endif
									@empty
									<li class="text-center">
										<p>No Chat History</p>
									</li>
									@endforelse
								</ul>
							</div>
						</div>
						<div class="tab-pane" id="groups">
							<h5 class="font-size-14 mb-3">Groups </h5>

							<ul class="list-unstyled chat-list all-group-chatters" data-simplebar style="max-height: 410px;">
								<li id="create_group_li">
									<a >
										<div class="media align-items-center">
											<div class="avatar-xs me-3">
												<span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
													<i class="mdi mdi-account-search"></i>
												</span>
											</div>

											<div class="media-body">
												<h5 class="font-size-14 mb-0">Create Group</h5>
											</div>
										</div>
									</a>
								</li>

								<?php
								$group_count = count($my_groups) + count($member_of_groups);
								?>
								@if($group_count > 0)

								@foreach($my_groups as $group)
								<li onclick="getGroupMessages({{$group->id}})" data-groupid="{{$group->id}}">
									<a href="#">
										<div class="media align-items-center">
											<div class="avatar-xs me-3">
												<span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
													{{ucfirst($group->name[0])}}
												</span>
											</div>
											<div class="media-body">
												<h5 class="font-size-14 mb-0">{{$group->name}}</h5>
											</div>
										</div>
									</a>
								</li>
								@endforeach

								@foreach($member_of_groups as $g)
								@if($g->group()->exists())
								<li onclick="getGroupMessages({{$g->group->id}})">
									<a href="#">
										<div class="media align-items-center">
											<div class="avatar-xs me-3">
												<span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
													{{ucfirst($g->group->name[0])}}
												</span>
											</div>
											<div class="media-body">
												<h5 class="font-size-14 mb-0">{{$g->group->name}}</h5>
											</div>

										</div>
									</a>
								</li>
								@endif
								@endforeach
								@else
								<li class="text-center">
									<p>No Recent Group</p>
								</li>

								@endif
							</ul>
						</div>
						<div class="tab-pane" id="contacts">

							<div  data-simplebar style="max-height: 410px;">
								<div>

									<ul class="list-unstyled chat-list">
										@foreach($users as $user)
										<li>
											<a href="#" class="new_message" data-id="{{$user->id}}" data-username="{{$user->username}}">
												<div class="media">
													<div class="align-self-center me-3">
														<img src="{{asset('assets/images/users/'.$user->profile_image)}}" class="avatar-xs rounded-circle" alt="">
													</div>
													<div class="media-body">
														<h5 class="font-size-15 mt-0 mb-1">{{($user->first_name) ? $user->first_name.' '.$user->last_name : 'No Name'}}</h5>
														<p class="text-muted mb-0">{{$user->username}}</p>
													</div>
												</div>
											</a>
										</li>
										@endforeach


									</ul>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="w-100 user-chat" id="chat_div">
			<div class="card">
				<div class="p-4 border-bottom ">
					<div class="row">
						<div class="col-md-4 col-9">
							<h5 class="font-size-15 mb-1" id="inbox_name"></h5>
						</div>
						<div class="col-md-8 col-3">
							<ul class="list-inline user-chat-nav text-end mb-0">
								<li class="list-inline-item d-none d-sm-inline-block">
									<div class="dropdown">
										<button id="search_msg_icon" class="btn nav-btn dropdown-toggle"
										type="button" data-bs-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-search-alt-2"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
										<div class="form-group m-0">
											<div class="input-group">
												<input type="text"
												id="search_message"
												name="search_message"
												class="form-control"
												placeholder="Search ..."
												aria-label="Recipient's username">
											</div>
										</div>
									</div>
								</div>
							</li>

						</ul>

					</div>
				</div>
			</div>
			<div>

				<div class="chat-conversation p-3" >
					<ul class="list-unstyled mb-0 all-chat-ul messages-list"  data-simplebar style="max-height: 486px;">
						<div id="msg_list" style="min-height: 15rem;  overflow: auto; " >

								<!-- <li>
								</li> -->

							</div>
						</ul>
					</div>

					<div class="p-3 chat-input-section">
						<form id="chat_form" action="{{route('send_chat')}}" action="POST" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-12 collapse mb-2" id="collapseExample">
									<input class="form-control form-control-sm" id="file_mms2" type="file" name="file_mms2" accept="image/*,.pdf,.txt,.doc,.docx">
								</div>
								<div class="col">
									<div class="position-relative">
										<input type="hidden" name="form_receiver_id" id="form_receiver_id">
										<input type="hidden" name="send_message_form" id="send_message_form" value="1">
										<textarea class="form-control chat-input" name="message" id="message" placeholder="Enter Message..." rows="2"></textarea>
										<!-- <input type="text" class="form-control chat-input" name="message" id="message" placeholder="Enter Message..."> -->
										<div class="chat-input-links" id="tooltip-container">
											<ul class="list-inline mb-0">
												<li class="list-inline-item">
													<a class="collapsed" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a>
												</li>
											</ul>
										</div>
									</div>
								</div>

								<div class="col-auto">
									<button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light">
										<span class="d-none d-sm-inline-block me-2" >Send</span><i class="mdi mdi-send"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="w-100 user-chat" id="full_group_chat">
				<div class="card">
					<div id="group_chat_div">

					</div>

					<div class="p-3 chat-input-section">
						<form id="group_chat_form" action="{{route('send-group-chat')}}" method="POST"
						enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-12 collapse mb-2" id="gcollapseExample">
								<input class="form-control form-control-sm" id="group_file_mms" type="file" name="group_file_mms" accept="image/*,.pdf,.txt,.doc,.docx">
							</div>
							<div class="col">
								<div class="position-relative">
									<input type="hidden" name="group_id" id="group_id" value="">
									<input type="text" class="form-control chat-input" name="group_msg" id="group_msg" placeholder="Enter Message...">
									<div class="chat-input-links" id="tooltip-container">
										<ul class="list-inline mb-0">
											<li class="list-inline-item" >
												<a id="gcollapse" class="collapsed" data-bs-toggle="collapse" href="#gcollapseExample" aria-expanded="false"
												aria-controls="collapseExample" href="javascript: void(0);" title="Add Files">
												<i class="mdi mdi-file-document-outline"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-auto">
								<button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light">
									<span class="d-none d-sm-inline-block me-2" >Send</span><i class="mdi mdi-send"></i></button>
								</div>
							</div>
						</form>
					</div>

				</div>


			</div>
		</div>
		<!-- end row -->
	</div>
	@endsection

	@section('scripts')
	<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
	<script type="text/javascript">



		$(document).ready(function(){


			$('.select2').select2({
				placeholder:'Select Members'
			});


			$('.new_message').click(function(){
				$('#message_body').val('');
				var id = $(this).data('id');
				var username = $(this).data('username');

				$('#receiver_id').val(id);
				$('#receiver_username').val(username);
				$('#newMessage').modal('show');
			});


			$('#create_group_li').click(function(){
				$('#members').val('').trigger('change');
				$('#group_name').val('');

				$('#createGroup').modal('show');
			});

			$('.all-chatters').on('click', 'li', function() {
				$('.all-chatters li.active').removeClass('active');
				$(this).addClass('active');
			});

			$('.all-group-chatters').on('click', 'li', function() {
				$('.all-group-chatters li.active').removeClass('active');
				$(this).addClass('active');
			});

			$(".all-chatters li:nth-child(1)").addClass('active');
			$(".all-chatters li:nth-child(1)").click();

			$('#full_group_chat').hide();

			$('#chat_form').submit(function(e){
				e.preventDefault();
				if($('#message').val().trim().length === 0){
					alert('Please type a message');
					return;
				}
				let formData = new FormData(this);

				$.ajax({
					url:'{{route('send_chat')}}',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					success: function (message) {

						$('#message').val('');
						$("#msg_list").append(message);
						$('#file_mms2').val('');
						$('#collapseExample').trigger('click');
						$('#msg_list li:last-child' )[0].scrollIntoView();


					}
				});
			});
			$('#group_chat_form').submit(function(e) {
				e.preventDefault();
				if($('#group_msg').val().trim().length === 0){
					alert('Please type a message');
					return;
				}
				let formData = new FormData(e.target);
				$.ajax({
					url:'{{route('send-group-chat')}}',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					success: function (message) {
						$('.no-g-msg').hide();
						$('#group_msg').val('');
						$("#group_msg_list").append(message);
						$('#group_file_mms').val('');
						$('#gcollapse').trigger('click');
						$('#group_msg_list li:last-child' )[0].scrollIntoView();

					}
				});
			});

			jQuery("#contact_name").keyup(function () {
				var filter = jQuery(this).val();
				jQuery("ul li").each(function () {
					if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
						jQuery(this).hide();
					} else {
						jQuery(this).show()
					}
				});

			});

			jQuery("#search_message").keyup(function () {
				var filter = jQuery(this).val();
				jQuery("ul.messages-list li").each(function () {
					if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
						jQuery(this).hide();
					} else {
						jQuery(this).show()
					}
				});
			});
		});

        function customerSupportModal(){
            $('#customerSupport').modal('show');
        }

		function searchGroupMessages(){
			var group_id = $('ul.all-group-chatters').find('li.active').data('groupid');
			var query = $('#search_message').val();

			$('#group_chat_div').html('');
			$.ajax({
				url:'{{route('search-group-message')}}',
				method:'GET',
				data:{query,group_id},
				success:function (list){
					$('#group_chat_div').append(list).ready(function () {
						$('#group_search_msg_icon').trigger('click');
					});
				}

			});
		}

		function openFile(file){
			window.open(file, '_blank');
		}

		function addRemoveMembers(id,name,members){
			$('#update_group_id').val(id);
			$('#update_group_name').val(name);
			var members_array = [];

			for (var arrayIndex in members) {
				members_array.push(members[arrayIndex].user.id);
			}
			$('#update_members').val(members_array).change();
			$('#addRemoveMembers').modal('show');
		}

		function getMessages(conversation_id,rcvr_id, name){
			loadingStart();

			handle(rcvr_id,name);

			$.ajax({
				url:"{{route('get-messages')}}",
				data:{conversation_id},
				success:function (list){

					$('#msg_list').append(list).ready(()=>{
						$('#msg_list li:last-child')[0].scrollIntoView();
					});

					loadingStop();
				}
			});
		}

		function handle(rcvr_id,name){
			$('#form_receiver_id').val(rcvr_id);
			$('#msg_list').html('');

			if(name.trim().length > 0){
				$('#inbox_name').text(name);
			}else{
				$('#inbox_name').text('No name');
			}
		}

		function showChat(){

			$('#chat_div').show();
			$('#full_group_chat').hide();

		}

		function showGroupChat(){
			$(".all-group-chatters li:nth-child(2)").addClass('active');
			$(".all-group-chatters li:nth-child(2)").click();

			$('#chat_div').hide();
			$('#full_group_chat').show();
		}

		function getGroupMessages(group_id){
			loadingStart();
			$('#group_chat_div').html('');
			$('#group_id').val(group_id);

			$.ajax({
				url:'{{route('get-group-messages')}}',
				data:{group_id},
				success:function (div){
					$('#group_chat_div').append(div).ready(function () {
						$('#group_msg_list li:last-child' )[0].scrollIntoView();
						jQuery("#search_group_message").keyup(function () {
							var filter = jQuery(this).val();
							jQuery("ul.group-messages-list li").each(function () {
								if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
									jQuery(this).hide();
								} else {
									jQuery(this).show()
								}
							});
						});
					});

					loadingStop();
				}
			});
		}

		function removeGroup(group_id){
			if(confirm('Are you sure you want to delete this group')){
				$.ajax({
					url:'{{route('remove-group')}}',
					method:'DELETE',
					data:{group_id,'_token':'{{csrf_token()}}'},
					success:function (){
						window.location.reload();
					}
				});
			}
		}

	</script>
	@endsection
