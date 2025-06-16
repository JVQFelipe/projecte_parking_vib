<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mostrar Ticket') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <a href="{{ route('parkings.index') }}" class="text-blue-600 hover:underline">&larr; Tornar</a>

        <div class="mt-6 bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full bg-gray-100 rounded-lg">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Matricula</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Hora d'entrada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Hora de sortida</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Temps total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Pagat?</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Parking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tarifa Aplicada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Total a pagar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-200">
                        <td class="px-6 py-4">{{ $tickets->plate }}</td>
                        <td class="px-6 py-4">{{ $tickets->entryTime }}</td>
                        <td class="px-6 py-4">{{ $tickets->exitTime }}</td>
                        <td class="px-6 py-4">{{ $tickets->totalTime }}</td>
                        <td class="px-6 py-4">{{ $tickets->isPaid ? 'Sí' : 'No' }}</td>
                        <td class="px-6 py-4">{{ $tickets->parking->name }}</td>
                        <td class="px-6 py-4">
                            {{ $tickets->parking->parkingType === 'AssignedSlot' ? 'Abonat' : 'Normal' }}
                        </td>
                        <td class="px-6 py-4">{{ number_format($tickets->totalPay, 2) }} €</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('tickets.edit', $tickets->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Editar</a>

                <form action="{{ route('tickets.destroy', $tickets->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200" onclick="return confirm('Estàs segur que vols eliminar aquest ticket?')">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
