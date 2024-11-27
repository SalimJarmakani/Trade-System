<x-app-layout>
    <div>
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold text-center text-white mb-6">Guarantee Files</h1>

            <div class="overflow-x-auto">
                <table class="table-auto min-w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-primary text-black">
                        <tr>
                            <th class="py-2 px-4 text-left">Corporate Ref #</th>
                            <th class="py-2 px-4 text-left">Type</th>
                            <th class="py-2 px-4 text-left">Nominal Amount</th>
                            <th class="py-2 px-4 text-left">Currency</th>
                            <th class="py-2 px-4 text-left">Expiry Date</th>
                            <th class="py-2 px-4 text-left">Applicant</th>
                            <th class="py-2 px-4 text-left">Beneficiary</th>
                            <th class="py-2 px-4 text-left">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guarantees as $guaranteeFile)
                        @php
                        $guarantee = $guaranteeFile->guarantee; // Access related Guarantee model
                        @endphp
                        <tr class="border-b hover:bg-gray-100">
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
                                <!-- Download Button -->
                                <a href="{{ route('guarantee.file.download', $guaranteeFile->id) }}"
                                    class="py-1 px-3 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Download
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-4 px-6 text-center text-gray-500">
                                No guarantees available.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>