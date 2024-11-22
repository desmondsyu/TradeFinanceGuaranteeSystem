@extends('layouts.app')

@section('content')
    <h1>Inventory List</h1>
    <a href="{{ route('inventory.create') }}" class="btn btn-primary">Add New Item</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ route('inventory.show', $item->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('inventory.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
