<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6">Informes de Parkings</h2>

        <div class="mb-6 flex justify-start">
            <a href="{{ route('reports.create') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                Crear nou informe
            </a>
        </div>

        <!-- Grid con 3 columnas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($parkings as $parking)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $parking->name }}</h3>
                        <p class="text-gray-600 mb-4">Ubicació: {{ $parking->address }}</p>

                        @if($parking->reports->isNotEmpty())
                            <ul class="mt-4 space-y-4">
                                @foreach($parking->reports as $report)
                                    <li class="p-4 bg-gray-50 rounded-lg shadow flex items-start justify-between">
                                        <div>
                                            <!-- Título y fecha -->
                                            <a href="{{ route('reports.show', $report->id) }}" class="text-lg font-medium text-blue-600 hover:underline">
                                                {{ $report->title }}
                                            </a>
                                            <p class="text-sm text-gray-500 mt-1">{{ $report->created_at->format('d/m/Y') }}</p>
                                        </div>
                                        <!-- Botones de acción -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('reports.destroy', $report->id) }}" 
                                               class="text-red-600 hover:text-red-800 text-sm font-medium bg-red-100 px-3 py-2 rounded">
                                                Eliminar
                                            </a>
                                            <button 
                                                class="text-green-600 hover:text-green-800 text-sm font-medium bg-green-100 px-3 py-2 rounded"
                                                onclick="openModal('{{ route('reports.download', $report->id) }}')">
                                                Descargar
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 mt-4">No hi ha informes disponibles.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal para seleccionar formato -->
    <div id="formatModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">En quin format ho vols?</h3>
            <form id="downloadForm" method="GET">
                <div class="flex items-center mb-4">
                    <input type="radio" id="txtFormat" name="format" value="txt" checked class="mr-2">
                    <label for="txtFormat" class="text-lg">.txt</label>
                </div>
                <div class="flex items-center mb-4">
                    <input type="radio" id="csvFormat" name="format" value="csv" class="mr-2">
                    <label for="csvFormat" class="text-lg">.csv</label>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Descarregar</button>
                <button type="button" id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(downloadUrl) {
            document.getElementById('downloadForm').action = downloadUrl;
            document.getElementById('formatModal').classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('formatModal').classList.add('hidden');
        });
    </script>
</x-app-layout>
