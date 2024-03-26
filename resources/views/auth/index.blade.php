@extends('layouts.admin')

@section('title', 'Employe List')
@section('content-header', 'Employe List')
@section('content-actions')
@if(auth()->user()->role->hasPermission('employe create'))
<a href="{{route('employe.create')}}" class="btn btn-primary">Create Employe</a>
@endif
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                   
                    {{-- <td><img class="product-img" src="{{ Storage::url(user->image) }}" alt=""></td> --}}
                    <td>{{$user->email }}</td>
                    <td>{{Str::limit($user->password,15,'...')}}</td>
            
                    <td>
                        @php
                        $roles = [
                            1 => 'Super Admin',
                            2 => 'Admin',
                            3 => 'Seller'
                        ];
            
                        echo $roles[$user->user_role] ?? 'Unknown role';
                        @endphp
                    </td>
                    
                    <td>
                        @if(auth()->user()->role->hasPermission('employe update'))
                        <a href="{{ route('employe.edit' , $user) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->role->hasPermission('employe delete'))
                        <button class="btn btn-danger btn-delete" data-url="{{route('employe.destroy', $user)}}"><i class="fas fa-trash"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="module">
    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function() {
            var $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {
                        _method: 'DELETE',
                        _token: '{{csrf_token()}}'
                    }, function(res) {
                        $this.closest('tr').fadeOut(500, function() {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection