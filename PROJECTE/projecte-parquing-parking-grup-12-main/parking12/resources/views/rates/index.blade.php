<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tarifes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">Tarifes</h2>
                    <a href="{{ route('rates.create') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Afegir Tarifa
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-lg shadow-lg">
                        <thead class="bg-gray-200 dark:bg-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Activa?</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Preu per minut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rates as $rate)
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $rate->id }}</td>
                                    <td class="px-6 py-4">{{ $rate->name }}</td>
                                    <td class="px-6 py-4">{{ $rate->isActive ? 'Sí' : 'No' }}</td>
                                    <td class="px-6 py-4">{{ $rate->ratePerMinute }}</td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <a href="{{ route('rates.show', $rate->id) }}" class="text-blue-500 hover:underline">Mostrar</a>
                                        <a href="{{ route('rates.edit', $rate->id) }}" class="text-green-500 hover:underline">Editar</a>
                                        <a href="/rates/destroy/{{ $rate->id }}" class="text-red-600 hover:text-red-800">Esborrar</a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $rates->links('pagination::tailwind') }}
                </div>

                <div class="mt-6">
                    <form action="{{ route('rates.index') }}" method="GET" class="flex items-center space-x-4">
                        <label for="page" class="text-gray-700 dark:text-gray-300">Anar a pàgina:</label>
                        <input type="number" id="page" name="page" min="1" placeholder="1" class="p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                            Anar
                        </button>
                    </form>
                </div>

</x-app-layout>
