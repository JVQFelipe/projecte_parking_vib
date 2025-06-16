<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">

                <div class="mb-6">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="mb-6 text-center">
                    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">Editar Tarifa</h2>
                </div>

                <form method="POST" action="{{ route('rates.update', $rate->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nou nom de la Tarifa:
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $rate->name) }}" 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                    </div>

                    <div class="mb-6">
                        <label for="isActive" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Està activa?
                        </label>
                        <div class="flex items-center mt-2">
                            <input 
                                type="checkbox" 
                                id="isActive" 
                                name="isActive" 
                                {{ old('isActive', $rate->isActive) ? 'checked' : '' }} 
                                class="h-6 w-6 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500">
                            <label for="isActive" class="ml-2 text-gray-700 dark:text-gray-300">Sí</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="ratePerMinute" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Preu per minut:
                        </label>
                        <input 
                            type="number" 
                            step="any" 
                            id="ratePerMinute" 
                            name="ratePerMinute" 
                            value="{{ old('ratePerMinute', $rate->ratePerMinute) }}" 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('rates.index') }}" 
                           class="bg-gray-300 text-gray-800 py-3 px-6 rounded-lg shadow-md hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition duration-300">
                            Tornar
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                            Editar Tarifa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
