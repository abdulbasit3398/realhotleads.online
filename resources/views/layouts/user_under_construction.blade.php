<!doctype html>
<html lang="en">
    <style type="text/css">
        .card{
            box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 59%) !important;
        }
        body{
            background: white !important;
        }
    </style>
    @include('user.include.head')

    <body>
        <div class="mx-5">
            <a href="{{route('sales-funnels')}}">
                <img src="{{asset('assets/images/realhotleads.png')}}" style="width:100%">
            </a>
            
        </div>
        {{-- <div class="home-btn d-none d-sm-block">
            <a href="{{route('dashboard')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> --}}

        <section class="my-5 pt-sm-5">
            {{-- <div class="container"> --}}
            <div class="mx-5">
                @section('container')
                    @show
            </div>
        </section>

        
        <!-- JAVASCRIPT -->
        @include('user.include.scripts')

    </body>
</html>
