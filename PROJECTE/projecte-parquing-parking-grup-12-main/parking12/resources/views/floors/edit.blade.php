<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            @if (session('success'))
                <div class="text-white bg-green-500 p-4 rounded-lg shadow-md mb-4">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="text-white bg-red-500 p-4 rounded-lg shadow-md mb-4">{{ session('error') }}</div>
            @endif
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6 max-w-4xl mx-auto">
            <div class="mb-6 flex justify-center">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-black">Editar Planta</h2>
            </div>

            <form action="{{ route('floors.update', $floor->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nom de la Planta</label>
                    <input type="text" id="name" name="name" value="{{ $floor->name }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="latitude" class="block text-gray-700">Latitud</label>
                    <input type="text" id="latitude" name="latitude" value="{{ $floor->latitude }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="longitude" class="block text-gray-700">Longitud</label>
                    <input type="text" id="longitude" name="longitude" value="{{ $floor->longitude }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="capacity" class="block text-gray-700">Capacitat</label>
                    <input type="number" id="capacity" name="capacity" value="{{ $floor->capacity }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="isOpen" class="block text-gray-700">¿Està obert?</label>
                    <input type="checkbox" id="isOpen" name="isOpen" value="1" {{ $floor->isOpen ? 'checked' : '' }} class="h-6 w-6">
                </div>

                <div class="mb-4">
                    <label for="parking_id" class="block text-gray-700">Parking Associat</label>
                    <input type="text" id="parking_id" name="parking_id" value="{{ $floor->parking->name }}" readonly class="w-full p-3 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('parkings.floorsparking', $floor->parking->id) }}" class="bg-gray-300 text-gray-800 py-3 px-6 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">Tornar</a>
                    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Actualizar Planta</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
