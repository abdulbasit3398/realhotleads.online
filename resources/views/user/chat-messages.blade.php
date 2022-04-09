
@forelse($messages as $message)

<?php
    $auth_id = auth()->id();
    $class ='';
    $name = 'No Name';

    if($message->sender()->exists() && $message->receiver()->exists() && $message->conversation()->exists()){

        $conversation = $message->conversation;

        if($auth_id == $message->sender_id)
            $class='right';

        if($conversation->sender_id == $message->sender_id){
            $name = $message->sender->full_name;
        }else{
            $name = $conversation->receiver->full_name;
        }

    }
?>
    <li class="{{$class}}">
        <div class="conversation-list">
            <div class="ctext-wrap">
                <div class="conversation-name">{{$name}}</div> <p> {{$message->body}} </p>
                @if($message->media)
                    <div class="mb-3">
{{--                        <iframe src="{{asset('/assets/mms_files/'.$message->media)}}" width="100%" height="100px" ></iframe>--}}
                        <a onclick="openFile('{{asset('/assets/mms_files/'.$message->media)}}')"> View File</a>

{{--                        <a href="{{asset('/assets/mms_files/'.$message->media)}}" target="_blank"> Open</a>--}}
                    </div>
                @endif
                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>{{$message->created_at}}</p>
                </div>
            </div>
        </li>
@empty

    <li class="text-center">
        <p>No Chat Found</p>
    </li>

@endforelse

