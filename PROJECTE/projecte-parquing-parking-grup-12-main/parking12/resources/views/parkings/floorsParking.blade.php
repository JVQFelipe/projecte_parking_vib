<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('Plantes de ' . $parking->name) }}</h2>

        <div class="mb-4">
            <a href="{{ route('parkings.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Tornar</a>
        </div>

        @if (auth()->user()->role === 'admin') <!-- funcionalitat només admin -->
            <a href="{{ route('floors.create', ['parking' => $parking->id]) }}" class="bg-green-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-green-700 transition duration-300 mb-6 inline-block">
                Afegir Planta
            </a>
        @endif

        @if ($floors->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No hi ha plantes disponibles per a aquest parking.</p>
        @else
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">ID</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Nom</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Capacitat</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Està obert?</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900">
                        @foreach ($floors as $floor)
                            <tr>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floor->id }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floor->name }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floor->capacity }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $floor->isOpen ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2 flex items-center space-x-4">

                                    <a href="{{ route('floors.slotsfloor', $floor->id) }}" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition duration-300">Places</a>
                                    <a href="{{ route('floors.show', $floor->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Mostrar</a>
                                    
                                    @if(auth()->user()->role === 'admin') <!-- funcionalitat només admin -->
                                        <a href="{{ route('floors.edit', $floor->id) }}" class="bg-yellow-600 text-white py-2 px-4 rounded-lg hover:bg-yellow-700 transition duration-300">Editar</a>
                                        <form action="{{ route('floors.destroy', $floor->id) }}" method="GET" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300" onclick="return confirm('Estàs segur de voler eliminar aquesta planta?')">Eliminar</button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
