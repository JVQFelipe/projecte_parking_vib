<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tarifes de ' . $parking->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('parkings.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 font-bold">
                        &larr; Tornar
                    </a>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        {{ __('Gestió de Tarifes') }}
                    </h3>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-4">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Tarifes Assignades</h4>
                        <form method="POST" action="{{ route('parkings.detachrate', $parking->id) }}">
                            @csrf
                            <div class="form-group">
                                <select multiple size="10" name="parking_rates[]" class="form-control w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                    @forelse($parking->rates as $rate)
                                        <option value="{{ $rate->id }}">{{ $rate->name }}</option>
                                    @empty
                                        <option disabled>No hi ha tarifes assignades</option>
                                    @endforelse
                                </select>
                            </div>
                            <button type="submit" class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                                Treure Tarifes
                            </button>
                        </form>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Assignar Tarifes</h4>
                        <form method="POST" action="{{ route('parkings.assignrate', $parking->id) }}">
                            @csrf
                            <div class="form-group">
                                <select multiple size="10" name="parking_rates[]" class="form-control w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                    @forelse($rates as $rate)
                                        <option value="{{ $rate->id }}">{{ $rate->name }}</option>
                                    @empty
                                        <option disabled>No hi ha tarifes disponibles</option>
                                    @endforelse
                                </select>
                            </div>
                            <button type="submit" class="mt-4 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                                Assignar Tarifes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
