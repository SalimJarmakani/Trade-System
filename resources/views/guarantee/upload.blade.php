<x-app-layout>
    <div class="container mx-auto mt-5 bg-green-600 p-5 rounded">
        <h1 class="text-2xl text-white font-semibold mb-4">Upload Guarantee File</h1>

        @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('guarantee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="file" class="block text-white">Choose File (CSV, XML, JSON)</label>
                <input type="file" name="file" id="file" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Upload File</button>
        </form>
    </div>
</x-app-layout>