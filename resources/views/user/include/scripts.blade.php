<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>

<script src="{{asset('assets/plugins/owl-crousal/dist')}}/owl.carousel.min.js"></script>
{{--<script src="{{asset('assets/plugins/magnific/dist')}}/jquery.magnific-popup.js"></script>--}}
{{--<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>--}}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            center: true,
            items:1,
            loop:true,
            autoplay:false
        });


    //     var $carousel = $('.carousel');
    //
    //     $carousel
    //         .slick({
    //             dots: true,
    //             zoomPower   : 1,    //Default
    //             glassSize   : 180,
    //         }).magnificPopup({
    //             type: 'image',
    //             delegate: 'a:not(.slick-cloned)',
    //             gallery: {
    //                 enabled: true
    //             },
    //             callbacks: {
    //                 open: function() {
    //                     var current = $carousel.slick('slickCurrentSlide');
    //                     $carousel.magnificPopup('goTo', current);
    //                 },
    //                 beforeClose: function() {
    //                     $carousel.slick('slickGoTo', parseInt(this.index));
    //                 }
    //             },
    //         });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    function loadingStart() {
        Swal.fire({
            title: 'Please wait !',
            allowEscapeKey: false,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        })
    }

    function loadingStop() {
        $(".swal2-container ").remove();
        $('body').removeClass('swal2-shown swal2-height-auto')
    }

    function success(){
    Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1000
    });
}


</script>


@section('scripts')

@show
