@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Guarantees</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Corporate Reference</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nominal Amount</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Currency</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Expiry Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($guarantees as $guarantee)
                    <tr>
                        <td class="px-4 py-2">{{ $guarantee->corporate_reference_number }}</td>
                        <td class="px-4 py-2">{{ $guarantee->guarantee_type }}</td>
                        <td class="px-4 py-2">{{ $guarantee->nominal_amount }}</td>
                        <td class="px-4 py-2">{{ $guarantee->nominal_amount_currency }}</td>
                        <td class="px-4 py-2">{{ $guarantee->expiry_date }}</td>
                        <td class="px-4 py-2">{{ $guarantee->status }}</td>
                        <td class="px-4 py-2 space-x-2">
                            @if ($guarantee->status === 'New')
                                <form method="POST" action="{{ route('guarantees.review', $guarantee->id) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:underline">Review</button>
                                </form>
                            @endif

                            @if ($guarantee->status === 'Approved')
                                <form method="POST" action="{{ route('guarantees.apply', $guarantee->id) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:underline">Apply</button>
                                </form>
                            @endif

                            @if ($guarantee->status === 'Under Review')
                                <form method="POST" action="{{ route('guarantees.issue', $guarantee->id) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-500 hover:underline">Issue</button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('guarantees.destroy', $guarantee->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline"
                                    onclick="return confirm('Are you sure you want to delete this guarantee?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center">No guarantees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
