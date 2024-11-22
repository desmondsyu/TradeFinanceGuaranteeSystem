
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Supplier</h1>
    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Info</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info">
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
