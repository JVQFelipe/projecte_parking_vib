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
        
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">Gestió de Parkings</h2>

        <!-- MAPA -->
        <div class="relative mt-6 mb-6" style="overflow: hidden;">
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($parkings as $parking)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $parking->name }}</h3>
                        <p class="text-gray-600">{{ $parking->address }}</p>

                        <div class="mt-4 space-y-2">
                            <p><strong>Ciutat:</strong> {{ $parking->city }}</p>
                            <p><strong>Hora apertura:</strong> {{ $parking->openTime }}</p>
                            <p><strong>Hora tancament:</strong> {{ $parking->closingTime }}</p>
                            <p><strong>Capacitat:</strong> {{ $parking->availableSlots }}</p>
                            <!-- Galeria -->
                            <a href="{{ route('gallery', $parking->id) }}" class="text-blue-600 hover:text-blue-800">Galeria</a>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            @if(auth()->user()->role == 'admin')
                                <a href="/parkings/edit/{{ $parking->id }}" 
                                   class="bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-yellow-700 w-full text-center">
                                   Editar
                                </a>
                                <a href="/parkings/destroy/{{ $parking->id }}" 
                                   class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 w-full text-center">
                                   Esborrar
                                </a>
                            @endif

                            <a href="/parkings/show/{{ $parking->id }}" 
                               class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 w-full text-center">
                               Mostrar
                            </a>
                            <a href="/parkings/{{ $parking->id }}/rates" 
                               class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 w-full text-center">
                               Tarifes
                            </a>
                            <a href="{{ route('parkings.floorsparking', $parking->id) }}" 
                               class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 w-full text-center">
                               Plantes
                            </a>
                            <a href="{{ route('parkings.ticketsparking', $parking->id) }}" 
                               class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 w-full text-center">
                               Tickets
                            </a>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('parkingslots.aparcar.form', ['id' => $parking->id]) }}" 
                               class="bg-blue-600 text-white py-4 px-8 rounded-lg shadow-md hover:bg-blue-700 transform hover:translate-y-[-4px] transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 block w-full text-center">
                                Aparcar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $parkings->links() }}
        </div>

        @if(auth()->user()->role == 'admin') <!--afegir parking (només admin)-->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('parkings.create') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Afegir Nou Parking</a>
        </div>

        <form action="{{ route('parkings.index') }}" method="GET" class="mt-4 flex items-center space-x-4">
            <label for="page" class="text-gray-700 dark:text-white">Anar a pàgina:</label>
            <input type="number" id="page" name="page" min="1" class="px-4 py-2 border rounded-md" placeholder="1" required>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">Anar</button>
        </form>
        @endif
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([41.1183, 1.2445], 15);    

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        @foreach($parkings as $parking)
            L.marker([{{ $parking->latitude }}, {{ $parking->longitude }}])
            .addTo(map)
            .bindPopup('<b>{{ $parking->name }}</b><br>{{ $parking->address }}<br><button onclick="showParkingDetails({{ $parking->id }})">Detalls</button>');
        @endforeach

        function showParkingDetails(parkingId) {
            window.location.href = '/parkings/show/' + parkingId;
        }
    </script>
</x-app-layout>
