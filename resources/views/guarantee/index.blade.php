<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Guarantees</h1>

        @if (session('success'))
        <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-1/3">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-bold text-gray-700">Success</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">{{ session('success') }}</p>
                </div>
                <div class="flex justify-end p-4 border-t">
                    <button id="closeModalButton" class="py-2 px-4 bg-primary text-black rounded-lg hover:bg-primary-dark">
                        OK
                    </button>
                </div>
            </div>
        </div>
        @endif
        <div class="overflow-x-auto">
            <table class=" table-auto min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-primary text-black">
                    <tr>
                        <th class="py-2 px-4 text-left">Corporate Ref #</th>
                        <th class="py-2 px-4 text-left">Type</th>
                        <th class="py-2 px-4 text-left">Nominal Amount</th>
                        <th class="py-2 px-4 text-left">Currency</th>
                        <th class="py-2 px-4 text-left">Expiry Date</th>
                        <th class="py-2 px-4 text-left">Applicant</th>
                        <th class="py-2 px-4 text-left">Beneficiary</th>
                        <th class="py-2 px-4 text-left">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($guarantees as $guarantee)
                    <tr class="border-b-8 hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $guarantee->corporate_reference_number }}</td>
                        <td class="py-2 px-4">{{ $guarantee->guarantee_type }}</td>
                        <td class="py-2 px-4">{{ number_format($guarantee->nominal_amount, 2) }}</td>
                        <td class="py-2 px-4">{{ $guarantee->nominal_amount_currency }}</td>
                        <td class="py-2 px-4">{{ $guarantee->expiry_date->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">
                            <strong>Name:</strong> {{ $guarantee->applicant_name }}<br>
                            <strong>Address:</strong> {{ $guarantee->applicant_address }}
                        </td>
                        <td class="py-2 px-4">
                            <strong>Name:</strong> {{ $guarantee->beneficiary_name }}<br>
                            <strong>Address:</strong> {{ $guarantee->beneficiary_address }}
                        </td>

                        <td class="py-2 px-4">
                            <!-- View Button -->
                            <a href="{{ route('guarantee.details', $guarantee->corporate_reference_number) }}"
                                class="py-1 px-3 bg-green-500 text-white rounded hover:bg-green-600">
                                View
                            </a>


                            <!-- Delete Button -->
                            <form action="{{ route('guarantee.delete', $guarantee->corporate_reference_number) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this guarantee?');" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-1 px-3 bg-red-500 text-white rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 px-6 text-center text-gray-500">No guarantees available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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