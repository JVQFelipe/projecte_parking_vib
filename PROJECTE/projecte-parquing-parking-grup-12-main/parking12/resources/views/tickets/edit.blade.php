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
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-black">Editar Ticket</h2>
            </div>

            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-4">
                    <label for="plate" class="block text-gray-700">Matricula</label>
                    <input type="text" id="plate" name="plate" value="{{ $ticket->plate }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="entryTime" class="block text-gray-700">Hora d'entrada</label>
                    <input type="datetime" id="entryTime" name="entryTime" value="{{ $ticket->entryTime }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="exitTime" class="block text-gray-700">Hora de sortida</label>
                    <input type="datetime" id="exitTime" name="exitTime" value="{{ $ticket->exitTime }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="totalPay" class="block text-gray-700">Total a pagar</label>
                    <input type="number" id="totalPay" name="totalPay" value="{{ $ticket->totalPay }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" min="0">
                </div>

                <div class="mb-4">
                    <label for="isPaid" class="block text-gray-700">Pagat?</label>
                    <input type="checkbox" id="isPaid" name="isPaid" value="1" {{ $ticket->isPaid ? 'checked' : '' }} class="h-6 w-6">
                </div>

                <div class="mb-4">
                    <label for="paymentOption" class="block text-gray-700">Opció de pagament</label>
                    <select id="paymentOption" name="paymentOption" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="card" {{ $ticket->paymentOption == 'card' ? 'selected' : '' }}>Targeta</option>
                        <option value="cash" {{ $ticket->paymentOption == 'cash' ? 'selected' : '' }}>Efectiu</option>
                        <option value="paypal" {{ $ticket->paymentOption == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="bitcoin" {{ $ticket->paymentOption == 'bitcoin' ? 'selected' : '' }}>Bitcoin</option>
                        <option value="coupon" {{ $ticket->paymentOption == 'coupon' ? 'selected' : '' }}>Cupó</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="parking_id" class="block text-gray-700">Parking Associat</label>
                    <input type="text" id="parking_id" name="parking_id" value="{{ $ticket->parking->name }}" readonly class="w-full p-3 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('parkings.ticketsparking', $ticket->parking->id) }}" class="bg-gray-300 text-gray-800 py-3 px-6 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">Tornar</a>
                    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Actualizar Ticket</button>
                </div>

                
            </form>
        </div>
    </div>
</x-app-layout>
