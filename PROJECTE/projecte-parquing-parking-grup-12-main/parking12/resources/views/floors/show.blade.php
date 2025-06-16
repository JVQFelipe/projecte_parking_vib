<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('Detalls de la Planta') }}</h2>

        <!-- Botón de Tornar visible para todos -->
        <div class="mb-4">
            <a href="{{ route('parkings.floorsparking', $floors->parking->id) }}" class="text-blue-600 hover:text-blue-800">&larr; Tornar</a>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md mb-4">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">ID</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Nom</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Capacitat</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Està obert?</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Latitud</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Longitud</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Parking</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900">
                    <tr>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->id }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->name }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->capacity }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->isOpen ? 'Sí' : 'No' }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->latitude }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->longitude }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floors->parking->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex space-x-4">

             <!-- Botón Editar visible solo para admin -->
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('floors.edit', $floors->id) }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">{{ __('Editar') }}</a>

                <form action="{{ route('floors.destroy', $floors->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700" onclick="return confirm('Estàs segur que vols eliminar aquesta planta?')">{{ __('Eliminar') }}</button>
                </form>
            
            @endif

        </div>
    </div>
</x-app-layout>
