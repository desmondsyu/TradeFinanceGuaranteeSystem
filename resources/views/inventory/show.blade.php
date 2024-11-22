@extends('layouts.app')

@section('content')
    <h1>Inventory Item Details</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $item->product_name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Category:</strong> {{ $item->category }}</p>
            <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
            <p><strong>Price:</strong> ${{ $item->price }}</p>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to Inventory List</a>
            <a href="{{ route('inventory.edit', $item->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
