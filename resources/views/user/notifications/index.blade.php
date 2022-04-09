<?php

//$notifications = auth()->user()->notifications->take(20);
//$count = auth()->user()->unreadNotifications()->count() > 0 ? auth()->user()->unreadNotifications()->count() : 0;

$count = 0;
?>
<div class="dropdown d-inline-block">
    <button type="button" onclick="markRead()" class="btn header-item noti-icon "
            id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-bell {{$count > 0 ? 'bx-tada' : ''}}"></i>
        <span class="badge bg-danger rounded-pill">{{$count > 0 ? $count :''}}</span>
    </button>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
         aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0" key="t-notifications text-bold"> Notifications </h6>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 230px;">
            {{-- @forelse($notifications as $notification)
                <div style="{{$notification->read_at ? '' : 'background-color: cornsilk'}}">
                    <div class="text-reset notification-item " >
                        <div class="media">
  
                            <div class="media-body">
                                <h6 class="mt-0 mb-1" key="t-your-order">
                                    @if($notification->data['type'] == 'private')

                                    Private Message

                                    @else

                                    Group Message

                                    @endif
                                </h6>
                                <a href="{{route($notification->data['redirect_route'])}}">
                                    <div class="font-size-12 text-muted">

                                        <p class="mb-1" key="t-grammer">{{$notification->data['notification']}}</p>

                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{$notification->created_at->diffForHumans()}}</span>
                                        </p>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div  class="text-reset notification-item">
                <div class="media">
                    <div class="media-body">
                        <div class="font-size-12 text-muted">
                            <p class="mb-1" key="t-grammer">No notifications yet</p>
                        </div>
                    </div>
                </div>
            </div>



            @endforelse --}}
        </div>
{{--        <div class="p-2 border-top d-grid">--}}
{{--            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">--}}
{{--                <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
</div>


@section('scripts')

     
@endsection
