
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Suppliers</h1>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Add Supplier</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->short_contact_info }}</td>
                <td>
                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
