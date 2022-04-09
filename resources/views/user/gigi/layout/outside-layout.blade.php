<!doctype html>
<html lang="en">

@include('user.include.head')

<body data-sidebar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


{{--@include('user.include.header')--}}

<!-- ========== Left Sidebar Start ========== -->
{{--@include('user.include.left-sidebar')--}}
<!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
{{--    <div class="main-content">--}}

        <div class="page-content">
            @section('content')
        @show
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- <script>document.write(new Date().getFullYear())</script> © AIOCRM. -->
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">

                        </div>
                    </div>
                </div>
            </div>
        </footer>
{{--    </div>--}}
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
@include('user.include.scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

@stack('script-js')
</body>
</html>
