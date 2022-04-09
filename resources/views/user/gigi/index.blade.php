@extends('user.gigi.layout.outside-layout')

@section('custom-css')


@endsection

@section('content')
    <div class="container-fluid">


        <!-- start page title -->
        <div class="row">
            <div class="col-6">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">GIGY</h4>
                    <div class="page-title-right">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <a href="{{route('create-gigy')}}" class="btn btn-success" style="float:right;">Create</a>
            </div>
        </div>

        <?php
        $all = \Illuminate\Support\Facades\File::glob(public_path('assets/images/sales_funnels/*'))

        ?>
        <div class="row" id="accordion">
            @foreach($gigies as $gigy)
                <div class="col-xl-4 col-sm-6 " >
                    <div class="card ">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                            <img src="assets/images/companies/img-1.png" alt="" height="30">
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15"
                                        href="#collapse_{{$gigy->id}}"
                                        data-toggle="collapse" data-parent="#accordion">
                                        {{$gigy->project_name}}
                                    </h5>
                                    <p class="text-muted mb-4">{{$gigy->project_description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0">
{{--                                <li class="list-inline-item me-3">--}}
{{--                                    <span class="badge bg-success">Completed</span>--}}
{{--                                </li>--}}
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i> {{$gigy->start_date}}
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-dollar me-1"></i> {{$gigy->budget}}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div  class="collapse in" id="collapse_{{$gigy->id}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-4">
{{--                                        <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm">--}}
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15">{{ucfirst($gigy->project_name)}}</h5>
                                        <p class="text-muted"></p>
                                    </div>
                                </div>

                                <h5 class="font-size-15 mt-4">Project Details :</h5>

                                <p class="text-muted">{{$gigy->project_description}}</p>

                                <?php
                                $files = json_decode($gigy->images,true);

                                ?>
                                <div class="text-muted mt-4">

                                    @forelse($files as $file)

                                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i>
                                            <a href="{{asset('assets/gigy_project').'/'.$file}}" download>{{$file}}</a>

                                        </p>
                                    @empty
                                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i>No Files added yet</p>@endforelse
                                </div>

                                <div class="row task-dates">
                                    <div class="col-sm-4 col-6">
                                        <div class="mt-4">
                                            <h5 class="font-size-14"><i class="bx bx-dollar me-1 text-primary"></i> Budget</h5>
                                            <p class="text-muted mb-0">{{$gigy->budget}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="mt-4">
                                            <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date</h5>
                                            <p class="text-muted mb-0">{{$gigy->start_date}}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-6">
                                        <div class="mt-4">
                                            <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i> Due Date</h5>
                                            <p class="text-muted mb-0">{{$gigy->end_date}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-xl-4 col-md-6">--}}
{{--                <div class="card plan-box">--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="media">--}}
{{--                            <div class="media-body">--}}
{{--                                <h4 class="h4-blue">1</h4>--}}
{{--                                <p class="text-muted"></p>--}}
{{--                            </div>--}}
{{--                            <div class="ms-3">--}}
{{--                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--                                </i> -->--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="owl-carousel owl-theme">--}}
{{--                            <div class="">--}}
{{--                                <a  href="{{route('image-index','Screenshot_141.png')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_141.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_143.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_142.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}



{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-xl-4 col-md-6">--}}


{{--                <div class="card plan-box">--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="media">--}}
{{--                            <div class="media-body">--}}
{{--                                <h4 class="h4-blue">2</h4>--}}
{{--                                <p class="text-muted"></p>--}}
{{--                            </div>--}}
{{--                            <div class="ms-3">--}}
{{--                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--                                </i> -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="owl-carousel owl-theme">--}}


{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_142.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_141.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_143.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}


{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-4 col-md-6">--}}


{{--                <div class="card plan-box">--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="media">--}}
{{--                            <div class="media-body">--}}
{{--                                <h4 class="h4-blue">3</h4>--}}
{{--                                <p class="text-muted"></p>--}}
{{--                            </div>--}}
{{--                            <div class="ms-3">--}}
{{--                                <!-- <i class="bx bx-question-mark h1 text-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--                                </i> -->--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="owl-carousel owl-theme">--}}

{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_143.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_142.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}

{{--                            <div class="">--}}
{{--                                <a href="{{url('/image')}}" target="_blank" title="">--}}
{{--                                    <img class="img-fluid" src="{{asset('assets/images/sales_funnels/Screenshot_141.png')}}"--}}
{{--                                         style="width:800px; height:600px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--        </div>--}}
        <!-- end row -->

    </div> <!-- container-fluid -->

@endsection

@section('scripts')

    <script>
        function download(file){
            $.file('some/file.pdf');
        }
    </script>

@endsection
