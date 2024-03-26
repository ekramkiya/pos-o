@extends('layouts.admin')

@section('title', 'Edit Orders')
@section('content-header', 'Edit Orders')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('orders.update', $order) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="remaining_amount">Remaining Amount</label>
                    <input type="number"  class="form-control"  value="{{ $order->remainamount() }}" readonly>
                </div>


                <div class="form-group">
                    <label for="amount">Received Amount</label>
                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount"
                        placeholder="amount" value="{{ old('amount', $order->payments->first()->amount ?? '') }}">
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
