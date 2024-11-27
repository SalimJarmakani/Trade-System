<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-2xl font-bold text-center text-primary mb-6">Create Guarantee</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Whoops! Something went wrong:</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('guarantee.store') }}" method="POST">
                @csrf

                <!-- Corporate Reference Number -->
                <div class="mb-4">
                    <label for="corporate_reference_number" class="block text-sm font-medium text-gray-700">Corporate Reference Number</label>
                    <input type="text" name="corporate_reference_number" id="corporate_reference_number"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Corporate Reference Number"
                        value="{{ old('corporate_reference_number') }}">
                    required>
                </div>

                <!-- Guarantee Type -->
                <div class="mb-4">
                    <label for="guarantee_type" class="block text-sm font-medium text-gray-700">Guarantee Type</label>
                    <select name="guarantee_type" id="guarantee_type"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2" required>
                        <option value="">Select Type</option>
                        <option value="Bank" {{ old('guarantee_type') == 'Bank' ? 'selected' : '' }}>Bank</option>
                        <option value="Bid Bond" {{ old('guarantee_type') == 'Bid Bond' ? 'selected' : '' }}>Bid Bond</option>
                        <option value="Insurance" {{ old('guarantee_type') == 'Insurance' ? 'selected' : '' }}>Insurance</option>
                        <option value="Surety" {{ old('guarantee_type') == 'Surety' ? 'selected' : '' }}>Surety</option>
                    </select>
                </div>

                <!-- Nominal Amount -->
                <div class="mb-4">
                    <label for="nominal_amount" class="block text-sm font-medium text-gray-700">Nominal Amount</label>
                    <input type="number" step="0.01" name="nominal_amount" id="nominal_amount"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Nominal Amount"
                        value="{{ old('nominal_amount') }}">
                    required>
                </div>

                <!-- Nominal Amount Currency -->
                <div class="mb-4">
                    <label for="nominal_amount_currency" class="block text-sm font-medium text-gray-700">Currency</label>
                    <input type="text" name="nominal_amount_currency" id="nominal_amount_currency"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Currency (e.g., USD)" required>
                </div>

                <!-- Expiry Date -->
                <div class="mb-4">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expiry_date" id="expiry_date"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        required>
                </div>

                <!-- Applicant Name -->
                <div class="mb-4">
                    <label for="applicant_name" class="block text-sm font-medium text-gray-700">Applicant Name</label>
                    <input type="text" name="applicant_name" id="applicant_name"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Applicant Name" required>
                </div>

                <!-- Applicant Address -->
                <div class="mb-4">
                    <label for="applicant_address" class="block text-sm font-medium text-gray-700">Applicant Address</label>
                    <textarea name="applicant_address" id="applicant_address" rows="3"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Applicant Address" required></textarea>
                </div>

                <!-- Beneficiary Name -->
                <div class="mb-4">
                    <label for="beneficiary_name" class="block text-sm font-medium text-gray-700">Beneficiary Name</label>
                    <input type="text" name="beneficiary_name" id="beneficiary_name"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Beneficiary Name" required>
                </div>

                <!-- Beneficiary Address -->
                <div class="mb-4">
                    <label for="beneficiary_address" class="block text-sm font-medium text-gray-700">Beneficiary Address</label>
                    <textarea name="beneficiary_address" id="beneficiary_address" rows="3"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Beneficiary Address" required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-gray-300 font-semibold py-2 px-6 rounded-lg hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary">
                        Create Guarantee
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>