@extends('layouts.admin')

@section('title', 'Expenses List')
@section('content-header', 'Expenses List')
@section('content-actions')
@if(auth()->user()->role->hasPermission('expenses create'))
<a href="{{route('expenses.create')}}" class="btn btn-primary">Create Expenses</a>
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
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Created By </th>
                    <th>Created at</th>
              
                    <th>Actions</th>
                </tr>
                
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                <tr>
                    <td>{{$expense->id}}</td>
                    <td>{{$expense->description}}</td>
                    <td>{{$expense->amount}}</td>
                   
                    {{-- <td><img class="product-img" src="{{ Storage::url(user->image) }}" alt=""></td> --}}
                    <td>{{$expense->getUserFullName()}}</td>
                    <td>{{$expense->created_at}}</td>
            
              
                    
                    <td>
                        @if(auth()->user()->role->hasPermission('expenses update'))
                        <a href="{{ route('expenses.edit' , $expense) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->role->hasPermission('expenses delete'))
                        <button class="btn btn-danger btn-delete" data-url="{{route('expenses.destroy', $expense)}}"><i class="fas fa-trash"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $expenses->links() }}
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