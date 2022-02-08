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
                        <div class="card-header bg-white">
                            <h4 class="text-gray-800">Riwayat Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">TGL Pesanan</th>
                                            <th scope="col">NO Nota</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ date('d  M  Y', strtotime($order->created_at)) }}</td>
                                                <td>{{ $order->receipt_number }}</td>
                                                <td><a class="btn btn-primary btn-sm"
                                                        href="{{ route('detailOrder', $order->id) }}">Detail
                                                        Pesanan</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{ $orders->links() }}
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
