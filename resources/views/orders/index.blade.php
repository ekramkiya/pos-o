@extends('layouts.admin')

@section('title', 'Orders List')
@section('content-header', 'Order List')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-primary">Open POS</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <form action="{{ route('orders.index') }}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mb-4 " style="margin-top: -30px">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="query" class="form-control" placeholder="Search..." value="{{ request('query') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Received Amount</th>
                    <th>To Pay</th>
                    <th>Status</th>
                    <th>Received By</th>
                    <th>Created At</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>

                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Partial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Change</span>
                        @endif
                    </td>
                    <td> {{ $order->getUserFullName() }}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        @if(auth()->user()->role->hasPermission('order edit'))
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->role->hasPermission('order delete'))
                        <button class="btn btn-danger btn-delete" data-url="{{route('orders.destroy', $order)}}"><i class="fas fa-trash"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection

