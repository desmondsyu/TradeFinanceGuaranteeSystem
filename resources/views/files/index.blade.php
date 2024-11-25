@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Upload Files</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
            @if (session('errors'))
                <ul>
                    @foreach (session('errors') as $error)
                        <li>Line {{ $error['line'] }}: {{ implode(', ', $error['errors']) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="file" name="file"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Upload
        </button>
    </form>

    <div class="mt-4 space-x-4">
        <a href="{{ asset('sample_files/guarantees.csv') }}" download
            class="text-blue-500 hover:text-blue-700 underline">Download CSV template</a>
        <a href="{{ asset('sample_files/guarantees.xml') }}" download
            class="text-blue-500 hover:text-blue-700 underline">Download XML template</a>
        <a href="{{ asset('sample_files/guarantees.json') }}" download
            class="text-blue-500 hover:text-blue-700 underline">Download JSON template</a>
    </div>

    <ul class="mt-4 space-y-2">
        @foreach ($files as $file)
            <li class="flex items-center justify-between p-4 border border-gray-300 rounded-lg bg-gray-50">
                <span class="text-gray-900">{{ $file->filename }}</span>
                <form action="{{ route('files.delete', $file->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline"
                        onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

@endsection
