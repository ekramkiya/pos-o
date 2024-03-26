@extends('layouts.admin')

@section('content-header', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $orders_count }}</h3>
                        <p>Orders Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ config('settings.currency_symbol') }} {{ number_format($income, 2) }}</h3>
                        <p>Income</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ config('settings.currency_symbol') }} {{ number_format($income_today, 2) }}</h3>

                        <p>Income Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>

                    </div>
                    <a href="{{ route('orders.index', ['paid_only' => true]) }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ config('settings.currency_symbol') }} {{ $unpaid }}</h3>
                        <p>Not paid</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('orders.index', ['unpaid_only' => true]) }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ config('settings.currency_symbol') }} {{ $expenses_count }}</h3>
                        <p>Expenses</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <a href="{{ route('expenses.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ config('settings.currency_symbol') }} {{ $expenses_daily }}</h3>
                        <p>Expenses Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <a href="{{ route('expenses.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ config('settings.currency_symbol') }} {{ $purchase_sum }}</h3>
                        <p>Purchases</p>
                    </div>
                    <div class="icon">
                      <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <a href="{{ route('purchase.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                       <!-- ./col -->
                       <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$total_shortage_quantity}}</h3>
                                <p>Shortage list</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <a href="{{ route('product.shortage') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $customers_count }}</h3>

                        <p>Customers Count</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>{{ $users_count }}</h3>
                        <p>Users Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('employe.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
@endsection
