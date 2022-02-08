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
                            @if ($message = session('success'))
                                <div class="alert alert-success alert-dismissible fade show p-1 mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card-header bg-white pb-1">
                            <h4 class="text-gray-800">Detail Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table cellpadding="5">
                                    <tr>
                                        <td>Nomor Nota</td>
                                        <td>:</td>
                                        <td>{{ $order->receipt_number }}</td>
                                    </tr>

                                    <tr>
                                        <td>Nama Pemesan</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->alamat }}</td>
                                    </tr>

                                    <tr>
                                        <td>Nomor telepon</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->telepon }}</td>
                                    </tr>

                                    <tr>
                                        <td>Tanggal Pemesanan</td>
                                        <td>:</td>
                                        <td>{{ date('d  M  Y', strtotime($order->created_at)) }}
                                            {{ date('H:i:s', strtotime($order->created_at)) }}</td>
                                    </tr>
                                </table>
                                <br>

                                <table class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Menu</th>
                                        <th>Qty</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>

                                    @php
                                        $total = 0;
                                        $no = 1;
                                    @endphp

                                    @foreach ($detailOrder as $detail)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $detail->Menu->nama_menu }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>Rp {{ number_format($detail->Menu->harga) }}</td>
                                            <td>Rp {{ number_format($detail->Menu->harga * $detail->qty) }}</td>
                                        </tr>
                                        @php
                                            $total += $detail->Menu->harga * $detail->qty;
                                            $no++;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Harga :</b></td>
                                        <td><b> Rp.{{ number_format($total) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                </table>
                            </div>
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

    @endpush
