<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <a href="{{ route('parkings.index') }}" class="text-blue-500 hover:underline">&larr; Tornar</a>

        <h1 class="text-2xl font-bold text-center mt-4 mb-8">Afegir Nou Parking</h1>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-md mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif 

        <form method="POST" action="{{ route('parkings.store') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom del Parking:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="address" class="block text-sm font-medium text-gray-700">Adreça:</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="city" class="block text-sm font-medium text-gray-700">Ciutat:</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitud:</label>
                <input type="number" step="any" id="latitude" name="latitude" value="{{ old('latitude') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitud:</label>
                <input type="number" step="any" id="longitude" name="longitude" value="{{ old('longitude') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="openTime" class="block text-sm font-medium text-gray-700">Hora d'obertura:</label>
                <input type="time" id="openTime" name="openTime" value="{{ old('openTime') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="closingTime" class="block text-sm font-medium text-gray-700">Hora de tancament:</label>
                <input type="time" id="closingTime" name="closingTime" value="{{ old('closingTime') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="parkingType" class="block text-sm font-medium text-gray-700">Tipus de Parking:</label>
                <select name="parkingType" id="parkingType" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="OpenAccess" {{ old('parkingType') == 'OpenAccess' ? 'selected' : '' }}>Accés lliure</option>
                    <option value="PlateRecognition" {{ old('parkingType') == 'PlateRecognition' ? 'selected' : '' }}>Reconeixement de matrícula</option>
                    <option value="AssignedSlot" {{ old('parkingType') == 'AssignedSlot' ? 'selected' : '' }}>Plaça assignada</option>
                    <option value="AutomatedRobot" {{ old('parkingType') == 'AutomatedRobot' ? 'selected' : '' }}>Automàtic</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="availableSlots" class="block text-sm font-medium text-gray-700">Numero de places:</label>
                <input type="number" id="availableSlots" name="availableSlots" value="{{ old('availableSlots') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Crear Parking</button>
            </div>
        </form>
    </div>
</x-app-layout>
