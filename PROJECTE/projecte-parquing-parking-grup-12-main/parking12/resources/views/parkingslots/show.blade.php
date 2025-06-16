<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6">{{ __('Detalls de la plaça de pàrquing') }}</h2>

        <!-- tornar -->
        <div class="mb-4">
            <a href="{{ route('floors.slotsfloor', $floor->id) }}" class="text-blue-600 hover:text-blue-800">&larr; Tornar</a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <strong class="text-gray-700 dark:text-white">{{ __('Nom de la plaça:') }}</strong>
                <p class="text-gray-800 dark:text-gray-200">{{ $parkingslot->name }}</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700 dark:text-white">{{ __('Tipus de plaça:') }}</strong>
                <p class="text-gray-800 dark:text-gray-200">{{ $parkingslot->slotType }}</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700 dark:text-white">{{ __('Estat de la plaça:') }}</strong>
                <p class="text-gray-800 dark:text-gray-200">{{ $parkingslot->slotStatus }}</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700 dark:text-white">{{ __('Coordenades:') }}</strong>
                <p class="text-gray-800 dark:text-gray-200">
                    ({{ $parkingslot->x1 }}, {{ $parkingslot->y1 }}) - 
                    ({{ $parkingslot->x2 }}, {{ $parkingslot->y2 }})
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <strong class="text-gray-700 dark:text-white">{{ __('Planta:') }}</strong>
                <p class="text-gray-800 dark:text-gray-200">{{ $floor->name }}</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700 dark:text-white">{{ __('Parking:') }}</strong>
                <p class="text-gray-800 dark:text-gray-200">{{ $parking->name }}</p>
            </div>
        </div>

        <div class="flex space-x-4">
            <!-- editar (només admin) -->
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('parkingslots.edit', $parkingslot->id) }}" class="px-4 py-2 text-white bg-yellow-600 rounded hover:bg-yellow-700">{{ __('Editar plaça') }}</a>
            @endif
        </div>

    </div>
</x-app-layout>
