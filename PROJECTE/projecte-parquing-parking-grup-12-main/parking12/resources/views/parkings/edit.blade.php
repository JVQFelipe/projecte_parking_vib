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
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-black">Editar Parking</h2>
            </div>

            <form method="POST" action="/parkings/update/{{$parking->id}}">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nou nom del Parking:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $parking->name) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700">Adreça:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $parking->address) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ciutat:</label>
                    <input type="text" id="city" name="city" value="{{ old('city', $parking->city) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="latitude" class="block text-sm font-medium text-gray-700">Latitud:</label>
                    <input type="number" step="any" id="latitude" name="latitude" value="{{ old('latitude', $parking->latitude) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="longitude" class="block text-sm font-medium text-gray-700">Longitud:</label>
                    <input type="number" step="any" id="longitude" name="longitude" value="{{ old('longitude', $parking->longitude) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="openTime" class="block text-sm font-medium text-gray-700">Hora d'opertura:</label>
                    <input type="time" id="openTime" name="openTime" value="{{ old('openTime', $parking->openTime) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="closingTime" class="block text-sm font-medium text-gray-700">Hora de tancament:</label>
                    <input type="time" id="closingTime" name="closingTime" value="{{ old('closingTime', $parking->closingTime) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="parkingType" class="block text-sm font-medium text-gray-700">Tipus de Parking:</label>
                    <select name="parkingType" id="parkingType" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="OpenAccess" {{ (old('parkingType', $parking->parkingType) == 'OpenAccess') ? 'selected' : '' }}>Accés lliure</option>
                        <option value="PlateRecognition" {{ (old('parkingType', $parking->parkingType) == 'PlateRecognition') ? 'selected' : '' }}>Reconeixement de matrícula</option>
                        <option value="AssignedSlot" {{ (old('parkingType', $parking->parkingType) == 'AssignedSlot') ? 'selected' : '' }}>Plaça assignada</option>
                        <option value="AutomatedRobot" {{ (old('parkingType', $parking->parkingType) == 'AutomatedRobot') ? 'selected' : '' }}>Automàtic</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="availableSlots" class="block text-sm font-medium text-gray-700">Numero de places:</label>
                    <input type="number" id="availableSlots" name="availableSlots" value="{{ old('availableSlots', $parking->availableSlots) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('parkings.index') }}" class="bg-gray-300 text-gray-800 py-3 px-6 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">Tornar</a>
                    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Editar Parking</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
