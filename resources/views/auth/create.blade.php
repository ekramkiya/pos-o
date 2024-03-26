@extends('layouts.admin')

@section('title', 'Create Employe')
@section('content-header', 'Create Employe')

@section('content')

<div class="card">
    <div class="card-body">
@php

@endphp
        <form action="{{ route('employe.store') }}" method="POST">
            
            @csrf
           @method('PUT') 
            <div class="form-group col-lg-8">
                <label for="name">First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                    placeholder="First Name">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-lg-8">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                    placeholder="Last Name">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-lg-8">
                <label for="email">Email </label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="first_name"
                    placeholder="Email" >
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-lg-8">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    placeholder="Password" >
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-lg-8">
                <label for="password-confirm">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password-confirm" placeholder="Password" >
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>  

            <div class="form-group col-lg-8">
            
                    <div class="row">
                  
                            <div class="col">

                                    <label for="user_role">Choose a Role:</label>
                                    <select  name="user_role" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                
                            </div>
                        </div>
              
              
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
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