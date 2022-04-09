@forelse($contacts as $contact)

    <li onclick="getMessages({{$contact->conversation_id}} , {{$contact->id}}, '{{$person->first_name.' '.$person->last_name }}')">
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

@empty

    <li class="text-center">
        <p>No contact</p>
    </li>
@endforelse
