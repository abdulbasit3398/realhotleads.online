<?php 

foreach($sms_history as $sms):
	if($sms->send_receive == 'send')
		$name = $sms->user->first_name.' '.$sms->user->last_name;
	else
		$name = $sms->contact->contact_name;

?>

<div>
	<span><b>{{$name}}</b></span> <small>{{date('m-d-Y H:i',strtotime($sms->created_at))}}</small>
	<p>{{$sms->message}}</p>
</div>

<?php

endforeach;

?>

<div>
	<form method="post" action="">
		@csrf
		<div class="form-group">
			<textarea class="form-control"></textarea>
		</div>
		<div class="form-group my-2">
			<button type="submit" class="btn btn-primary w-md" style="float: right;">Reply</button>
		</div>
	</form>
</div>