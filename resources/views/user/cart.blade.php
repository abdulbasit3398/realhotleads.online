@extends('layouts.user')

@section('custom-css')

@endsection

@section('page-content')

<div class="container-fluid">

	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">Cart</h4>

				<div class="page-title-right">

				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->



	<div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-nowrap">
                                <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
{{--                                    <th colspan="3">Total</th>--}}
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total = 0;
                                ?>

                                @if(session()->has('packages'))
                                    @foreach ($packages as $package_id)
                                        <?php
                                            $package = \App\Package::find($package_id);
                                            $total += $package->price;
                                        ?>
                                        <tr>
                                            <td>{{$package->title}}</td>
                                            <td>${{$package->price}}</td>

    {{--                                        <td>--}}
    {{--                                            <div class="me-3" style="width: 120px;">--}}
    {{--                                                <input type="number" rowId={{$item->rowId}} value="{{$item->qty}}" class="qty" name="demo_vertical">--}}
    {{--                                                --}}{{-- <span class="input-group-btn-vertical"><button class="btn btn-primary bootstrap-touchspin-up " type="button">+</button><button class="btn btn-primary bootstrap-touchspin-down " type="button">-</button></span> --}}
    {{--                                            </div>--}}

    {{--                                        </td>--}}
    {{--                                        <td>--}}
    {{--                                            $ {{$item->price*$item->qty}}--}}
    {{--                                        </td>--}}
    {{--                                        <td>--}}
    {{--                                            <a href="#" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>--}}
    {{--                                        </td>--}}
                                        </tr>


                                    @endforeach


                                @else
                                    <tr>
                                        <th colspan="2">No items in the cart</th>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>

                        {{--                        <div class="table-responsive">--}}
{{--                            <table class="table align-middle mb-0 table-nowrap">--}}
{{--                                <thead class="table-light">--}}
{{--                                    <tr>--}}

{{--                                        <th>Name</th>--}}
{{--                                        <th>Price</th>--}}
{{--                                        <th>Quantity</th>--}}
{{--                                        <th colspan="3">Total</th>--}}
{{--                                    </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    @foreach ($carts as $item)--}}

{{--                                    <tr>--}}
{{--                                        <td>{{$item->name}}</td>--}}
{{--                                        <td> $ {{$item->price}}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="me-3" style="width: 120px;">--}}
{{--                                                <input type="number" rowId={{$item->rowId}} value="{{$item->qty}}" class="qty" name="demo_vertical">--}}
{{--                                                --}}{{-- <span class="input-group-btn-vertical"><button class="btn btn-primary bootstrap-touchspin-up " type="button">+</button><button class="btn btn-primary bootstrap-touchspin-down " type="button">-</button></span> --}}
{{--                                            </div>--}}

{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            $ {{$item->price*$item->qty}}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <a href="#" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    @endforeach--}}

{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <a href="{{url('pricing')}}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-sm-end mt-2 mt-sm-0">
                                    <a href="{{url('checkout')}}" class="btn btn-success">
                                        <i class="mdi mdi-cart-arrow-right me-1"></i> Checkout </a>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Card Details</h5>

                        <div class="card bg-primary text-white visa-card mb-0">
                            <div class="card-body">
                                <div>
{{--                                    <i class="bx bxl-visa visa-pattern"></i>--}}

                                    <div class="float-end">
                                        <i class="bx bxl-card card-logo display-3"></i>
                                    </div>

                                    <div>
                                        <i class="bx bx-chip h1 text-warning"></i>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-3">
                                        <p>
                                            <i class="fas fa-star-of-life m-1"></i>
                                            <i class="fas fa-star-of-life m-1"></i>
                                            <i class="fas fa-star-of-life m-1"></i>
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p>
                                            <i class="fas fa-star-of-life m-1"></i>
                                            <i class="fas fa-star-of-life m-1"></i>
                                            <i class="fas fa-star-of-life m-1"></i>
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p>
                                            <i class="fas fa-star-of-life m-1"></i>
                                            <i class="fas fa-star-of-life m-1"></i>
                                            <i class="fas fa-star-of-life m-1"></i>
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h5 class="text-white text-center mb-0">
                                            <?php
                                            $ccNum= auth()->user()->bank_detail('card_number');
                                                ?>
                                            {{substr($ccNum,-4)}}
                                        </h5>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <h5 class="text-white float-end mb-0">{{\Auth::user()->bank_detail('card_expiry')}}</h5>
                                    <h5 class="text-white mb-0">{{\Auth::user()->bank_detail('card_holder_name')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Order Summary</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Grand Total :</td>
                                        <td>$ {{$total}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount : </td>
                                        <td>- $ 0</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge :</td>
                                        <td>$ 0</td>
                                    </tr>
                                    <tr>
                                        <td>Estimated Tax : </td>
                                        <td>$ 0</td>
                                    </tr>
                                    <tr>
                                        <th>Total :</th>
                                        <th>${{$total}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
                <!-- end card -->
            </div>
		</div>
		<!-- end row -->

	</div> <!-- container-fluid -->

	@endsection


	@section('scripts')
	<script type="text/javascript" src="{{asset('assets/js/tooltip.js')}}"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script>
        $("input[name='demo_vertical']").TouchSpin({ verticalbuttons: !0 });
    </script>
<script>

$('.bootstrap-touchspin-up').on('click',function(){
    event.preventDefault();
    let qty=$('.qty').val();
    let id=$('.qty').attr('rowId');
    var data = "CartId="+id+"&buttonId="+'add'+"&qty="+qty;
    $.ajax({
		url: '{{ url('qty-update') }}',
			method: "post",
			data: {
					_token: '{{ csrf_token() }}',
                    CartId:id,
                    buttonId:'add',
                    qty:qty,
			},
			success: function (response) {
				location.reload()
	    	}
	});
});
$('.bootstrap-touchspin-down').on('click',function(){
    event.preventDefault();
    let qty=$('.qty').val();
    let id=$('.qty').attr('rowId');
    var data = "CartId="+id+"&buttonId="+'add'+"&qty="+qty;
    $.ajax({
		url: '{{ url('qty-update') }}',
			method: "post",
			data: {
					_token: '{{ csrf_token() }}',
                    CartId:id,
                    buttonId:'add',
                    qty:qty,
			},
			success: function (response) {
				location.reload()
	    	}
	});
});

// }
</script>

	@endsection
