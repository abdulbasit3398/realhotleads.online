

<?php

    $search = $query;
?>
<div class="p-4 border-bottom " >
    <div class="row">

        <div class="col-md-10 col-10">
            <h5 class="font-size-15 mb-1">{{$group->name}}</h5>
            <h6>
                <?php
                $count = 1;
                $t = count($group->members);
                ?>
                <span class="text-success">
                            {{$group->owner->full_name}}
                        </span> -

                @foreach($group->members as $member)
                    <?php
                    if($t > $count ){
                        $symbol = '-';
                    }else{
                        $symbol = '';
                    }
                    $count++;
                    ?>
                    @if($member->user()->exists())
                        <span>
                            {{$member->user->full_name}} {{$symbol}}
                        </span>
                    @endif

                @endforeach

            </h6>
        </div>
        <div class="col-md-1 col-1 align-content-end">
            <ul class="list-inline user-chat-nav text-end mb-0">
                <li class="list-inline-item d-none d-sm-inline-block">
                    <div class="dropdown">
                        <button id="group_search_msg_icon" class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-search-alt-2"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               value="{{$search}}"
                                               name="search_group_message" id="search_group_message"
                                               placeholder="Search ..."
                                               aria-label="Recipient's username">
{{--                                        <button class="btn btn-primary" type="button" id="group_message_search_btn"><i class="mdi mdi-magnify"></i></button>--}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

        @if($group->owner_id == auth()->id())
            <div class="col-md-1 col-1">
                <ul class="list-inline user-chat-nav text-end mb-0">
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item"  onclick="addRemoveMembers({{$group->id}},'{{$group->name}}',{{$group->members}})">Update</a>
                                <a class="dropdown-item"  onclick="removeGroup({{$group->id}})">Remove</a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        @endif
    </div>
</div>

<div class="chat-conversation p-3">
        <ul class="list-unstyled mb-0 all-chat-ul group-messages-list"  data-simplebar style="max-height: 486px;">

            <div id="group_msg_list" style="min-height: 15rem">

                @if($group->messages()->exists())
                    <?php
                    $messages = $group->messages;
                    ?>
                    @forelse($messages as $message)
                        <?php
                        $auth_id = auth()->id();
                        $class ='';
                        $name = 'No Name';

                        if($message->sender()->exists()){

                            if($auth_id == $message->sender_id)
                                $class='right';
                            $name = $message->sender->full_name;

                        }
                        ?>

                        <li class="{{$class}}">
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">{{$name}}</div> <p> {{$message->body}} </p>
                                    @if($message->media)
                                        <div class="mb-3">
                                            <a onclick="openFile('{{url('/assets/mms_files/'.$message->media)}}')"> View File</a>

                                            {{--                                            <embed src="{{asset('/assets/mms_files/'.$message->media)}}" width="100%" height="100px" />--}}

{{--                                            <a href="{{url('/assets/mms_files/'.$message->media)}}" target="_blank"> Open</a>--}}
                                        </div>
                                    @endif
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>{{$message->created_at}}</p>
                                </div>
                            </div>
                        </li>
                    @empty

                        <li class="text-center no-g-msg">
                            <p>No Chat History</p>
                        </li>

                    @endforelse

                @else

                    <li class="text-center no-g-msg">
                        <p>No Chat History</p>
                    </li>

                @endif

            </div>
        </ul>
    </div>


@section('scripts')

    <script>

    </script>
@endsection
