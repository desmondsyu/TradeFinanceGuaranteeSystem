@extends('layouts.app')

@section('content')
    <h1>Add New Inventory Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Item</button>
    </form>
@endsection
