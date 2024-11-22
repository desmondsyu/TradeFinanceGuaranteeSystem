@extends('layouts.app')

@section('content')
    <h1>Edit Inventory Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" class="form-control" value="{{ $item->product_name }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" class="form-control" value="{{ $item->category }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" class="form-control" value="{{ $item->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
@endsection
