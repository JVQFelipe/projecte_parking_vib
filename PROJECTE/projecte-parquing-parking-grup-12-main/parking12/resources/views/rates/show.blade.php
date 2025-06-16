<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mostrar Tarifa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('rates.index') }}" class="text-blue-500 hover:underline">&larr; Tornar</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-lg shadow-lg">
                        <thead class="bg-gray-200 dark:bg-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Està activa?</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Preu per minut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $rates->id }}</td>
                                <td class="px-6 py-4">{{ $rates->name }}</td>
                                <td class="px-6 py-4">{{ $rates->isActive ? 'Sí' : 'No' }}</td>
                                <td class="px-6 py-4">{{ $rates->ratePerMinute }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
