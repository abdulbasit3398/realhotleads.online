<head>

  <meta charset="utf-8" />
  <title>{{env('APP_NAME')}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">

  <!-- Bootstrap Css -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

  <!-- Icons Css -->
  <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/main.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/plugins/owl-crousal/dist/assets')}}/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('assets/plugins/owl-crousal/dist/assets')}}/owl.theme.default.min.css">
    <!-- Magnific Popup core CSS file -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/magnific/dist/')}}/magnific-popup.css">--}}

{{--    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>--}}
  @section('custom-css')
    @show
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
