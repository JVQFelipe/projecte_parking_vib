<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Plaça') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('floors.slotsfloor', $floor->id) }}" class="text-blue-500 hover:underline">&larr; Tornar</a>
                </div>

                <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-8">Crear Plaça</h3>

                <form action="{{ route('parkingslots.store', ['parking' => $parking->id, 'floor' => $floor->id]) }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom:</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-6">
                        <label for="slotType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipus de plaça:</label>
                        <select id="slotType" name="slotType" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="normal">Normal</option>
                            <option value="motorbike">Moto</option>
                            <option value="big">Gran</option>
                            <option value="adapted">Adaptada</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="slotStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estat de la plaça:</label>
                        <select id="slotStatus" name="slotStatus" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="open">Disponible</option>
                            <option value="occupied">Ocupada</option>
                            <option value="closed">Cerrada</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="mb-6">
                            <label for="x1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">X1:</label>
                            <input type="number" id="x1" name="x1" step="0.01" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-6">
                            <label for="y1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Y1:</label>
                            <input type="number" id="y1" name="y1" step="0.01" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-6">
                            <label for="x2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">X2:</label>
                            <input type="number" id="x2" name="x2" step="0.01" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-6">
                            <label for="y2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Y2:</label>
                            <input type="number" id="y2" name="y2" step="0.01" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Crear Plaça</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
