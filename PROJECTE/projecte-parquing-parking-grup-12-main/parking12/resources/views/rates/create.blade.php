<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">

                <div class="mb-6 text-center">
                    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">Crear Tarifa</h2>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('rates.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="isActive" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Està activa?</label>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="isActive" name="isActive" value="1" class="h-6 w-6 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500">
                            <label for="isActive" class="ml-2 text-gray-700 dark:text-gray-300">Sí</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="ratePerMinute" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preu per minut:</label>
                        <input type="number" step="any" id="ratePerMinute" name="ratePerMinute" value="{{ old('ratePerMinute') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                            Crear Tarifa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
