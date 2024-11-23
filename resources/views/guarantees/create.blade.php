@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <form method="POST" action="{{ route('guarantees.store') }}" class="space-y-4 p-4 w-96">
            @csrf
            <div>
                <label for="corporate_reference_number" class="block text-sm font-medium text-gray-700">Corporate Reference
                    Number:</label>
                <input type="text" name="corporate_reference_number" id="corporate_reference_number" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="guarantee_type" class="block text-sm font-medium text-gray-700">Guarantee Type:</label>
                <select name="guarantee_type" id="guarantee_type" required class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="Bank">Bank</option>
                    <option value="Bid Bond">Bid Bond</option>
                    <option value="Insurance">Insurance</option>
                    <option value="Surety">Surety</option>
                </select>
            </div>
            <div>
                <label for="nominal_amount" class="block text-sm font-medium text-gray-700">Nominal Amount:</label>
                <input type="number" name="nominal_amount" id="nominal_amount" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="nominal_amount_currency" class="block text-sm font-medium text-gray-700">Currency:</label>
                <select name="nominal_amount_currency" id="nominal_amount_currency" required
                    class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="CAD">Canadian Dollar</option>
                    <option value="USD">US Dollar</option>
                    <option value="MXN">Mexican Peso</option>
                </select>
            </div>
            <div>
                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date:</label>
                <input type="date" name="expiry_date" id="expiry_date" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="applicant_name" class="block text-sm font-medium text-gray-700">Applicant Name:</label>
                <input type="text" name="applicant_name" id="applicant_name" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="applicant_address" class="block text-sm font-medium text-gray-700">Applicant Address:</label>
                <input type="text" name="applicant_address" id="applicant_address" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="beneficiary_name" class="block text-sm font-medium text-gray-700">Beneficiary Name:</label>
                <input type="text" name="beneficiary_name" id="beneficiary_name" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="beneficiary_address" class="block text-sm font-medium text-gray-700">Beneficiary
                    Address:</label>
                <input type="text" name="beneficiary_address" id="beneficiary_address" required
                    class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <input type="text" name="status" id="status" value="New" readonly
                    class="mt-1 block w-full border-gray-300 bg-gray-100 rounded-md" />
            </div>

            <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Create Guarantee
            </button>
        </form>
    </div>
@endsection
