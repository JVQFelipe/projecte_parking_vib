<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('Detalls del Parking') }}</h2>

        <div class="mb-4">
            <a href="{{ route('parkings.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Tornar</a>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">ID</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Nom</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Direcció</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Ciutat</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Hora apertura</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Hora tancament</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Latitud</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Longitud</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Places lliures</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900">
                    <tr>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->id }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->name }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->address }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->city }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->openTime }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->closingTime }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->latitude }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->longitude }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parking->availableSlots }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
