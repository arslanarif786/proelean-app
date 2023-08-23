@extends('layouts.app')

@section('main')
<div class="content-page">
    <div class="content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            {{-- <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div> --}}
                            {{-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a> --}}
                        </form>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
                <div class="row">
                    <div class="col-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Users</h5>
                                <h3 class="mt-3 mb-3">{{$lastThirtyDaysUsers}}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2">{{$lastThirtyDaysUsers*$total_user/100}}%</span>
                                    <span class="text-nowrap">Since last 30 Days</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                <h3 class="mt-3 mb-3">{{$total_lastThirtyDaysOrders}}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2">{{$total_lastThirtyDaysOrders*$total_orders/100}}%</span>
                                    <span class="text-nowrap">Since last 30 Days</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Total Users</h5>
                                <h3 class="mt-3 mb-3">{{$total_user}}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"></span>
                                    <span class="text-nowrap"></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-currency-usd widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Total Category</h5>
                                <h3 class="mt-3 mb-3">{{$total_category}}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"></span>
                                    <span class="text-nowrap"></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-pulse widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Total  Orders</h5>
                                <h3 class="mt-3 mb-3">{{$total_orders}}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"></span>
                                    <span class="text-nowrap"></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-pulse widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Toatl Sub Category</h5>
                                <h3 class="mt-3 mb-3">{{$total_subcategory}}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"></span>
                                    <span class="text-nowrap"></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

        </div>
        <!-- end row -->
        <!-- end row -->


        <div class="row">
            <div class="col-xl-12 col-lg-12 order-lg-12 order-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-2 mb-3">Top Selling Users</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                    @foreach($sellers as $seller)
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">{{$seller->name}}</h5>
                                            <span class="text-muted font-13">{{date("d M Y")}}</span>
                                        </td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">{{$seller->total_earning}}</h5>
                                            <span class="text-muted font-13">Earning</span>
                                        </td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">{{$seller->total_orders}}</h5>
                                            <span class="text-muted font-13">Order</span>
                                        </td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">{{$seller->availabe_balance}}</h5>
                                            <span class="text-muted font-13">Avalaible Balance</span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
            <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- End Content -->
</div>

@endsection
