@extends('layouts.user')


@section('custom-css')

@endsection



@section('page-content')

    <div class="container-fluid">

        <!-- start page title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0 font-size-18">Create Package</h4>

                    <div class="page-title-right">


                    </div>



                </div>

            </div>

        </div>

        <!-- end page title -->



        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="text-center mb-5">

                    @if(\Session::has('success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            {!! \Session::get('success') !!}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                        <?php
                        session()->forget('success');
                        ?>

                    @endif


                </div>

            </div>

        </div>

        <form method="post" action="{{route('packages.store')}}" enctype="multipart/form-data">
            @csrf

        <div class="row">


            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="task_title">Package Type</label>
                                    <select name="package_tag_id" id="package_tag_id" class="form-control">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                            <div class="row mb-4">
                                <label for="title">Title</label>
                                <div class="col-lg-12">
                                    <input id="title" name="title" type="text" class="form-control" placeholder="Enter Package Title..." required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="description">Description</label>
                                <div class="col-lg-12">
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Package Description..."></textarea>
                                </div>
                            </div>

                        <div class="row mb-4">
                            <div class="col-lg-8">
                                <label for="price">Price</label>
                                <input id="price" name="price" type="number" class="form-control" placeholder="Enter Package Price..." value="0" required>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="task_title">Per</label>
                                    <select name="per" id="per" class="form-control">
                                        <option value="unlimited">Unlimited</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quartely">Quarterly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="package_items">
                                <div data-repeater-item>
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="task_title">Select Item</label>
                                                <select name="product_id" id="product_id" required class="form-control">
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-4" >
                                            <div class="form-group">
                                                <label for="price">Price Per Item</label>
                                                <input type="number" checked="checked" class="form-control"
                                                       id="price" name="price" value="0" >
                                            </div>
                                        </div>

                                        <div class="col-md-3 mt-4 pt-2" >
                                            <div class="form-group">
                                                <input type="checkbox" class="form-check-inline" id="is_unlimited" name="is_unlimited">
                                                <label for="is_unlimited">Is Unlimited</label>
                                            </div>
                                        </div>

                                        <div class="col-md-5 not-limited mt-3">
                                            <div class="form-group">
                                                <label for="task_title">Qty </label>
                                                <input type="number" name="qty" id="qty" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4 not-limited mt-3">
                                            <div class="form-group">
                                                <label for="task_title">Per</label>
                                                <select name="per" id="per" class="form-control">
                                                    <option value="unlimited">Unlimited</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="quartely">Quarterly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-right mt-3">
                                            <button type="button" data-repeater-delete class="btn btn-sm btn-outline-danger">Remove </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="button" data-repeater-create class="btn btn-outline-success">
                                    Add Item
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-10">
                <button type="submit" class="btn btn-primary">Create Package</button>
                <a href="{{route('pricing')}}" class="btn btn-light">Cancel</a>
            </div>
        </div>
        </form>
        <!-- end row -->



    </div> <!-- container-fluid -->



@endsection





@section('scripts')

    <script src="{{asset('assets')}}/plugins/jquery.repeater-master/jquery.repeater.js" type="text/javascript"></script>

    <script>

        $(document).ready(function (){
            // console.log(1);
        });

        function checkFields(){
            if($(this).is(":checked")){
                $(this).parent().next('.not-limited').hide();
            }else{
                $(this).nextUntil('.not-limited').show();
            }
        }

        $('.repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: false
        });

    </script>

@endsection
