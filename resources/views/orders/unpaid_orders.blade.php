<!-- unpaid-orders.blade.php -->

@extends('layouts.admin')

@section('title', 'Unpaid Orders')
@section('content-header', 'Unpaid Orders')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-primary">Open POS</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Received Amount</th>
                    <th>Received By</th>
                    <th>Status</th>
                    <th>To Pay</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @if ($order->receivedAmount() < $order->total())
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->getCustomerName()}}</td>
                            <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                            <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                            <td>{{ $order->getUserFullName() }}</td>
                            <td>
                                @if ($order->receivedAmount() == 0)
                                    <span class="badge badge-danger">Not Paid</span>
                                @else
                                    <span class="badge badge-warning">Partial</span>
                                @endif
                            </td>
                            <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        {{ $orders->appends(request()->query())->render() }}
    </div>
</div>
@endsection