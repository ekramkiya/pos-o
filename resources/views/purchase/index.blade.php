@extends('layouts.admin')

@section('title', 'purchase List')
@section('content-header', 'purchase List')
@section('content-actions')
{{-- @if(auth()->user()->role->hasPermission('product create')) --}}
<a href="{{route('purchase.create')}}" class="btn btn-primary">Create Product</a>
{{-- @endif --}}
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                <tr>
                    <td>{{$purchase->id}}</td>
                    <td>{{$purchase->name}}</td>
                     <td><img class="product-img" src="{{ Storage::url($purchase->image) }}" alt=""></td>
                     <td>{{$purchase->description}}</td>
                    <td>{{$purchase->price}}</td>
                    <td>{{$purchase->quantity}}</td> 
                   
                    <td>{{$purchase->created_at}}</td>
                    <td>{{$purchase->updated_at}}</td> 
                   <td>
                        @if(auth()->user()->role->hasPermission('purchase update'))
                        <a href="{{ route('purchase.edit', $purchase) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        @endif
                        @if(auth()->user()->role->hasPermission('purchase delete'))
                        <button class="btn btn-danger btn-delete" data-url="{{route('purchase.destroy', $purchase)}}"><i class="fas fa-trash"></i></button>
                        @endif
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $purchase->render() }} --}}
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
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this product?",
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
