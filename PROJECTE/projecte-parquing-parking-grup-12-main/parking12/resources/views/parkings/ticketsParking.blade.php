<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('Tickets de ' . $parking->name) }}</h2>

        <div class="mb-4">
            <a href="{{ route('parkings.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Tornar</a>
        </div>

        <a href="{{ route('tickets.create', ['parking' => $parking->id]) }}" class="bg-green-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-green-700 transition duration-300 mb-6 inline-block">
            Crear Ticket
        </a>

        @if ($tickets->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No hi ha cap ticket.</p>
        @else
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">ID</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Matricula</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Hora d'entrada</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Hora de sortida</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Pagat?</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900">
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $ticket->id }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $ticket->plate }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $ticket->entryTime }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $ticket->exitTime }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $ticket->isPaid ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2 flex items-center space-x-4">

                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Mostrar</a>
                                    
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="bg-yellow-600 text-white py-2 px-4 rounded-lg hover:bg-yellow-700 transition duration-300">Editar</a>
                                    
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="GET" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300" onclick="return confirm('Estàs segur de voler eliminar aquest ticket?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
