@extends('layouts.admin')

@section('title', 'Import Product')
@section('content-header', 'Import Product')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('products.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Choose File</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file" >
                    <label class="custom-file-label" for="file">Choose file</label>
                </div>
                @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <a href="{{route('products.index')}}" class="btn btn-danger">cancel</a>
            <button class="btn btn-primary" type="submit">Import</button>
           
        </form>
    </div>
</div>
@endsection

