@extends('layouts.admin')

@section('title', 'Roles ')
@section('content-header', 'Roles')
@section('content-actions')
@if(auth()->user()->role->hasPermission('role create'))
    <a href="{{ route('role.create') }}" class="btn btn-primary">Create roles</a>
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
                        <th> Name</th>
                        <th>Actions</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>

                            <td>
                                @if(auth()->user()->role->hasPermission('role edit'))
                                <a href="{{ route('role.edit', $role) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                        @endif
                                        @if(auth()->user()->role->hasPermission('role update'))
                                        <a href="{{ route('role.show', $role) }}" class="btn btn-success"><i
                                            class="fas fa-lock"></i></a>
                                            @endif
                                            @if(auth()->user()->role->hasPermission('role delete'))
                                <button class="btn btn-danger btn-delete" data-url="{{ route('role.destroy', $role) }}"><i
                                        class="fas fa-trash"></i></button>
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
                    text: "Do you really want to delete this role?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
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
