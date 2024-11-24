@extends('layouts.app')

@section('content')
    <h1>Uploaded Files</h1>

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


    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>

    <ul>
        @foreach ($files as $file)
            <li>
                {{ $file->filename }}
                <form action="{{ route('files.delete', $file->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
