@extends('backend.layouts.app')

@section('title', 'Confirmed Orders')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">
                        <h4>Confirmed Orders</h4>
                    </span>
                    <span class="float-right">
                        @if(check('Confirmed Order')->add)
                        <a href="{{ route('confirmed-order.create') }}" class="btn btn-primary">Add New Order</a>
                        @endif
                    </span>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Excel Records</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->date }}</td>
                                <td>{{ $order->excels->count() }}</td>
                                <td>
                                    <a href="{{ route('confirmed-order.show', $order->id) }}"
                                       class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
