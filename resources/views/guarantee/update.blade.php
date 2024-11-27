<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-2xl font-bold text-center text-primary mb-6">Update Guarantee</h1>


            @if (isset($success))
            <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg w-1/3">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-700">Success</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">{{ $success }}</p>
                    </div>
                    <div class="flex justify-end p-4 border-t">
                        <button id="closeModalButton" class="py-2 px-4 bg-primary text-black rounded-lg hover:bg-primary-dark">
                            OK
                        </button>
                    </div>
                </div>
            </div>
            @endif

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

            <form action="{{ route('guarantee.update', $guarantee->corporate_reference_number) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Corporate Reference Number -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Corporate Reference Number</label>
                    <p class="w-full border border-gray-300 rounded-lg shadow-sm bg-gray-100 p-2 mt-1">
                        {{ $guarantee->corporate_reference_number }}
                    </p>
                </div>

                <!-- Guarantee Type -->
                <div class="mb-4">
                    <label for="guarantee_type" class="block text-sm font-medium text-gray-700">Guarantee Type</label>
                    <select name="guarantee_type" id="guarantee_type"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2" required>
                        <option value="">Select Type</option>
                        <option value="Bank" {{ $guarantee->guarantee_type == 'Bank' ? 'selected' : '' }}>Bank</option>
                        <option value="Bid Bond" {{ $guarantee->guarantee_type == 'Bid Bond' ? 'selected' : '' }}>Bid Bond</option>
                        <option value="Insurance" {{ $guarantee->guarantee_type == 'Insurance' ? 'selected' : '' }}>Insurance</option>
                        <option value="Surety" {{ $guarantee->guarantee_type == 'Surety' ? 'selected' : '' }}>Surety</option>
                    </select>
                </div>

                <!-- Nominal Amount -->
                <div class="mb-4">
                    <label for="nominal_amount" class="block text-sm font-medium text-gray-700">Nominal Amount</label>
                    <input type="number" step="0.01" name="nominal_amount" id="nominal_amount"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Nominal Amount"
                        value="{{ old('nominal_amount', $guarantee->nominal_amount) }}" required>
                </div>

                <!-- Nominal Amount Currency -->
                <div class="mb-4">
                    <label for="nominal_amount_currency" class="block text-sm font-medium text-gray-700">Currency</label>
                    <input type="text" name="nominal_amount_currency" id="nominal_amount_currency"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Currency (e.g., USD)"
                        value="{{ old('nominal_amount_currency', $guarantee->nominal_amount_currency) }}" required>
                </div>

                <!-- Expiry Date -->
                <div class="mb-4">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expiry_date" id="expiry_date"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        value="{{ old('expiry_date', $guarantee->expiry_date->format('Y-m-d')) }}" required>
                </div>

                <!-- Applicant Name -->
                <div class="mb-4">
                    <label for="applicant_name" class="block text-sm font-medium text-gray-700">Applicant Name</label>
                    <input type="text" name="applicant_name" id="applicant_name"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Applicant Name"
                        value="{{ old('applicant_name', $guarantee->applicant_name) }}" required>
                </div>

                <!-- Applicant Address -->
                <div class="mb-4">
                    <label for="applicant_address" class="block text-sm font-medium text-gray-700">Applicant Address</label>
                    <textarea name="applicant_address" id="applicant_address" rows="3"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Applicant Address" required>{{ old('applicant_address', $guarantee->applicant_address) }}</textarea>
                </div>

                <!-- Beneficiary Name -->
                <div class="mb-4">
                    <label for="beneficiary_name" class="block text-sm font-medium text-gray-700">Beneficiary Name</label>
                    <input type="text" name="beneficiary_name" id="beneficiary_name"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Beneficiary Name"
                        value="{{ old('beneficiary_name', $guarantee->beneficiary_name) }}" required>
                </div>

                <input type="hidden" name="corporate_reference_number" value="{{ $guarantee->corporate_reference_number }}">
                <!-- Beneficiary Address -->
                <div class="mb-4">
                    <label for="beneficiary_address" class="block text-sm font-medium text-gray-700">Beneficiary Address</label>
                    <textarea name="beneficiary_address" id="beneficiary_address" rows="3"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary mt-1 p-2"
                        placeholder="Enter Beneficiary Address" required>{{ old('beneficiary_address', $guarantee->beneficiary_address) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-gray-500 text-black font-semibold py-2 px-6 rounded-lg hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary">
                        Update Guarantee
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to close the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('successModal');
            const closeButton = document.getElementById('closeModalButton');

            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    modal.classList.add('hidden'); // Hide the modal
                });
            }
        });
    </script>
</x-app-layout>