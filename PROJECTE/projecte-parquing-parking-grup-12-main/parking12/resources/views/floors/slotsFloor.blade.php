<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('Places de ' . $floor->name) }}</h2>

        <div class="mb-4">
            <a href="{{ route('parkings.floorsparking', $parking->id) }}" class="text-blue-600 hover:text-blue-800">&larr; Tornar</a>
        </div>

        @if(auth()->user()->role == 'admin')
            <a href="{{ route('parkingslots.create', ['parking' => $parking->id, 'floor' => $floor->id]) }}" class="bg-green-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-green-700 transition duration-300 mb-6 inline-block">
                Crear nova plaça
            </a>
        @endif

        @if ($slots->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No hi ha places disponibles per a aquesta planta.</p>
        @else
            <div class="mb-6 overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <svg height="1300" width="1550" xmlns="http://www.w3.org/2000/svg" class="border border-gray-300 rounded-lg">
                    <rect x="0" y="600" width="20" height="100" style="fill:gray;stroke:black;stroke-width:1;" />
                    <rect x="1530" y="600" width="20" height="100" style="fill:gray;stroke:black;stroke-width:1;" />

                    <rect x="80" y="80" width="440" height="540" style="fill:#d3d3d3;" />
                    <rect x="630" y="80" width="440" height="540" style="fill:#d3d3d3;" />
                    <rect x="80" y="680" width="440" height="540" style="fill:#d3d3d3;" />
                    <rect x="630" y="680" width="440" height="540" style="fill:#d3d3d3;" />
                    <rect x="1230" y="680" width="250" height="540" style="fill:#d3d3d3;" />
                    <rect x="1230" y="80" width="240" height="540" style="fill:#d3d3d3;" />
                    <rect x="1250" y="500" width="200" height="70" style="fill:#add8e6;stroke:black;stroke-width:2" />

                    @foreach ($slots as $slot)
                        @php
                            $color = $slot['slotStatus'] == 'occupied' ? 'red' :
                                    ($slot['slotStatus'] == 'closed' ? 'gray' : 'lightgreen');
                            if ($slot['slotType'] == 'motorbike') {
                                $width = 100;
                                $height = 50;
                            } elseif ($slot['slotType'] == 'big') {
                                $width = 250;
                                $height = 100;
                            } else {
                                $width = $slot['x2'] - $slot['x1'];
                                $height = $slot['y2'] - $slot['y1'];
                            }
                        @endphp

                        <rect 
                            id="slot-{{ $slot['id'] }}"
                            x="{{ $slot['x1'] }}" 
                            y="{{ $slot['y1'] }}" 
                            width="{{ $width }}" 
                            height="{{ $height }}" 
                            style="fill:{{ $color }};stroke:black;stroke-width:2" />
                        <text 
                            x="{{ $slot['x1'] + 10 }}" 
                            y="{{ $slot['y1'] + 30 }}" 
                            fill="black" 
                            font-size="14" 
                            font-family="Arial">
                            {{ $slot['name'] }}
                        </text>
                    @endforeach
                </svg>
            </div>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">ID</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Nom</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Tipus de plaça</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Estat plaça</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Matricula</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Coordenades x1, y1</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Coordenades x2, y2</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-white">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900">
                        @foreach ($slots as $parkingslot)
                            <tr>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parkingslot->id }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parkingslot->name }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parkingslot->slotType }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parkingslot->slotStatus }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">
                                    @if ($parkingslot->slotStatus == 'closed')
                                        <form action="{{ route('floors.assignPlateForm', ['floor' => $floor->id, 'slot' => $parkingslot->id]) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Assignar</button>
                                        </form>
                                    @else
                                        @if ($parkingslot->assignedPlate)
                                            {{ $parkingslot->assignedPlate }}  
                                        @else
                                            {{ $parkingslot->plate ?? '-' }}
                                        @endif
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parkingslot->x1 }} | {{ $parkingslot->y1 }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $parkingslot->x2 }} | {{ $parkingslot->y2 }}</td>
                                <td class="px-4 py-2 flex items-center space-x-4">
                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route('parkingslots.edit', $parkingslot->id) }}" class="bg-yellow-600 text-white py-2 px-4 rounded-lg hover:bg-yellow-700 transition duration-300">Editar</a>
                                        <form action="{{ route('parkingslots.destroy', $parkingslot->id) }}" method="GET" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300" onclick="return confirm('Estàs segur de voler eliminar aquesta plaça?')">Eliminar</button>
                                        </form>
                                    @endif

                                    <a href="{{ route('parkingslots.show', $parkingslot->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Veure detalls</a>
                                    @if ($parkingslot->slotStatus === 'occupied')
                                        <form action="{{ route('parkingslots.desaparcar', $parkingslot->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition duration-300" onclick="return confirm('Estàs segur que vols desaparcar aquest vehicle?')">
                                                Desaparcar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Menú contextual -->
    <div id="context-menu" class="hidden absolute bg-white border border-gray-300 rounded-lg shadow-lg p-2">
        <button id="aparcar" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Aparcar</button>
        <button id="desaparcar" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Desaparcar</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contextMenu = document.getElementById('context-menu');
            const slots = @json($slots);

            // Función para mostrar el menú contextual
            function showContextMenu(event, slotId) {
                event.preventDefault(); // Evita que aparezca el menú contextual por defecto del navegador

                const slot = slots.find(s => s.id === slotId);
                if (!slot) return;

                // Posiciona el menú contextual en la posición del clic
                contextMenu.style.left = `${event.pageX}px`;
                contextMenu.style.top = `${event.pageY}px`;
                contextMenu.classList.remove('hidden');

                // Muestra u oculta los botones según el estado de la plaza
                const aparcarBtn = document.getElementById('aparcar');
                const desaparcarBtn = document.getElementById('desaparcar');

                if (slot.slotStatus === 'open') {
                    aparcarBtn.style.display = 'block';
                    desaparcarBtn.style.display = 'none';
                } else if (slot.slotStatus === 'occupied') {
                    aparcarBtn.style.display = 'none';
                    desaparcarBtn.style.display = 'block';
                } else {
                    aparcarBtn.style.display = 'none';
                    desaparcarBtn.style.display = 'none';
                }

                // Asigna el ID de la plaza al botón para usarlo en las acciones
                aparcarBtn.dataset.slotId = slotId;
                desaparcarBtn.dataset.slotId = slotId;
            }

            // Oculta el menú contextual al hacer clic en cualquier parte de la pantalla
            document.addEventListener('click', () => {
                contextMenu.classList.add('hidden');
            });

            // Maneja el clic derecho sobre las plazas
            slots.forEach(slot => {
                const slotElement = document.getElementById(`slot-${slot.id}`);
                if (slotElement) {
                    slotElement.addEventListener('contextmenu', (event) => {
                        showContextMenu(event, slot.id);
                    });
                }
            });

            // Acción de Aparcar
            document.getElementById('aparcar').addEventListener('click', function() {
                const slotId = this.dataset.slotId;
                if (slotId) {
                    window.location.href = `/parkingslots/${slotId}/aparcar`;
                }
            });

            // Acción de Desaparcar
            document.getElementById('desaparcar').addEventListener('click', function() {
                const slotId = this.dataset.slotId;
                if (slotId) {
                    // Crear un formulario dinámico
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/parkingslots/${slotId}/desaparcar`;
                    form.style.display = 'none';

                    // Añadir el token CSRF
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfToken);

                    // Añadir el método POST
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'POST';
                    form.appendChild(methodInput);

                    // Añadir el formulario al cuerpo del documento
                    document.body.appendChild(form);

                    // Enviar el formulario
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>