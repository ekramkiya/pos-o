@extends('layouts.admin')

@section('title', 'Edit Role')
@section('content-header', 'Edit Role')

@section('content')

<div class="card">
    <div class="card-body">
@php

@endphp
        <form action="{{ route('role.update', $role) }}" method="post">
            
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                    placeholder=" Name" value="{{ old('name', $role->name) }}">
                @error('name')
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