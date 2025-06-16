<x-app-layout>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Afegir Planta</title>
            <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.24/dist/tailwind.min.js"></script>
        </head>
        <body class="bg-gray-100">

            <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
                <a href="{{ route('parkings.index') }}" class="text-blue-500 hover:underline">&larr; Tornar</a>

                <h1 class="text-2xl font-bold text-center mt-4 mb-8">Afegir Nova Planta</h1>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded-md mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('floors.store', ['parking_id' => $parking->id]) }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom de la Planta:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="latitude" class="block text-sm font-medium text-gray-700">Latitud:</label>
                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="longitude" class="block text-sm font-medium text-gray-700">Longitud:</label>
                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Capacitat:</label>
                        <input type="text" id="capacity" name="capacity" value="{{ old('capacity') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <input type="hidden" name="parking_id" value="{{ $parking->id }}">

                    <div class="mt-8">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Crear Planta</button>
                    </div>
                </form>
            </div>

        </body>
    </html>
</x-app-layout>
