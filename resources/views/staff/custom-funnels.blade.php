@extends('layouts.admin')

@section('custom-css')

@endsection
@section('page-content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h4>Custom Funnels</h4></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Contact Name</th>
                                        <th>Email</th>
                                        <th>Funnel Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($funnels as $funnel)
                                    <tr>
                                        <?php
                                        $image = 'no-image.png';
                                        if($funnel->files()->exists()){
                                            $file = $funnel->files()->first();
                                            $image = $file->file;
                                        }
                                        ?>
                                        <td >
                                            <a href="{{asset('assets/images/custom-funnels/'.$image)}}" target="_blank">
                                                <img src="{{asset('assets/images/custom-funnels/'.$image)}}" style="height: 70px; width: 70px "  alt="">

                                            </a>
                                        </td>
                                        <td>{{$funnel->user->full_name}}</td>
                                        <td>{{$funnel->user->email}}</td>
                                        <td>{{$funnel->name}}</td>
                                    </tr>
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
    </script>
@endsection
