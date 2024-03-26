@extends('layouts.admin')

@section('title', 'Assign Permission')
@section('content-header', 'Assign Permission')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('toupdate') }}" method="get">

                @csrf
                <div class="form-group">
                    <input type="hidden" name="role" value="{{ $role_id->id }}">
                    @foreach ($permissions as $permission)
                        <label>
                            {{ $permission->name }}
                            <input type="checkbox" value="{{ $permission->id }}" name="permissions[]" class="checkbox"
                                {{ in_array($permission->id, $role_id->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                        </label>
                        <br>
                    @endforeach
                    <br>
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
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
