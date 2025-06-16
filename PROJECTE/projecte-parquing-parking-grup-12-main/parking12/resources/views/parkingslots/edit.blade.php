<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edita la plaça de pàrquing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-8">Edita la plaça de pàrquing</h3>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-md">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('parkingslots.update', $parkingslot->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="floor_id" value="{{ $parkingslot->floor_id }}">

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('name', $parkingslot->name) }}" required>
                    </div>

                    <div class="mb-6">
                        <label for="slotType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipus de plaça</label>
                        <select id="slotType" name="slotType" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="normal" {{ $parkingslot->slotType == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="motorbike" {{ $parkingslot->slotType == 'motorbike' ? 'selected' : '' }}>Moto</option>
                            <option value="big" {{ $parkingslot->slotType == 'big' ? 'selected' : '' }}>Gran</option>
                            <option value="adapted" {{ $parkingslot->slotType == 'adapted' ? 'selected' : '' }}>Adaptada</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="slotStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estat</label>
                        <select id="slotStatus" name="slotStatus" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="open" {{ $parkingslot->slotStatus == 'open' ? 'selected' : '' }}>Disponible</option>
                            <option value="occupied" {{ $parkingslot->slotStatus == 'occupied' ? 'selected' : '' }}>Ocupada</option>
                            <option value="closed" {{ $parkingslot->slotStatus == 'closed' ? 'selected' : '' }}>Cerrada</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="mb-6">
                            <label for="x1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coordenada X1</label>
                            <input type="number" id="x1" name="x1" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('x1', $parkingslot->x1) }}" required>
                        </div>

                        <div class="mb-6">
                            <label for="y1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coordenada Y1</label>
                            <input type="number" id="y1" name="y1" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('y1', $parkingslot->y1) }}" required>
                        </div>

                        <div class="mb-6">
                            <label for="x2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coordenada X2</label>
                            <input type="number" id="x2" name="x2" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('x2', $parkingslot->x2) }}" required>
                        </div>

                        <div class="mb-6">
                            <label for="y2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coordenada Y2</label>
                            <input type="number" id="y2" name="y2" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('y2', $parkingslot->y2) }}" required>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Actualitzar</button>
                        <a href="{{ route('floors.slotsfloor', $floor->id) }}" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Cancel·lar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
