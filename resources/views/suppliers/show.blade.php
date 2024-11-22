
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Supplier: {{ $supplier->name }}</h1>
    <h3>Inventories</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supplier->inventories as $inventory)
            <tr>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->quantity }}</td>
                <td>{{ $inventory->formatted_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
