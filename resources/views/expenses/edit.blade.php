@extends('layouts.admin')

@section('title', 'Edit Customer')
@section('content-header', 'Edit Expenses')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('expenses.update', $expense) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="first_name">Description</label>
                    <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                           id="description"
                           placeholder=" Description" value="">{{ $expense->description }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror"
                           id="amount"
                           placeholder=" Amount" value="{{ $expense->amount}}">
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
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
