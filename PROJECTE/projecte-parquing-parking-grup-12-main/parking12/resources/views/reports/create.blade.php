<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6">Crear Nuevo Informe</h2>

        <form action="{{ route('reports.store') }}" method="POST">
            @csrf

            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Detalles del Informe</h3>

                <!-- Título del informe -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título del Informe</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <!-- Selección del Parking -->
                <div class="mb-4">
                    <label for="parking_id" class="block text-sm font-medium text-gray-700">Seleccionar Parking</label>
                    <select name="parking_id" id="parking_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="">Seleccionar Parking</option>
                        @foreach($parkings as $parking)
                            <option value="{{ $parking->id }}">{{ $parking->name }} - {{ $parking->city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Crear Informe</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
