@extends('layouts.app')
@push('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/themes/semi-dark-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/app-invoice-list.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush


@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="col-md-12">
                        @if ($message = session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show p-1 mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @elseif($message = session('delete'))
                            <div class="alert alert-warning alert-dismissible fade show p-1 mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-header bg-white">
                        <h2 class="h3 text-gray-800">{{ $keranjang->count() }} Item di Keranjang </h2>
                    </div>
                    <div class="card-body">
                        @if ($keranjang->count() < 1)

                            <div class="col-lg-12 item mb-5 pt-10">
                                <div class="card bg-white border">
                                    <div class="card-body" style="padding-bottom:50px;padding-top:50px;">
                                        <h3>Isi keranjang belum ada </h3>
                                    </div>
                                </div>
                            </div>
                        @else
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($keranjang as $list)
                                <div class="cartpage">
                                    <div class="cart pb-0 pt-1">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img class=""
                                                    src="{{ asset('images/menu/' . $list->Menu->image_menu) }}" alt=""
                                                    style="width:100px;">
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="top">
                                                    <p class="item-name">{{ $list->Menu->nama_menu }}</p>
                                                    <div class="top-right">
                                                        <p class="item-price">
                                                            Rp.{{ number_format($list->Menu->harga) }}
                                                        </p>
                                                        <input type="hidden" class="product_id"
                                                            value="{{ $list->menu_id }}">
                                                        <input type="hidden" class="id"
                                                            value="{{ $list->id }}">
                                                        <div class="input-group quantity mr-2" style="width: 120px">
                                                            <div class="input-group-prepend decrement-btn changeQuantity-minus"
                                                                style="cursor: pointer">
                                                                <span class="input-group-text">-</span>
                                                            </div>
                                                            <input type="text" readonly
                                                                class="qty-input form-control bg-white" maxlength="2"
                                                                max="10" value="{{ $list->qty }}">
                                                            <div class="input-group-append increment-btn changeQuantity-plus"
                                                                style="cursor: pointer">
                                                                <span class="input-group-text">+</span>
                                                            </div>
                                                        </div>
                                                        <!-- Subtotal -->
                                                        @php
                                                            $subtotal = $list->Menu->harga * $list->qty;
                                                        @endphp
                                                        <p class="total-item" id="tot-item">
                                                            Rp.{{ number_format($subtotal) }}</p>
                                                    </div>
                                                </div>
                                                <hr class="mt-1 mb-1 hr-cart">
                                                <div class="bottom">
                                                    <div class="row">
                                                        <div class="offset-md-4">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <!-- delete list -->
                                                            <form action="{{ route('keranjang.delete', $list->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm mb-1">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $total += $list->Menu->harga * $list->qty;
                                    @endphp
                                </div>
                            @endforeach
                            <div class="total">
                                <h4 class="total-price mr-5 pr-2" id="tot-price">Total Harga:
                                    Rp.{{ number_format($total) }}
                                </h4>
                            </div>
                            <div class="lb-lp">
                                <form action="{{ route('orderStore') }}" method="post">
                                    @csrf
                                    {{-- <a href="" class="btn btn-primary btn-sm" style="margin-top:20px;">
                                        P e s a n
                                    </a> --}}
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px;">P e s a
                                        n</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </section>
    <!-- users edit ends -->

    </div>



@endsection


@push('script')

    <script>

    </script>
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <script src="{{ asset('/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('/js/core/app.min.js') }}"></script>
    <script src="{{ asset('/js/scripts/customizer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/js/scripts/pages/dashboard-analytics.min.js') }}"></script>
    <script src="{{ asset('/js/scripts/pages/app-invoice-list.min.js') }}"></script>
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>


    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        // Update Cart Data
        $(document).ready(function() {

            $('.changeQuantity-plus').click(function(e) {
                e.preventDefault();

                var id = $(this).closest(".cartpage").find('.id').val();
                var qty = $(this).closest(".cartpage").find('.qty-input').val();
                var quantity = (parseInt(qty) + parseInt(1));
                var product_id = $(this).closest(".cartpage").find('.product_id').val();

                var data = {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'quantity': quantity,
                    'product_id': product_id,
                };

                $.ajax({
                    url: '/keranjang-update',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

            $('.changeQuantity-minus').click(function(e) {
                e.preventDefault();

                var id = $(this).closest(".cartpage").find('.id').val();
                var qty = $(this).closest(".cartpage").find('.qty-input').val();
                var quantity = (parseInt(qty) - parseInt(1));
                var product_id = $(this).closest(".cartpage").find('.product_id').val();

                console.log(id)

                var data = {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'quantity': quantity,
                    'product_id': product_id,
                };

                $.ajax({
                    url: '/keranjang-update',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

        });
    </script>
@endpush
